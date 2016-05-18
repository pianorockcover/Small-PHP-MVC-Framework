<?php
namespace controllers;

use \application\Controller;
use \models\News;

class ParseController extends Controller {
	public function actionGo($params)
	{
		$site = file_get_contents('http://chelyabinsk.ru/text/newsline/');
		$allNews = [];

		$site = iconv(mb_detect_encoding($site, mb_detect_order(), true), "UTF-8", $site);
		// preg_match_all('/^([а-яА-ЯЁёa-zA-Z0-9_]+)$/u', $site, $allNews);
	preg_match_all('/<div class="news-record record_feed_list">(.*)<\/div>/U', $site, $allNews);

		var_dump($allNews[1]);
		exit();
	}
}