<?php

$app = new Slim\Slim($config['config']);

$session = new Session();


$arguments = array(
			'app'		=>	$app
		,	'db'		=>	$db
		,	'session'	=>	$session
	);

$section 				= new Section($arguments);
$comment 				= new Comment($arguments);
$email_config			= $config['email'];
//$email					= new Mandrill($email_config['key']);


$arguments['model'] 	= $section;
$arguments['comment'] 	= $comment;

$login 					= new Login($arguments);
$default_page 			= new Default_page($arguments);
$deshboard 				= new Dashboard($arguments);




$app->get('/', 										function () use ($default_page){
    $default_page->index();
});


$app->post('/comment', 								function () use ($default_page, $app, $email_config){
    $name = $app->request->post('name');
	$email = $app->request->post('email');
	$phone = $app->request->post('phone');
	$message = $app->request->post('message');
    $default_page->comment($name, $email, $phone, $message, $email_config);
});

$app->get('/css/:name.css', 						function ($name) use ($default_page){
    $default_page->css(trim($name));
});

$app->get('/dashboard', 							function () use ($deshboard){
	$deshboard->index();
});


$app->get('/dashboard/new-section', 				function () use ($deshboard){
	$deshboard->new_section("show", "", "", "", "");
});

$app->post('/dashboard/new-section', 				function () use ($deshboard, $app){
	$name = $app->request->post('name');
	$desc = $app->request->post('desc');
	$type = $app->request->post('type');
	$code = $app->request->post('code');
	$deshboard->new_section("new", $type, $name, $desc, $code);
});

$app->get('/dashboard/update-section-status/:id', 	function ($id) use ($deshboard){
	$deshboard->update_section_status($id);
});

$app->get('/dashboard/remove-section/:id', 			function ($id) use ($deshboard){
	$deshboard->remove_section($id);
});

$app->get('/dashboard/update-section/:id', 			function ($id) use ($deshboard){
	$deshboard->update_section($id, "show", "", "", "", "");
});

$app->get('/dashboard/sort-sections', 				function () use ($deshboard){
	
	$deshboard->sort_sections();
});

$app->post('/dashboard/sort-sections', 				function () use ($deshboard, $app){
	$sort_order = $app->request->post('sort_order');

	$deshboard->sort_sections($sort_order);
});

$app->post('/dashboard/update-section/:id', 		function ($id) use ($deshboard, $app){

	$name = $app->request->post('name');
	$desc = $app->request->post('desc');
	$type = $app->request->post('type');
	$code = $app->request->post('code');

	$deshboard->update_section($id, "update", $type, $name, $desc, $code);
});

$app->get('/login', 								function () use ($login){
	$login->index();
});

$app->get('/logout', 								function () use ($login){
	$login->logout();
});

$app->post('/login', 								function () use ($login, $app){
	
	$login_username = $app->request->post('username');
	$login_password = $app->request->post('password');

	$login->index($login_username, $login_password);

});



/*ERROR PAGE*/
$app->error(function (\Exception $e) use ($default_page) {
	
	$page_data['error'] = new Exception();
	$page_data['type'] = 500;
	$default_page->error($page_data);
});

$app->notFound(function () 			use ($default_page) {
    $page_data['type'] = 404;
	$default_page->error($page_data);
});

$app->run();