<?php foreach ($params['news'] as $news): ?>
	<div class="media-news">
		<h2><?= $news['title'] ?></h2>
		<img src="assets/images/<?= $news['news_id'] ?>.jpg">
		<p><?= $news['summary'] ?></p>
		<button class="btn btn-read-more">Read more...</button>		
		<p class="muted"><?= $news['category'] ?></p>
		<p><?= $news['date'] ?></p>
		<a class="btn btn-edit" href="index.php?r=news/edit&id=<?= $news['news_id'] ?>">Редактировать</a>
		<a class="btn btn-delete" href="index.php?r=news/delete&id=<?= $news['news_id'] ?>">Удалить</a>
	</div>
<?php endforeach; ?>


<?php $params['pagination']->widget(); ?>