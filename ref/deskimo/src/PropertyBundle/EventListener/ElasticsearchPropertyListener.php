<?php


namespace PropertyBundle\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use FOS\ElasticaBundle\Persister\ObjectPersister;
use FOS\ElasticaBundle\Persister\ObjectPersisterInterface;
use FOS\ElasticaBundle\Provider\IndexableInterface;
use Psr\Log\LoggerInterface;
use Doctrine\Common\EventSubscriber;

class ElasticsearchPropertyListener implements EventSubscriber
{
  /**
   * Object persister.
   *
   * @var ObjectPersisterInterface
   */
  protected $objectPersister;

  protected $relatedEntities = [];

  /**
   * Configuration for the listener.
   *
   * @var array
   */
  private $config;

  /**
   * Objects scheduled for insertion.
   *
   * @var array
   */
  public $scheduledForInsertion = array();

  /**
   * Objects scheduled to be updated or removed.
   *
   * @var array
   */
  public $scheduledForUpdate = array();

  /**
   * IDs of objects scheduled for removal.
   *
   * @var array
   */
  public $scheduledForDeletion = array();

  /**
   * @var IndexableInterface
   */
  private $indexable;


  public function getSubscribedEvents()
  {
    return array(
      'postPersist',
      'postRemove',
      'postUpdate',
    );
  }

  /**
   * Constructor.
   *
   * @param ObjectPersisterInterface $objectPersister
   * @param IndexableInterface       $indexable
   * @param array                    $relatedEntities
   * @param LoggerInterface          $logger
   */
  public function __construct(
    ObjectPersisterInterface $objectPersister,
    IndexableInterface $indexable,
    array $relatedEntities = array(),
    LoggerInterface $logger = null
  ) {
    $this->relatedEntities = $relatedEntities;
    $this->indexable = $indexable;
    $this->objectPersister = $objectPersister;
  }

  private function hasRightRelation($entity) {
    if (!$entity) {
      return false;
    }

    foreach ($this->relatedEntities as $relatedEntity) {
      if (is_a($entity, $relatedEntity)) {
        return true;
      }
    }

    return false;
  }

  /**
   * Looks for new objects that should be indexed.
   *
   * @param LifecycleEventArgs $eventArgs
   */
  public function postPersist(LifecycleEventArgs $eventArgs)
  {
    $entity = $eventArgs->getObject();

    $hasRightRelation = $this->hasRightRelation($entity);

    if (!($hasRightRelation)) {
      return;
    }

    $property = $entity->getProperty();
    $this->objectPersister->replaceOne($property);
  }

  /**
   * Looks for objects being updated that should be indexed or removed from the index.
   *
   * @param LifecycleEventArgs $eventArgs
   */
  public function postUpdate(LifecycleEventArgs $eventArgs)
  {
    $entity = $eventArgs->getObject();
    $hasRightRelation = $this->hasRightRelation($entity);

    if (!($hasRightRelation)) {
      return;
    }

    $property = $entity->getProperty();
    $this->objectPersister->replaceOne($property);
  }

  /**
   * Update relations on postRemove
   *
   * @param LifecycleEventArgs $eventArgs
   */
  public function postRemove(LifecycleEventArgs $eventArgs)
  {
    $entity = $eventArgs->getObject();
    $hasRightRelation = $this->hasRightRelation($entity);

    if (!($hasRightRelation)) {
      return;
    }

    $property = $entity->getProperty();
    $this->objectPersister->replaceOne($property);
  }
}