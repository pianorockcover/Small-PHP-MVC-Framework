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
		$upToDateNews = [];

		$newsModel = new News;
		$newsModel->query("TRUNCATE TABLE news");
		$newsModel->execute();

		if (file_exists('assets/images'))
		foreach (glob('assets/images/*.jpg') as $file)
		unlink($file);

		foreach ($allNews as $news) {
			$date = NULL;
			preg_match_all('/<span class="title">(.*)<\/span>/U', $news, $date);
			$date = $date[1][0];

			$title = NULl;
			preg_match_all('/<span class="title2" >	(.*)<\/span>/U', $news, $title);
			$title = $title[1][0];

			$summary = NULl;
			$news = substr($news, strpos($news, '<noindex>'));
			preg_match_all('/<noindex>(.*)$/U', $news, $summary);

			$summary = strip_tags($summary[1][0],'<p>');
			$summary = str_replace(' style="text-align: justify;"', '', $summary);
			$date = $this->dateConvert($date);

		    $upToDateNews['date'] = $date;
			$upToDateNews['title'] = $title;
			$upToDateNews['summary'] = $summary;

			foreach ($upToDateNews as $key => $item) {
				$upToDateNews[$key] = str_replace('\'', '`', $upToDateNews[$key]);
				$upToDateNews[$key] = str_replace('"', '`', $upToDateNews[$key]);
			}

			$newsModel->query("INSERT INTO news (`title`, `date`, `summary`)
								 VALUES ('{$upToDateNews['title']}',
								  		    '{$upToDateNews['date']}',
								  		    '{$upToDateNews['summary']}');");
			$newsModel->execute();
		}

		return (new NewsController)->actionAll(null);
	}

	private function dateConvert($date)
	{
		$months = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
				'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
		$date = trim($date);
		$date = substr($date, 0, strlen($date) - 5);
		$date = trim($date);
		$date = str_replace(' ', '-', $date);

		preg_match_all('/-(.*)-/', $date, $month);
		$month = $month[1][0];

		$month = array_search($month, $months);
		$month++;

		$result = substr($date, strlen($date) - 4, strlen($date));
		$result .= '-';
		$result .= $month;
		$result .= '-';
		$result .= substr($date, 0, 2);

		return $result;
	}
}