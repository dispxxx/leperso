<?php 

class ArticleManager
{

	// Properties
	private $db;

	
	// Constructor
	public function __construct($db)
	{
		$this -> db = $db;
	}


	// Functions
	public function create(User $user, $title, $content)
	{
		$article 	= new Article($this -> db);
		$errors 	= array();
		$errors[] 	= $article -> setUser($user);
		$errors[]	= $article -> setIdUser($user -> getId());
		$errors[] 	= $article -> setTitle($title);
		$errors[] 	= $article -> setContent($content);
		$errors 	= array_filter($errors, function($value)
		{
			return $value !== true;
		});
		if (count($errors) == 0)
		{
			$id_user 	= intval($article -> getIdUser());
			$title 		= mysqli_escape_string($this -> db, $article -> getTitle());
			$content 	= mysqli_escape_string($this -> db, $article -> getContent());
			$query 		= '	INSERT INTO article (id_user, title, content)
							VALUES ("'.$id_user.'","'.$title.'","'.$content.'")';
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
					return 'Internal server error';
				}
			}
			else
			{
				return mysqli_error($this -> db);
			}
		}
		else
		{
			return $errors;
		}
	}
	public function read($n)
	{
		$n = intval($n);
		$query = 'SELECT * FROM article ORDER BY `date` DESC LIMIT '.$n;
		$res = mysqli_query($this -> db, $query);

		if ($res)
		{
			$articles = array();
			
			while ($article = mysqli_fetch_object($res, 'Article', array($this -> db)))
			{
				$articles[] = $article;
			}
			if (count($articles) > 0)
			{
				return $articles;
			}
			else
			{
				return 'No article to show';
			}
		}
		else
		{
			return 'Error 01 : Database error';
		}
	}
	public function readById($id)
	{
		$query = 'SELECT * FROM article WHERE id = '.$id;
		$res = mysqli_query($this -> db, $query);

		if ($res)
		{
			if ($article = mysqli_fetch_object($res, 'Article', array($this -> db)))
			{
				return $article;
			}
			else
			{
				return 'Article not found';
			}
		}
		else
		{
			return 'Error 02 : Database error';
		}
	}
	public function readByUser(User $user)
	{
		$id_sender = $User -> getId();
		$query = 'SELECT * FROM article WHERE id_sender = '.$id_sender;
		$res = mysqli_query($this -> db, $query);

		if ($res)
		{
			if($article = mysqli_fetch_object($res, 'Article', array($this -> db)))
			{
				return $article;
			}
		}
		else
		{
			return 'Error 03 : Database error';
		}
	}
	public function readByDate($date)
	{
		$query = 'SELECT * FROM article WHERE `date` = '.$date;
		$res = mysqli_query($this -> db, $query);

		if ($res)
		{
			if($article = mysqli_fetch_object($res, 'Article', array($this -> db)))
			{
				return $article;
			}
		}
		else
		{
			return 'Error 04 : Database error';
		}
	}
	public function update(Article $article)
	{
		$id 		= $article -> getId();
		$id_user 	= $article -> getIdUser();
		$title 		= $article -> getTitle();
		$content 	= $article -> getContent();
		$date 		= $article -> getDate();
		$query 		= '	UPDATE article
						SET id_user = "'.$id_user.'", title = "'.$title.'", content = "'.$content.'", date = "'.$date.'"
						WHERE id = '.$id;
		$res 		= mysqli_query($this -> db, $query);

		if ($res)
		{
			return $this -> readById($id);
		}
		else
		{
			return 'Error 05 : Database error';
		}
	}
	public function delete(Article $article)
	{
		$id 	= $article -> getId();
		$query 	= 'DELETE FROM article WHERE id = '.$id;
		$res 	= mysqli_query($this -> db, $query);

		if ($res)
		{
			return true;
		}
		else
		{
			return 'Error 07 : Database error';
		}
	}
}