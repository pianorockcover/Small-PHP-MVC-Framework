<?php
use \widgets\TreeView;
?>
<h1>Категории</h1>
<?php (new TreeView)->widget($params['categories']) ?>