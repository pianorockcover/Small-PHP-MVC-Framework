
<?php foreach ($params['news'] as $news): ?>

<div class="media-news">
	<table>
		<tbody>
			<tr>
				<td class="media-left">
					<img src="assets/images/<?= $news['news_id'] ?>.jpg" alt="Нет изображения">
				</td>
				<td class="media-body">
					<h4><?= $news['title'] ?></h4>
					<p>
						<?= $news['summary'] ?>
						<a class="read-more" href="index.php?r=news/fullView&news_id=<?=$news['news_id']?>">Читать далее...</a>		
						<p>
							<b>Категория:</b>
							<?php if (!$news['category']): ?>
								Нет
							<?php endif; ?>
							<?= $news['category'] ?>
						</p>
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