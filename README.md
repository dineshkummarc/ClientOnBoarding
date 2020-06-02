# codeIgnitor
Client On Boarding Portal

How To Install: 

1: Navigate to x\A\config\config.php<br />
change the below to match your install path<br />
$config['base_url'] = 'http://localhost/onboard';

2: Navigate to x\A\config\database.php<br />
change the following to match your database configuration<br />
	'hostname' => 'localhost',<br />
	'username' => 'root',<br />
	'password' => '',<br />
	'database' => 'onboard',<br />
The database file is : onboard.sql.gz

3: to access the admin panel<br />
localhost/<your-install-path>/index.php/admin/<br />
usernam: admin@admin.com<br />
password: admin1234567

4: to access the form<br />
localhost/<your-install-path>

I am no longer developing this project

Features<br />
Form desined using materialize css<br />
Admin using bootstrap<br />
sort feature on tables<br />
search feature<br />
pdf file generator<br />
sending email with attachment<br />
inline table edit<br />
option to crete a chart based on gojs<br />
option to send data to api using json and getting back result. (code in form controller)<br />
recaptcha integration<br />
jquery validation
