Apache log4php Integration
==========================


Maintainers
-----------

Erik Webb (http://drupal.org/user/273404)


Features
--------

This module provides simple integration with the Apache log4php library.


Requirements
------------

This module requires the log4php library. This can be installed in one of two ways -

The preferred installation method is via PEAR -

  pear channel-discover pear.apache.org/log4php
  pear install log4php/Apache_log4php

Alternatively the main code files can be installed via the Libraries module. Move the src/main/php directory to sites/all/libraries/log4php.


Installation
------------

After creating an XML configuration file, include it in your settings.php file -

  <?php
    $conf['log4php_config'] = 'sites/all/modules/log4php/log4php.xml';
  ?>

The default log4php.xml file is a basic configuration to test functionality. This configuration only writes log entries to a file located in the temp directory (will only work on Linux/Unix/Mac for now).


Recommended modules
-------------------

Libraries (1.x only, for now)

