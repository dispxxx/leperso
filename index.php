<?php

// Start session
session_start();


// Initialize database
$db = mysqli_connect('localhost', 'root', '2501NUPP', 'leperso');

if ($db === false)
	die(mysqli_connect_error());


// Objects autoloader
spl_autoload_register(function($class)
{
	require('models/'.$class.'.class.php');
});
if (isset($_SESSION['id']))
{
	$userManager = new UserManager($db);
	$currentUser = $userManager -> readById($_SESSION['id']);
}


// Errors
$errors = array();


// Pages
$access_public 	= array('login', 'register', 'articles', 'article');
$access_user 	= array('articles', 'article', 'create_article', 'edit_article', 'logout');


// Handlers
$handlers_public 	= array('login' => 'user', 'register' => 'user');
$handlers_user 		= array('create_article' => 'article', 'edit_article' => 'article');

if (isset($_GET['page']))
{
	// Cannot be put in content_logout.php because header needs to be sent prior to any content
	if ($_GET['page'] === 'logout')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: ?page=articles');
		exit;
	}
	if (in_array($_GET['page'], $access_public) && !isset($_SESSION['id']))
	{
		$page = $_GET['page'];

		if (isset($handlers_public[$_GET['page']]) && !empty($_POST))
		{
			require('controllers/handlers/handler_'.$handlers_public[$_GET['page']].'.php');
		}
	}
	else if (in_array($_GET['page'], $access_user) && isset($_SESSION['id']))
	{
		$page = $_GET['page'];

		if (isset($handlers_user[$_GET['page']]) && !empty($_POST))
		{
			require('controllers/handlers/handler_'.$handlers_user[$_GET['page']].'.php');
		}
	}
	else
	{
		$page = '404';
	}
}
else
{
	if (isset($_SESSION['id']))
	{
		$page = 'article';
	}
	else
	{
		$page = 'login';
	}
}

require('controllers/skel.php');