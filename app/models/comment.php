<?php

class Comment
{
	private $db = null;
	
	public function __construct($arguments)
	{
		$this->db  = $arguments['db'];
	}

	public function store_comment($comment)
	{
		$comment['read']	=	0;
		$comment['flag']	=	0;
		$comment['created_at']	=	date('c');

		$last_id = $this->db->insert("impage_comments", $comment);
		return $last_id;
	}

	public function send_email($comment, $email_config)
	{
		$mail = new PHPMailer;

		$mail->IsSMTP();
		$mail->Host = $email_config['host'];
		$mail->Port = $email_config['port'];
		$mail->SMTPAuth = true;
		$mail->Username = $email_config['username'];
		$mail->Password = $email_config['password'];
		$mail->SMTPSecure = 'tls';

		$mail->From = $comment['email'];
		$mail->FromName = $comment['name'];
		$mail->AddAddress($email_config['email_to'], $email_config['email_to_name']);
		

		$mail->IsHTML(true);

		$mail->Subject = $email_config['subject'].$comment['name'];

		$mail->Body = $this->process_message($comment, $email_config['body']);

		if(!$mail->Send()) {
		   return false;
		}


	    return true;
	}

	private function process_message($comment, $body)
	{
		$body = str_replace("{::name}", $comment['name'], $body);
		$body = str_replace("{::email}", $comment['email'], $body);
		$body = str_replace("{::phone}", $comment['phone'], $body);
		$body = str_replace("{::message}", $comment['message'], $body);

		return $body;
	}

}