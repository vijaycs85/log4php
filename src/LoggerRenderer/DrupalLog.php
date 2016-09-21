<?php

namespace Drupal\log4php\LoggerRenderer;

use Drupal\Component\Utility\Unicode;
use LoggerRenderer as LoggerRendererInterface;

/**
 * Log4Php DrupalPlain Renderer
 */
class DrupalLog implements LoggerRendererInterface {

  /**
   * List of watchdog's log_entry array variables
   */
  public $type;
  public $message;
  public $variables;
  public $severity;
  public $link;
  public $user;
  public $request_uri;
  public $referer;
  public $ip;
  public $timestamp;

  // convenience property
  public $user_name;

  /**
   * @param \Drupal\log4php\LoggerRenderer\DrupalLog $drupalLog
   * @return string|void
   * @throws \Exception
   */
  public function render($drupalLog) {
    throw new \Exception('Do not use this class directly for logging');
  }

  /**
   * @param $level
   * @param $message
   * @param $context
   * @param $parser
   *
   * @return \Drupal\log4php\LoggerRenderer\DrupalLog
   */
  public static function getInstanceFromLogEntry($level, $message, $context, $parser) {
    $message_placeholders = $parser->parseMessagePlaceholders($message, $context);
    $object = new static();
    $object->type = Unicode::substr($context['channel'], 0, 64);
    $object->message = $message;
    $object->variables = serialize($message_placeholders);
    $object->severity = $level;
    $object->link = $context['link'];
    $object->user = $context['user'];
    $object->request_uri = $context['request_uri'];
    $object->referer = $context['referer'];
    $object->ip = Unicode::substr($context['ip'], 0, 128);
    $object->timestamp = $context['timestamp'];

    /** @var  $user \Drupal\Core\Session\AccountProxy */
    $user = $context['user'];
    $object->user_name = $user->id() > 0 ? $user->getAccountName() : t('Anonymous');
    return $object;
  }
}
