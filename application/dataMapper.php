<?php
class DataMapper
{
	private $query = NULL;
	
	public function __construct()
	{
		#... Подключение к базе
	}

	public function query()
	{
		#... Добавить запрос
	}

	public functon execute()
	{
		#... Выполнить запрос
	}

	public function __destruct()
	{
		#... Отключиться от базы
	}
}