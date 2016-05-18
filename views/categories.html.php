<?php
use \widgets\TreeView;
?>
<a class="btn btn-default" href="index.php">На главную</a>
<h1>Категории</h1>
<?php (new TreeView)->widget($params['categories']) ?>