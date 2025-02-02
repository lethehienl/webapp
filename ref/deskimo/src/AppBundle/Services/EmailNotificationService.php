<?php


namespace AppBundle\Services;


class EmailNotificationService extends NotificationService
{
  private $template;

  /**
   * @return mixed
   */
  public function getTemplate()
  {
    return $this->template;
  }

  /**
   * @param mixed $template
   */
  public function setTemplate($template)
  {
    $this->template = $template;
    return $this;
  }

  public function send($payload = [])
  {
    $template = $this->getTemplate();

    if (!$template) {
      throw new \Exception('Template name need to be defined!');
    }

    if (!$this->getSubject()) {
      throw new \Exception('Subject need to be defined!');
    }

    $payload['subject'] = $this->getSubject();
    $payload['template_key'] = $template;
    parent::send($payload);
  }
}