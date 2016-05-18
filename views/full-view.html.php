<div class="media-news">
	<table>
		<tbody>
			<tr>
				<td class="media-left">
					<img src="assets/images/<?= $params['news']['news_id'] ?>.jpg" alt="Нет изображения">
				</td>
				<td class="media-body">
					<h4><?= $params['news']['title'] ?></h4>
					<p>
						<?= $params['news']['summary'] ?>
					<p>
					</p>
						<?= $params['news']['content'] ?>
						<span class="muted date"><?= $params['news']['date'] ?></span>
					</p>	

					<a class="btn btn-primary" href="index.php?r=news/edit&news_id=<?= $params['news']['news_id'] ?>">Редактировать</a>
					<a class="btn btn-danger" href="index.php?r=news/delete&news_id=<?= $params['news']['news_id'] ?>">Удалить</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

