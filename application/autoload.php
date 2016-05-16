<?php
spl_autoload_register(function($class) {
	require(lcfirst($class).'.php');
	
	return;
});