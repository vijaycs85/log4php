<?php

namespace Drupal\log4php\LoggerRenderer;

/**
 * Log4Php CLI locale renderer
 *
 * Uses log4php_t function so that the message is being translated
 *
 * WARNING: the messages logged by this logger are not sanitized and are meant to be viewed in
 * a terminal. Displaying these messages in a browser represents a potential security threat.
 */
class LoggerRendererDrupalPlainLocaleObject extends DrupalLog {

  /**
   * @param \Drupal\log4php\LoggerRenderer\DrupalLog $drupalLog
   * @return string
   */
  public function render($drupalLog) {
    return "{$drupalLog->user_name} {$drupalLog->request_uri} {$drupalLog->ip} " .
      t($drupalLog->message, is_array($drupalLog->variables) ? $drupalLog->variables : array());
  }
}
