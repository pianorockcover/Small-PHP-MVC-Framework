<form enctype="multipart/form-data" action="index.php" class="media-news" method = "post">
	<input type="hidden" name="r" value="news/insert">
	<input type="hidden" name="news_id" value="">
	<b>Title</b>
	<input type="text" name="title" value="">
	<br>
	<b>Date</b>
	<input type="text" name="date" value="">
	<br>
	<b>Summary</b>
	<textarea name="summary"></textarea>
	<br>
	<b>Content</b>
	<textarea name="content"></textarea>
	<br>
	<b>Image</b>
	<input name="image" type="file" accept="image/jpeg"/>
	<br>
	<button type="submit">Add</button>
</form>