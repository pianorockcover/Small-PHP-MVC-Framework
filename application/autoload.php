<?php
spl_autoload_register(function($class) {
	if (file_exists(lcfirst($class).'.php'))
	{
		require(lcfirst($class).'.php');
	}

	return;
});