<?php 

$articleManager = new ArticleManager($db);

if (isset($_GET['id']))
{
	$id = intval($_GET['id']);
	$article = $articleManager -> readById($id);

	if (is_object($article))
	{
		require('views/content/content_article.phtml');
	}
	else
	{
		header('Location: ?page=404');
		exit;
	}
}
