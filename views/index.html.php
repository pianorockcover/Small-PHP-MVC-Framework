<a class="btn btn-default" href="index.php?r=news/add">Добавить новость</a>
<a class="btn btn-default" href="#">Добавить категорию</a>
<a class="btn btn-default" href="#">Парсить новости</a>
<?php foreach ($params['news'] as $news): ?>

<div class="item">
	<h4><?= $news['title'] ?></h4>
	<div class="media-news">
		<div class="media-left">
			<img src="assets/images/<?= $news['news_id'] ?>.jpg">
		</div>
		<div class="media-body">
			<p>
				<?= $news['summary'] ?>
				<a class="read-more" href="index.php?r=news/fullView&news_id=<?=$news['news_id']?>">Read more...</a>		
				<span class="muted date"><?= $news['date'] ?></span>
			</p>	
		</div>
	</div>
	<a class="btn btn-primary" href="index.php?r=news/edit&news_id=<?= $news['news_id'] ?>">Редактировать</a>
	<a class="btn btn-danger" href="index.php?r=news/delete&news_id=<?= $news['news_id'] ?>">Удалить</a>
</div>
<br>

<?php endforeach; ?>


<?php $params['pagination']->widget(); ?>