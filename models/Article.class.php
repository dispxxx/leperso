<?php 

class Article
{

	// Properties
	private $id;
	private $id_user;
	private $user;
	private $title;
	private $content;
	private $date;
	private $db;


	// Constructor
	public function __construct($db)
	{
		$this->db = $db;
	}


	// Getters
	public function getId()
	{
		return $this -> id;
	}
	public function getIdUser()
	{
		return $this -> id_user;
	}
	public function getUser()
	{
		if (!$this -> user)
		{
			$query 	= 'SELECT * FROM user WHERE id='.$this -> id_user;
			$res 	= mysqli_query($this -> db, $query);

			if ($res && ($user = mysqli_fetch_object($res, 'User')))
			{
				$this -> user = $user;
			}
		}
		return $this -> user;
	}
	public function getTitle()
	{
		return $this -> title;
	}
	public function getContent()
	{
		return $this -> content;
	}
	public function getDate()
	{
		return $this -> date;
	}


	// Setters
	public function setIdUser($id)
	{
		$this -> id_user = $id;
		return true;
	}
	public function setUser(User $user)
	{
		$this -> user = $user;
		return true;
	}
	public function setTitle($title)
	{
		if (strlen($title) > 5 && strlen($title) < 127)
		{
			if (preg_match("#[a-zA-Z0-9]+[ -_']*$#", $title))
			{
				$this -> title = $title;
				return true;
			}
			else
			{
				return 'Title not valid';
			}
		}
		else
		{
			return 'Title must be between 6 and 127 characters';
		}
	}
	public function setContent($content)
	{
		if (strlen($content) > 15 && strlen($content) < 2047)
		{
			$this -> content = $content;
			return true;
		}
		else
		{
			return 'Content must be between 16 and 2046 characters';
		}
	}
}