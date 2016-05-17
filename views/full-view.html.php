<div class="media-news">
	<h2><?= $params['news']['title'] ?></h2>
	<img width = "200" src="assets/images/<?= $params['news']['news_id'] ?>.jpg">
	<p><?= $params['news']['summary'] ?></p>
	<p><?= $params['news']['content'] ?></p>
	<p class="muted"><?= $params['news']['category'] ?></p>
	<p><?= $params['news']['date'] ?></p>
	<a class="btn btn-edit" href="index.php?r=news/edit&news_id=<?= $params['news']['news_id'] ?>">Редактировать</a>
	<a class="btn btn-delete" href="index.php?r=news/delete&news_id=<?= $params['news']['news_id'] ?>">Удалить</a>
</div>
