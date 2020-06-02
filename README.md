# codeIgnitor
Client On Boarding Portal

How To Install: 
1: Navigate to x\A\config\config.php
change the below to match your install path
$config['base_url'] = 'http://localhost/onboard';

2: Navigate to x\A\config\database.php
change the following to match your database configuration
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'onboard',
The database file is : onboard.sql.gz

3: to access the admin panel
localhost/<your-install-path>/index.php/admin/
usernam: admin@admin.com
password: admin1234567

4: to access the form
localhost/<your-install-path>

I am no longer developing this project

Features
Form desined using materialize css
Admin using bootstrap
sort feature on tables
search feature
pdf file generator
sending email with attachment
inline table edit
option to crete a chart based on gojs
option to send data to api using json and getting back result. (code in form controller)
recaptcha integration
jquery validation