<?php
use application\Application;

require_once('application/autoload.php');
require_once('config.php');

(new Application($config))->run();
