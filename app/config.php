<?php
$config = array(
	'config'	=>	array(
						'mode'									=>	'development', //production
						'debug'									=>	true,
						'log.enable' 						=>	true,
						'log.level' 						=>	4,
						'templates.path'				=>	dirname(__FILE__)."/views/default",
						'templates.dashboard'		=>	dirname(__FILE__)."/views/dashboard",
						'login.username'				=>	"user",
						'login.password'				=>	"password",
            'session'             	=> null
		),

	'db'		=>	new medoo([
						// required
						'database_type' 				=> 'mysql',
						'database_name' 				=> '_YOUR_DATABASE_NAME_',
						'server' 								=> '_YOUR_DATABASE_SERVER_ADDRESS_',
						'username' 							=> '_YOUR_DATABASE_USERNAME_',
						'password' 							=> '_YOUR_DATABASE_PASSWORD_',
						'port' 									=> 3306,
						'charset' 							=> 'utf8',
		]),

	'email'	=>	array(
            'enable'								=>  true
            ,'username'							=>	"_YOUR_EMAIL_USERNAME_"
            ,'password'   					=>  "_YOUR_EMAIL_PASSWORD_"
            ,'host'									=>	"_YOUR_EMAIL_SERVER_ADDRESS_"
            ,'port'									=>	587
            ,'email_to'							=>	"_YOUR_EMAIL_ADDRESS_"
            ,'email_to_name'				=> "_YOUR_NAME_"
            ,'email_bcc'						=>	""
            ,'subject'							=> "Web Message from "

            /* EMAIL TEMPLATE */
            
            ,'body'									=>	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Really Simple HTML Email Template</title>
<style>
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin: 0;
	padding: 0;
	font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
}

img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
a {
	color: #348eda;
}

.btn-primary {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.btn-secondary {
	text-decoration: none;
	color: #FFF;
	background-color: #aaa;
	border: solid #aaa;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.last {
	margin-bottom: 0;
}

.first {
	margin-top: 0;
}

.padding {
	padding: 10px 0;
}


/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}

table.body-wrap .container {
	border: 1px solid #f0f0f0;
}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;	
	clear: both!important;
}

.footer-wrap .container p {
	font-size: 12px;
	color: #666;
	
}

table.footer-wrap a {
	color: #999;
}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
	font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	line-height: 1.1;
	margin-bottom: 15px;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}

h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}

ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}



/* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
.container {
	display: block!important;
	max-width: 600px!important;
	margin: 0 auto!important; /* makes it centered */
	clear: both!important;
}

/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
	padding: 20px;
}

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	max-width: 600px;
	margin: 0 auto;
	display: block;
}

.content table {
	width: 100%;
}

</style>
</head>

<body bgcolor="#f6f6f6">

<!-- body -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<!-- content -->
			<div class="content">
			<table>
				<tr>
					<td>
						<p>Hi there,</p>
						<p><b>{::name}</b> just leave a message on website.</p>

						<p>{::message}</p>
						<h2>Please use following detail to contact <b>{::name}</b></h2>
						
						<table>
							<tr>
								<td class="padding">
									<b>Phone</b>: 
								</td>
								<td class="padding">
									{::phone}
								</td>
							</tr>
							<tr>
								<td class="padding">
									<b>Email</b>: 
								</td>
								<td class="padding">
									{::email}
								</td>
							</tr>
						</table>
						
					</td>
				</tr>
			</table>
			</div>
			<!-- /content -->
			
		</td>
		<td></td>
	</tr>
</table>
<!-- /body -->

<!-- footer -->

<!-- /footer -->

</body>
</html>'
		),

);


$db = $config['db'];
