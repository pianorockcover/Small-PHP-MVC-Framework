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

		preg_match_all('/<div class="news-record record_feed_list">(.*)<\/noindex>/U', $site, $allNews);

		$allNews = $allNews[1];
		var_dump($allNews);
		$upToDateNews = [];
		foreach ($allNews as $news) {
			$date = NULL;
			preg_match_all('/<span class="title">(.*)<\/span>/U', $news, $date);
			$date = $date[1][0];

			# Меняем формат даты и проверяем ее

			$title = NULl;
			preg_match_all('/<span class="title2" >	(.*)<\/span>/U', $news, $title);
			$title = $title[1][0];

			$summary = NULl;
			$news = substr($news, strpos($news, '<noindex>'));
			preg_match_all('/<noindex>(.*)$/U', $news, $summary);

			$summary = strip_tags($summary[1][0]);

			array_push($upToDateNews, ['date' => $date,
										'title' => $title,
										'summary' => $summary,
										]);


		}

		var_dump($upToDateNews);
		exit();
	}
}