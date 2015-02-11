Impossible Page
=========================
Impossible Page is a free open-source and self-hosted CMS. It is light, quick and simple for building one page website. The Impossible page is extremely extensible and customizable for further development. 


##Requirements
 - PHP >= 5.3
 - Composer latest version
 - MYSQL >= 5.0

##Installation
Download latest code by using GIT. 

###Linux
Execute commond on the root of project folder.

`php composer.phar install`

###Windows
Execute commond on the root of project folder.

`composer install`

###HTTP Server config
Point your HTTP Server document root folder to public folder of project.

##Configuration
All configurations are in `app/config.php`. Please backup this file before update it. 

###Application
For application, you have to set username and password. 

- `login.username`: Backend login username.
- `login.password`: Backend login password.

###Database
The Project requir mysql database server. You need setup config for detail of database server.

- `database_name`: Database name.
- `server`:	Database server ip or host address.
- `username`: Server username.
- `passowrd`: Server password.
- `port`: Server port number.

###Email
The CMS has plugin for sending email via Mandrill service. In order to use this service, you have to put you API detail into configuration.

- `Username`: Your Mandrill API username
- `password`: API key, NOT YOUR MANDRILL ACCOUNT PASSWORD.
- `host`: Mandrill API host address
- `email_to`: Email target address
- `email_to_name`: Email target name.

 
`NOTE: BCC is not working at moment.`


##Get Start
Before get start with impossible page, the database should be initialized. After finish configuration, access http://youdomain.com/installer, the script will setup database automatically.

Now, Simply access backend via http://youdomain.com/login with your username and password.

NOTE: If database has been successfully setup. the installer should be disabled. Please change `installer` item to `false` in config.php, in order to disable installer.

##Demo

Official Website : [http://impossiblepage.com/](http://impossiblepage.com/ "Impossible Page")