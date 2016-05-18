<h1>Добавить новую новость</h1>
<form class="form" enctype="multipart/form-data" action="index.php" class="media-news" method = "post">
	<input type="hidden" name="r" value="news/insert">
	<input type="hidden" name="news_id" value="">
	<table>
		<tbody>
			<tr>
				<td><b>Title:</b></td>
				<td><input class="input" type="text" name="title" value=""></td>
			</tr>
			<tr>
				<td><b>Date:</b></td>
				<td><input class="input" type="text" name="date" value=""></td>
			</tr>
			<tr>
				<td><b>Summary:</b></td>
				<td><textarea class="input textarea" name="summary"></textarea></td>
			</tr>
			<tr>
				<td><b>Content:</b></td>
				<td><textarea class="input textarea" name="content"></textarea></td>
			</tr>
			<tr>
				<td><b>Category:</b></td>
				<td>
					<select name="category">
					    <option disabled>Выберите категорию</option>
					    <?php foreach($params['categories'] as $category): ?>
					    	<option value="<?= $category['category_id'] ?>">
					    		<?= $category['name'] ?>
					    	</option>
					    <?php endforeach; ?>
				    </select>
			    </td>
			</tr>
			<tr>
				<td><b>Image:</b></td>
				<td><input name="image" type="file" accept="image/jpeg"/></td>
			</tr>
		</tbody>
	</table>
	<button class="btn btn-primary" type="submit">Добавить</button>
</form>