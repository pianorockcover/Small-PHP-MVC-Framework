<div class="media-news">
	<table>
		<tbody>
			<tr>
				<td class="media-left">
					<?php $fileName = "assets/images/{$params['news']['news_id']}.jpg"; ?>
					<?php if (!file_exists("assets/images/{$params['news']['news_id']}.jpg")): ?>
						<?php $fileName = "assets/placeholder.png"; ?>
					<?php endif; ?>
					<img src="<?= $fileName ?>" alt="Нет изображения">
				</td>
				<td class="media-body">
					<h4><?= $params['news']['title'] ?></h4>
					<div>
						<?= $params['news']['summary'] ?>
					</div>
					<p>
						<?= $params['news']['content'] ?>
						<span class="muted date"><?= $params['news']['date'] ?></span>
					</p>	
					<p>
						<b>Категория:</b>
						<?php if (!$params['news']['category']): ?>
							Нет
						<?php endif; ?>
						<?= $params['news']['category'] ?>
					</p>

					<a class="btn btn-primary" href="index.php?r=news/edit&news_id=<?= $params['news']['news_id'] ?>">Редактировать</a>
					<a class="btn btn-danger" href="index.php?r=news/delete&news_id=<?= $params['news']['news_id'] ?>">Удалить</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>

