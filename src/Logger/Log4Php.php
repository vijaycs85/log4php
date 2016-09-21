<?php

namespace Drupal\log4php\Logger;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Logger\LogMessageParserInterface;
use Drupal\Core\Logger\RfcLogLevel;
use Drupal\log4php\LoggerRenderer\DrupalLog;
use Logger as Log4PhpLogger;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Logger\RfcLoggerTrait;
use Psr\Log\LoggerInterface;

/**
 * Logs events in the watchdog database table.
 */
class Log4Php implements LoggerInterface {
  use RfcLoggerTrait;
  use DependencySerializationTrait;

  /**
   * The message's placeholders parser.
   *
   * @var \Logger
   */
  protected $logger;

  /**
   * The message's placeholders parser.
   *
   * @var \Drupal\Core\Logger\LogMessageParserInterface
   */
  protected $parser;

  /**
   * Constructs a DbLog object.
   *
   * @param \Logger $logger
   *   The logger to use when extracting message variables.
   * @param \Drupal\Core\Logger\LogMessageParserInterface $parser
   *   The parser to use when extracting message variables.
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory object.
   */
  public function __construct(Log4PhpLogger $logger, LogMessageParserInterface $parser, ConfigFactoryInterface $config_factory) {
    $this->config = $config_factory->get('log4php.settings');
    $this->logger = $logger;
    $this->parser = $parser;
  }

  /**
   * {@inheritdoc}
   */
  public function log($level, $message, array $context = array()) {
    $name = $this->config->get('config_file');
    $this->logger->configure($name);
    $logger = $this->logger->getLogger('drupal:' . $context['channel']);
    $log_object = DrupalLog::getInstanceFromLogEntry($level, $message, $context, $this->parser);
    // Map Drupal severity levels to log4php levels
    // (Drupal currently has no analog to TRACE)
    switch ($level) {
      case RfcLogLevel::EMERGENCY:
      case RfcLogLevel::ALERT:
      case RfcLogLevel::CRITICAL:
        $logger->fatal($log_object);
        break;
      case RfcLogLevel::ERROR:
        $logger->error($log_object);
        break;
      case RfcLogLevel::WARNING:
        $logger->warn($log_object);
        break;
      case RfcLogLevel::NOTICE:
      case RfcLogLevel::INFO:
        $logger->info($log_object);
        break;
      case RfcLogLevel::DEBUG:
        $logger->debug($log_object);
        break;
    }
  }

}