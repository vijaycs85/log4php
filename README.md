Apache log4php Integration
==========================


Maintainers
-----------

Erik Webb (http://drupal.org/user/273404)


Features
--------

This module provides simple integration with the Apache log4php library.

WARNING
-------

If you plan to view your log messages in a browser interface please use the
LoggerRendererDrupalStandardObject renderer. Messages logged by other renderers are not passed through Drupal's
check_plain() function and thus represent a security vector when viewed in a browser.


Installation
------------

After creating an XML configuration file, include it in your settings.php file -

  <?php
    $config['log4php.settings']['config_file'] = 'modules/contrib/log4php/log4php.xml';
  ?>

The default log4php.xml file is a basic configuration to test functionality. This configuration only writes log entries to a file located in the temp directory (will only work on Linux/Unix/Mac for now).
