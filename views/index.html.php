<a class="btn btn-default" href="index.php?r=news/add">Добавить новость</a>
<a class="btn btn-default" href="index.php?r=category/all">Добавить категорию</a>
<a class="btn btn-default" href="#">Парсить новости</a>
<?php foreach ($params['news'] as $news): ?>

<div class="media-news">
	<table>
		<tbody>
			<tr>
				<td class="media-left">
					<img src="assets/images/<?= $news['news_id'] ?>.jpg">
				</td>
				<td class="media-body">
					<h4><?= $news['title'] ?></h4>
					<p>
						<?= $news['summary'] ?>
						<a class="read-more" href="index.php?r=news/fullView&news_id=<?=$news['news_id']?>">Читать далее...</a>		
						<span class="muted date"><?= $news['date'] ?></span>
					</p>	
					<a class="btn btn-primary" href="index.php?r=news/edit&news_id=<?= $news['news_id'] ?>">Редактировать</a>
					<a class="btn btn-danger" href="index.php?r=news/delete&news_id=<?= $news['news_id'] ?>">Удалить</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<?php endforeach; ?>


<?php $params['pagination']->widget(); ?>