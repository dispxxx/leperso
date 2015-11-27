<?php 

$articleManager = new ArticleManager($db);
$userManager = new UserManager($db);
$articles = $articleManager -> read(10);

if (is_array($articles))
{
	for ($i=0, $c = count($articles); $i < $c; $i++)
	{ 
		$article = $articles[$i];
		require('views/content/content_articles_short_article.phtml');
	}
}
else
{
	var_dump($articles);
	$errors[] = $articles;
}