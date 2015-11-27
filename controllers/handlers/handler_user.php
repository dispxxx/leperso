<?php 

if (isset($_GET['page']))
{

	// Register function
	if ($_GET['page'] == 'register')
	{
		if (isset($_POST['register_login']) && isset($_POST['register_password']))
		{
			$manager 	= new UserManager($db);
			$res 		= $manager -> create($_POST['register_login'], $_POST['register_password'], $_POST['register_password_repeat']);

			if (is_array($res))
			{
				$errors = array_merge($errors, $res);
			}
			else if (is_string($res))
			{
				var_dump($errors);
				$errors[] = $res;
			}
			else
			{
				header('Location: ?page=login');
				exit;
			}
		}
	}

	// Login function
	if ($_GET['page'] == 'login')
	{
		if (isset($_POST['login_login']) && isset($_POST['login_password']))
		{
			$manager 	= new UserManager($db);
			$user 		= $manager -> readByLogin($_POST['login_login']);

			if (is_string($user))
			{
				$errors[] = $user;
			}
			else
			{
				if (password_verify($_POST['login_password'], $user -> getHash()))
				{
					$_SESSION['id'] = $user -> getId();
					header('Location: ?page=articles');
					exit;
				}
				else
				{
					$errors[] = 'Wrong password';
				}
			}
		}
	}
}