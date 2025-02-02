<?php

namespace AppBundle\EventListener;

use AppBundle\Utils\ServiceUtil;
use Cocur\Slugify\Slugify;
use CourseBundle\Entity\Course;
use CourseBundle\Entity\CourseAttachment;
use CourseBundle\Services\PaymentMethodService;
use CourseBundle\Utils\VisitUtil;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Psr\Container\ContainerInterface;

class DatabaseActivitySubscriber implements EventSubscriber
{
  private $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

// this method can only return the event names; you cannot define a
  // custom method name to execute when each event triggers
  public function getSubscribedEvents()
  {
    return [
      Events::preUpdate,
      Events::prePersist,
      Events::preRemove
    ];
  }

  // callback methods must be called exactly like the events they listen to;
  // they receive an argument of type LifecycleEventArgs, which gives you access
  // to both the entity object of the event and the entity manager itself
  public function preRemove(LifecycleEventArgs $args)
  {
    $this->hookCourseAttachmentRemove($args);

  }

  // callback methods must be called exactly like the events they listen to;
  // they receive an argument of type LifecycleEventArgs, which gives you access
  // to both the entity object of the event and the entity manager itself
  public function preUpdate(LifecycleEventArgs $args)
  {
    try {
      $this->hookUpdate($args);
    } catch (\Exception $ex) {
    }
  }

  // callback methods must be called exactly like the events they listen to;
  // they receive an argument of type LifecycleEventArgs, which gives you access
  // to both the entity object of the event and the entity manager itself
  public function prePersist(LifecycleEventArgs $args)
  {
    $this->hookUpdate($args);
  }

  private function hookUpdate(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();
    $entity->setUpdatedAt(new \DateTime());

    if (!($entity instanceof Course)) {
      return;
    }

    if ($entity->getSlug()) {
      return;
    }

    $slug = VisitUtil::buildCourseSlug($entity);
    $entity->setSlug($slug);
  }

  private function hookCourseAttachmentRemove(LifecycleEventArgs $args)
  {
    $entity = $args->getObject();

    if (!($entity instanceof CourseAttachment)) {
      return;
    }

    try {
      $courseService = $this->container->get(ServiceUtil::COURSE_SERVICE);
      $course = $courseService->getCourseByCourseAttachment($entity);
      $bucket = $courseService->getCompanyBucketByCourse($course);

      $courseService->removeAttachmentS3File($entity, $bucket);
    } catch (\Exception $ex) {
      // This course is not valid for company course
    }
  }
}
