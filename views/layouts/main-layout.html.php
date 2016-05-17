<?php
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: " . gmdate("D, d M Y H:i:s")." GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Cache-Control: post-check=0,pre-check=0", false);
  header("Cache-Control: max-age=0", false);
  header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?= $params['title'] ?></title>

	<link rel="stylesheet/less" type="text/css" href="assets/less/site.less" />
	<script src="assets/bower_components/less/dist/less.min.js" type="text/javascript"></script>
</head>
<body>
	<div class="container">
		<?= $content ?>
	</div>
</body>
</html>