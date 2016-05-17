<?php
mb_internal_encoding("UTF-8");
use application\Application;

require_once('application/autoload.php');
require_once('config.php');

(new Application($config))->run();
