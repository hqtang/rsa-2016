<?php

/*
TODO
	DONE- add enable col into table
	DONE- finish enable/disable function
	DONE- finish remove function
	- message type (success or error)
	DONE- redirect to list page with success info after create/update section
	DONE- sort order 
	- clear function params (model)
 */


class Dashboard
{
	private $app = null;
	private $model = null;
	private $session = null;
	private $view = null;
	private $page_data = array();
	
	public function __construct($arguments)
	{
		$this->app = $arguments['app'];
		$this->model  = $arguments['model'];
		$this->session  = $arguments['session'];
		
		//$this->app->view()->setTemplatesDirectory($this->app->config('templates.dashboard'));
		
		$this->view = new \Slim\View();
		$prop2 = new \ReflectionProperty($this->view, 'templatesDirectory');
        $prop2->setAccessible(true);
        $prop2->setValue($this->view, $this->app->config('templates.dashboard'));

        $this->page_data['site_name'] = "Impossible Page";
        $this->page_data['logined'] = $this->session->get_userdata("logined");
        $this->page_data['section_type'] = array(
        		'0'	=> "css"
        		,'1'	=> "js"
        		,'11'	=>	"header"
        		,'12'	=>	"body"
        		,'13'	=>	"footer"
        	);
        
        
	}

	public function index()
	{
		 //$this->app->render('dashboard.php', array());
		$this->check_login();
		$error_message = $this->session->get_flashdata("error_message");
		if($error_message != false)
		{
			$this->page_data['error_message'] = $error_message;
		}
		$success_message = $this->session->get_flashdata("success_message");
		if($success_message != false)
		{
			$this->page_data['success_message'] = $success_message;
		}
		$search_options = array("ORDER" => "sort_order, section_id ASC");
	 	$sections = $this->model->get_sections($search_options);
	 	$this->page_data['sections'] = $sections;
	 	$this->view("dashboard.php");
		 	 
	}

	public function remove_section($id)
	{
		$this->check_login();
		$search_options = array('section_id' => $id);
		$sections = $this->model->get_sections($search_options);
		if(!empty($sections))
		{
			$section = $sections[0];
			if($section['enabled'] == 1)
			{
				$this->session->set_flashdata("error_message", "Section is enabled, couldn't remove.");
				$this->app->redirect('/dashboard');
			}
			else
			{
				$section = array(
						'section_id'	=>	$id
						);
				$this->model->remove_section($section);
				$this->session->set_flashdata("success_message", "Section has been removed");
				$this->app->redirect('/dashboard');	
			}

		}
	}

	public function new_section($option, $type, $name, $desc, $code, $submit)
	{
		$this->check_login();
		$this->page_data['message'] = "";
		$this->page_data['option'] = "new";
		if($option == "new" && trim($name) == "")
		{
			$this->page_data['message'] = "Name should not empty!";
		}
		else if($option !="show" )
		{
			$section_id = $this->model->add_section($type, $name, $desc, $code);
			$this->session->set_flashdata("success_message", "Section has been created");
			$this->app->redirect('/dashboard');	
			
		}

		$this->view("new-section.php");
	}

	public function update_section($id, $option, $type, $name, $desc, $code, $submit)
	{
		$this->check_login();
		$this->page_data['option'] = "update";
		$this->page_data['section_id'] = $id;
		if(trim($id) == "" || !is_numeric($id))
		{
			$this->session->set_flashdata("error_message", "Error Section ID");
			$this->app->redirect('/dashboard');
		}
		else
		{
			if($option == "update" && trim($name) == "")
			{
				$this->page_data['message'] = "Name should not empty!";
			}
			else if($option != "show")
			{
				$update_section = array(
					'id'	=>	$id
					,'name'	=> $name
					,'type'	=>	$type
					,'desc'	=>	$desc
					,'content'	=>	$code
				);
				$this->model->update_section($update_section);
				$this->session->set_flashdata("success_message", "Section has been updated");
				if($submit == "Save and Close")
				{
					$this->app->redirect('/dashboard');
				}
				
			}

			$search_options = array('section_id' => $id);
			$sections = $this->model->get_sections($search_options);
			if(!empty($sections))
			{
				$section = $sections[0];
				$this->page_data['section'] = $section;

			}
			else
			{
				$this->session->set_flashdata("error_message", "Could't find Section");
				$this->app->redirect('/dashboard');			
			}
		}
		$this->view("new-section.php");
	}
	
	public function update_section_status($id)
	{
		$this->check_login();
		$search_options = array('section_id' => $id);
		$sections = $this->model->get_sections($search_options);
		if(!empty($sections))
		{
			$section = $sections[0];
			if($section['enabled'] == 0)
			{
				$update_section = array(
						'id'	=>	$id
						,'enabled'	=>	1
					);
				$this->model->update_section($update_section);
			}
			else
			{
				$update_section = array(
						'id'	=>	$id
						,'enabled'	=>	0
					);
				$this->model->update_section($update_section);
			}
			$this->session->set_flashdata("success_message", "Section status has been updated");
			$this->app->redirect('/dashboard');	

		}
		else
		{
			$this->session->set_flashdata("error_message", "Could't find Section");
			$this->app->redirect('/dashboard');			
		}
	}

	public function sort_sections($sort_order = array())
	{
		$this->check_login();
		if(!empty($sort_order))
		{
			foreach($sort_order as $key=>$section)
			{
				$update_section = array(
						'id'			=>	$section
						,'sort_order'	=>	10 + $key
					);
				$this->model->update_section($update_section);
			}
			$this->session->set_flashdata("success_message", "Sections have been sorted. ");
			$this->app->redirect('/dashboard');	
		}

		$search_options = array( 'type' => 12 , "ORDER" => "sort_order, section_id ASC",);
		$sections = $this->model->get_sections($search_options);
		$this->page_data['sections'] = $sections;
		$this->view("sort_sections.php");
	}

	private function view($page)
	{
		$this->check_login();
		$prop1 = new \ReflectionProperty($this->view, 'data');
        $prop1->setAccessible(true);
        $prop1->setValue($this->view, new \Slim\Helper\Set($this->page_data));
        $this->view->display("header.php");
		$this->view->display($page);
		$this->view->display("footer.php");
	}

	private function check_login()
	{
		if($this->session->get_userdata("logined")  === false)
		{
			$this->app->redirect("/login");		
		}
	}

	public function installer()
	{
		//installer
		if($this->app->config('installer') === true)
		{
			//SHOW TABLES LIKE tablename;
			$data = $this->model->create_database();
			
			if($this->model->check_database() == true)
			{
				$this->app->redirect("/");
			}
		}

		$this->app->redirect("/");

	}
}