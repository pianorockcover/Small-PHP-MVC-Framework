<?php
namespace models;

use \application\DataMapper;

class Category extends DataMapper
{
	public function table()
	{
		return 'categories';
	}
}