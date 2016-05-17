<a class="btn btn-default" href="index.php">На главную</a>
<div class="item">
	<h4><?= $params['news']['title'] ?></h4>
	<div class="media-news">
		<div class="media-left">
			<img src="assets/images/<?= $params['news']['news_id'] ?>.jpg">
		</div>
		<div class="media-body">
			<p>
				<?= $params['news']['summary'] ?>
			</p>
			<p>
				<?= $params['news']['content'] ?>
				<span class="muted date"><?= $params['news']['date'] ?></span>
			</p>
		</div>
	</div>
	<a class="btn btn-primary" href="index.php?r=news/edit&news_id=<?= $params['news']['news_id'] ?>">Редактировать</a>
	<a class="btn btn-danger" href="index.php?r=news/delete&news_id=<?= $params['news']['news_id'] ?>">Удалить</a>
</div>
