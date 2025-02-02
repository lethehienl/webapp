<?php


namespace AppBundle\Services;


use OldSound\RabbitMqBundle\RabbitMq\ProducerInterface;

class NotificationService implements NotificationInterface
{
  private $notificationRabbitMQProducer;

  private $to;

  private $body;

  private $type;

  private $subject;

  private $language = 'en';

  /**
   * NotificationService constructor.
   */
  public function __construct(ProducerInterface $producer, $type)
  {
    $this->notificationRabbitMQProducer = $producer;
    $this->type = $type;
  }

  /**
   * @return mixed
   */
  public function getTo()
  {
    return $this->to;
  }

  /**
   * @param mixed $to
   */
  public function setTo($to)
  {
    $this->to = $to;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * @return mixed
   */
  public function getBody()
  {
    return $this->body;
  }

  /**
   * @param mixed $body
   */
  public function setBody($body)
  {
    $this->body = $body;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getLanguage()
  {
    return $this->language;
  }

  /**
   * @param mixed $language
   */
  public function setLanguage($language = 'en')
  {
    $this->language = $language;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getSubject()
  {
    return $this->subject;
  }

  /**
   * @param mixed $subject
   */
  public function setSubject($subject)
  {
    $this->subject = $subject;
    return $this;
  }

  public function send($payload = [])
  {
    if (!$this->getTo()) {
      throw new \Exception('to is required');
    }

    if (!$this->getLanguage()) {
      throw new \Exception('language is required');
    }

    if (!$this->getType()) {
      throw new \Exception('notification type is required');
    }

    if (!$this->getBody()) {
      throw new \Exception('Body is required');
    }

    $payload['body'] = $this->getBody();
    $payload['to'] = $this->getTo();
    $payload['type'] = $this->getType();
    $payload['language'] = $this->getLanguage();

    $this->notificationRabbitMQProducer->setContentType('application/json');
    $this->notificationRabbitMQProducer->publish(json_encode($payload));
  }
}