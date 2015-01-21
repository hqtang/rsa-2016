<?php

class Default_page
{
	private $app = null;
	private $model = null;
	private $comment = null;
	private $page_data = null;
	public function __construct($arguments)
	{
		$this->app 			= $arguments['app'];
		$this->model  		= $arguments['model'];
		$this->comment  	= $arguments['comment'];
	}

	public function index()
	{
		$this->page_data['error_message'] = "";
		
		$search_options = array(

				'AND'=>array(
						'type'	=>	11
						,'enabled'	=>	1
					)
				,"ORDER" => "sort_order, section_id ASC"
			);
		$sections = $this->model->get_sections($search_options);

		if(empty($sections))
		{
			$this->page_data['error_message'] = "Couldn't find page header.";
		}
		else
		{
			$section = $sections[0];
			$this->page_data['header'] = 	$section['content'];
		}

		$search_options = array(

				'AND'=>array(
						'type'	=>	12
						,'enabled'	=>	1
					)
				,"ORDER" => "sort_order, section_id ASC"
			);
		$sections = $this->model->get_sections($search_options);

		if(empty($sections))
		{
			$this->page_data['error_message'] = "Couldn't find page body.";
		}
		else
		{
			$this->page_data['body'] = "";
			foreach($sections as $section)
			{
				$this->page_data['body'] .= 	$section['content'];
			}
			
		}

		$search_options = array(

				'AND'=>array(
						'type'	=>	13
						,'enabled'	=>	1
					)
				,"ORDER" => "sort_order, section_id ASC"
			);
		$sections = $this->model->get_sections($search_options);

		if(empty($sections))
		{
			$this->page_data['error_message'] = "Couldn't find page footer.";
		}
		else
		{
			$section = $sections[0];
			$this->page_data['footer'] = 	$section['content'];
		}

		if($this->page_data['error_message'] != "")
		{
			$this->app->render('default_page.html', array());	
		}
		else
		{
			echo $this->page_data['header'];
			echo $this->page_data['body'];
			echo $this->page_data['footer'];
			die;			
		}
		
	}

	public function comment($name, $email, $phone, $message, $email_config)
	{
		$comment = array(
				'name'		=>	$name
				,'email'	=>	$email
				,'phone'	=>	$phone
				,'message'	=>	$message
			);

		$comment_id = $this->comment->store_comment($comment);

		$message = array(
				'result'	=>	true
				,'message'	=>	"Message has been send. We will contact you as soon as possible."
			);

		$email_result = $this->comment->send_email($comment, $email_config);
		
		if($email_result)
		{
			return true;	
		}
	}


	public function css($name)
	{
		$this->app->response->headers->set('Content-Type', 'text/css');
		$search_options = array(

				'AND'=>array(
						'type'	=>	0
						,'enabled'	=>	1
						,'name'		=>	$name
					)
				,"ORDER" => "sort_order, section_id ASC"
			);
		$sections = $this->model->get_sections($search_options);

		if(empty($sections))
		{
			echo "";
			die;
		}
		else
		{
			$section = $sections[0];
			echo $section['content'];
		}
	}

	public function js()
	{
		$this->app->response->headers->set('Content-Type', 'text/javascript');
		$search_options = array(

				'AND'=>array(
						'type'	=>	1
						,'enabled'	=>	1
						,'name'		=>	$name
					)
				,"ORDER" => "sort_order, section_id ASC"
			);
		$sections = $this->model->get_sections($search_options);

		if(empty($sections))
		{
			echo "";
			die;
		}
		else
		{
			$section = $sections[0];
			echo $section['content'];
		}	
	}
}