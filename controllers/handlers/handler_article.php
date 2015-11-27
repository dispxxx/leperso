<?php 

if (isset($_GET['page']))
{
	if ($_GET['page'] == 'create_article')
	{
		if (isset($_POST['create_title'], $_POST['create_content']))
		{
			$manager 	= new ArticleManager($db);
			$res		= $manager -> create($currentUser, $_POST['create_title'], $_POST['create_content']);

			if (is_string($res))
			{
				$errors[] = $res;
			}
			else
			{
				header('Location: ?page=articles');
				exit;
			}
		}
	}
	if ($_GET['page'] == 'edit_article')
	{
		if (isset($_POST['edit_title'], $_POST['edit_content'], $_GET['id']))
		{
			$id 			= intval($_GET['id']);
			$edit_title 	= mysqli_escape_string($db, $_POST['edit_title']);
			$edit_content 	= mysqli_escape_string($db, $_POST['edit_content']);
			$articleManager 		= new ArticleManager($db);
			
			if ($article = $articleManager -> readById($id))
			{
				$errors[] 	= $article -> setTitle($edit_title);
				$errors[] 	= $article -> setContent($edit_content);
				$errors 	= array_filter($errors, function($value)
				{
					return $value !== true;
				});

				if (count($errors) == 0)
				{
					$res = $articleManager -> update($article);

					if (is_string($res))
					{
						$errors[] = $res;
					}
					else
					{
						header('Location: ?page=article&id='.$article -> getId());
						exit;
					}
				}
			}
			else
			{
				$errors[] = 'Article not found';
			}
		}
	}
}