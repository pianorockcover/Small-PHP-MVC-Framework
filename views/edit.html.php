<form enctype="multipart/form-data" action="index.php" class="media-news" method = "post">
	<input type="hidden" name="r" value="news/update">
	<input type="hidden" name="news_id" value="<?= $params['news']['news_id'] ?>">
	<b>Title</b>
	<input type="text" name="title" value="<?= $params['news']['title'] ?>">
	<br>
	<b>Date</b>
	<input type="text" name="date" value="<?= $params['news']['date'] ?>">
	<br>
	<b>Summary</b>
	<textarea name="summary"><?= $params['news']['summary'] ?></textarea>
	<br>
	<b>Content</b>
	<textarea name="content"><?= $params['news']['content'] ?></textarea>
	<br>
	<b>Image</b>
	<input name="image" type="file" accept="image/jpeg"/>
	<br>
	<button type="submit">Update</button>
</form>