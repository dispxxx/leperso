<?php 

class UserManager
{

	// Properties
	private $db;


	// Constructor
	public function __construct($db)
	{
		$this -> db = $db;
	}


	// Functions
	public function create($login, $password, $password_repeat)
	{
		$errors 	= array();
		$user 		= new User();
		$errors[] 	= $user -> setLogin($login);
		$errors[] 	= $user -> setPassword($password, $password_repeat);
		$errors 	= array_filter($errors, function($value)
		{
			return $value !== true;
		});
		if (count($errors) == 0)
		{
			$login 		= mysqli_escape_string($this -> db, $user -> getLogin());
			$password 	= $user -> getHash();
			$query		= '	INSERT INTO user (login, password)
							VALUES ("'.$login.'","'.$password.'")';
			$res		= mysqli_query($this -> db, $query);

			if ($res)
			{
				$id = mysqli_insert_id($this -> db);
				if ($id)
				{
					return $this -> readById($id);					
				}
				else
				{
					return '01 : Database error';
				}
			}
			else
			{
				return 'User already exist';
			}
		}
		else
		{
			return $errors;
		}
	}
	public function readById($id)
	{
		$query 	= 'SELECT * FROM user WHERE id = '.$id;
		$res 	= mysqli_query($this -> db, $query);

		if ($res)
		{
			if ($user = mysqli_fetch_object($res, 'User'))
			{
				return $user;
			}
			else
			{
				return 'User not found';
			}
		}
		else
		{
			return '02 : Database error';
		}
	}
	public function readByLogin($login)
	{
		$login 	= mysqli_escape_string($this -> db, $login);
		$query 	= 'SELECT * FROM user WHERE login = "'.$login.'"';
		$res 	= mysqli_query($this -> db, $query);

		if ($res)
		{
			if ($user = mysqli_fetch_object($res, 'User'))
			{
				return $user;
			}
			else
			{
				return 'User not found';
			}
		}
		else
		{
			return '03 : Database error';
		}
	}
	public function update(User $user)
	{
		$id 	= $user -> getId();
		$login 	= $user -> getLogin();
		$hash 	= $user -> getHash();
		$query 	= '	UPDATE user
					SET login = "'.$login.'", password = "'.$hash.'"
					WHERE id = '.$id;
		$res 	= mysqli_query($this -> db, $query);

		if ($res)
		{
			return $this -> findById($id);
		}
		else
		{
			return '04 : Database error';
		}
	}
	public function delete(User $user)
	{
		$id 	= $user -> getId();
		$query 	= 'DELETE FROM user WHERE id = '.$id;
		$res 	= mysqli_query($this -> db, $query);

		if ($res)
		{
			return true;
		}
		else
		{
			return '05 : Database error';
		}
	}
}