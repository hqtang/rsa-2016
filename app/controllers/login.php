<?php


class Login
{
	private $app = null;
	private $model = null;
	private $session = null;
	private $view = null;
	private $page_data = array();
	
	public function __construct($arguments)
	{
		$this->app = $arguments['app'];
		
		$this->session  = $arguments['session'];
		
		$this->view = new \Slim\View();
		$prop2 = new \ReflectionProperty($this->view, 'templatesDirectory');
        $prop2->setAccessible(true);
        $prop2->setValue($this->view, $this->app->config('templates.dashboard'));

        $this->page_data['site_name'] = "Impossible Page";
        $this->page_data['logined'] = $this->session->get_userdata("logined");
		
	}

	
	public function index($login_username = "", $login_password = "")
	{

		if($this->session->get_userdata("logined") === true)
		{
			$this->app->redirect('/dashboard');
		}
		
		
		$this->page_data['message'] = "";
		if($login_password != "" && $login_username != "")
		{
			if($login_password == $this->app->config('login.password') && $login_username == $this->app->config('login.username'))
			{
				$this->session->set_userdata("logined", true);
				$this->app->redirect('dashboard');
			}
			else
			{
				$this->page_data['message'] = "Error username or password";
			}
		}
		
		
		$this->view("login.php");
	}

	public function logout()
	{
		$this->session->destroy();
		$this->app->redirect('/login');
	}

	private function view($page)
	{
		$prop1 = new \ReflectionProperty($this->view, 'data');
        $prop1->setAccessible(true);
        $prop1->setValue($this->view, new \Slim\Helper\Set($this->page_data));
        $this->view->display("header.php");
		$this->view->display($page);
		$this->view->display("footer.php");
	}

}