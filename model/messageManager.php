<?php 

namespace ProjetBlog\Model; 


class MessageManager extends Manager
 {
 	
	public function addMessage(Message $message)
	{
		$q = $this->db->prepare('INSERT INTO message (name, lastName, mail, message, creationDate) VALUES (:name, :lastName, :mail, :messageContent, NOW())'); 

		$q->bindValue('name', $message->name()); 
		$q->bindValue('lastName', $message->lastName()); 
		$q->bindValue('mail', $message->mail()); 
		$q->bindValue('messageContent', $message->messageContent()); 

		$q->execute(); 

	}
 }