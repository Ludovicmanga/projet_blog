<?php

namespace Openclassrooms\blog; 

class PostManager
{

	protected $db; 

	// construct

	public function __construct()
	{
		$this->db = new \PDO('mysql:host=localhost;dbname=projet_blog;charset=utf8', 'root', '');
	}

	public function getAllPosts()
	{
		
		$req = $this->db->query('SELECT *, post.id AS post_id, name AS author FROM post INNER JOIN user WHERE post.userId = user.id ORDER BY creationDate DESC LIMIT 0,5'); 
		return $req; 
	}

	public function getPost($postId)
	{
		
		$req = $this->db->prepare('SELECT post.*, user.name as author FROM post INNER JOIN user WHERE user.id = post.userId AND post.id = ?'); 
		$req->execute(array ($postId)); 
		$post = $req->fetch(); 

		return $post; 
	}

	public function updatePost(Post $post)
	{
		$q = $this->db->prepare('UPDATE post SET title = :title, topic = :topic, subtitle = :subtitle, content = :content, creationDate = creationDate, modificationDate = NOW() WHERE id = :id');           

		$q->bindValue(':title', $post->title(), \PDO::PARAM_INT); 
		$q->bindValue(':topic', $post->topic(), \PDO::PARAM_INT); 
		$q->bindValue(':content', $post->content(), \PDO::PARAM_INT); 
		$q->bindValue(':subtitle', $post->subtitle(), \PDO::PARAM_INT); 
		$q->bindValue(':creationDate', $post->creationDate(), \PDO::PARAM_INT);
		$q->bindValue(':id', $post->id(), \PDO::PARAM_INT); 

		$q->execute(); 

	}

	public function addPost(Post $post)
	{
		$q = $this->db->prepare('INSERT INTO post (title, subtitle, topic, content) VALUES (:title, :subtitle, :topic, :content)'); 

		$q->bindValue('title', $post->title()); 
		$q->bindValue('subtitle', $post->subtitle()); 
		$q->bindValue('topic', $post->topic()); 
		$q->bindValue('content', $post->content()); 

		$q->execute(); 
	}
}

