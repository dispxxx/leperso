<?php 

class user
{

	// Properties
	private $id;
	private $login;
	private $password;


	// Getters
	public function getId()
	{
		return $this -> id;
	}
	public function getLogin()
	{
		return $this -> login;
	}
	public function getHash()
	{
		return $this -> password;
	}


	// Setters
	public function setLogin($login)
	{
		if (strlen($login) > 3 && strlen($login) < 32)
		{
			if (preg_match("#[a-zA-Z0-9]+[ -_']*$#", $login))
			{
				$this -> login = $login;
				return true;
			}
			else
			{
				return 'Username not valid';
			}
		}
		else
		{
			return "Login must be between 4 and 31 characters";
		}
	}
	public function setPassword($password, $password_repeat)
	{
		if (strlen($password) > 3 && strlen($password) < 32)
		{
			if ($password == $password_repeat)
			{
				$this -> password = password_hash($password, PASSWORD_DEFAULT);
				return true;
			}
			else
			{
				return "Passwords don't match";
			}
		}
		else
		{
			return 'Password must be between 4 and 31 characters';
		}
	}
}