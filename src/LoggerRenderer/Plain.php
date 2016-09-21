<?php
namespace Drupal\log4php\LoggerRenderer;

use LoggerRenderer as LoggerRendererInterface;

/**
 * Log4Php Drupal Plain Renderer
 *
 * WARNING: the messages logged by this logger are not sanitized and are meant to be viewed in
 * a terminal. Displaying these messages in a browser represents a potential security threat.
 */
class Plain extends DrupalLog {

  /**
   * @param \Drupal\log4php\LoggerRenderer\DrupalLog $drupalLog
   * @return string
   */
  public function render($drupalLog) {
    return "{$drupalLog->user_name} {$drupalLog->request_uri} {$drupalLog->ip} " .
      strtr($drupalLog->message, is_array($drupalLog->variables) ? $drupalLog->variables : array());
  }
}
