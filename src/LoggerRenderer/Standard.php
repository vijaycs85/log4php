<?php

namespace Drupal\log4php\LoggerRenderer;


/**
 * Log4Php Drupal Standard Renderer - messages logged by this renderer can be safely viewed in a browser
 *
 * Will pass log messages through t() function which in turn does check plain() and format_string().
 */
class Standard extends DrupalLog {

  /**
   * @param \Drupal\log4php\LoggerRenderDrupalLog $drupalLog
   * @return string
   */
  public function render($drupalLog) {
    return "{$drupalLog->user_name} {$drupalLog->request_uri} {$drupalLog->ip} " .
      t($drupalLog->message, is_array($drupalLog->variables) ? $drupalLog->variables : array());
  }
}
