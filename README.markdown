# WackoPicko Vulnerable Website

WackoPicko is a website that contains known vulnerabilities. It was first used for the paper [Why Johnny Can't Pentest: An Analysis of Black-box Web Vulnerability Scanners](http://adamdoupe.com/publications/black-box-scanners-dimva2010.pdf)

## Docker Image

I recently created a
[wackopicko docker image](https://hub.docker.com/r/adamdoupe/wackopicko/),
which is just about the easiest way to run wackopicko.

Simply run the following, which will map your local port `8080` to the
port `80` in the container. Change the `8080` to another port if you
like:

	docker run -p 127.0.0.1:8080:80 -it adamdoupe/wackopicko

Once the docker image is downloaded and running, you should be able to
access wackopicko on your browser:
[http://localhost:8080](http://localhost:8080).

Note that Windows users might need some additional steps to do the
port forwarding correctly. Google is your friend, use it well. 

## Virtual Machine

WackoPicko is now included as an application in the [OWASP Broken Web Applications Project](https://www.owasp.org/index.php/OWASP_Broken_Web_Applications_Project#tab=Main) which is a Virtual Machine with numerous intentionally vulnerable application.

## External Links/Help
* [WackoPicko on aldeid](http://www.aldeid.com/wiki/WackoPicko), a security wiki.

## Install From Source 

First, ensure that short_open_tag PHP ini option is enabled:

http://www.php.net/manual/en/ini.core.php#ini.short-open-tag

Import the WackoPicko database into MySQL using a command like the following:  
  mysql -u <user> -p < current.sql
  
This will create the MySQL user wackopicko with the password webvuln!@# as well as create the wackopicko table.

The wackopicko table contains all of the data that was present while testing the scanners in [Why Johnny Can't Pentest](http://adamdoupe.com/publications/black-box-scanners-dimva2010.pdf).

The final step is to enable read/write access to the upload directory of WackoPicko for the webserver user. An easy way to do this is:  
  chmod 777 -R upload

## Valid Logins

### Regular users
* scanner1/scanner1
* scanner2/scanner2
* bryce/bryce

### Administrator users
* admin/admin
* adamd/adamd

## Known Issues
* The search bar doesn't appear in Internet Explorer.
* There are some onions hanging around (particularly in the upload folder) but I kept them there to preserve parity with the version used during the tests.
* WackoPicko was developed with the assumption that is was running as the root application as the URL and won't work running as a directory.
* WackoPicko uses PHP's short tags, they must be enabled to run the application.

## Vulnerabilities

* Reflected XSS  
http://localhost/pictures/search.php?query=blah  
The query parameter is vulnerable.  

* Stored XSS  
http://localhost/guestbook.php  
The comment field is vulnerable.  

* SessionID vulnerability  
http://localhost/admin/login.php  
The session cookie value is admin_session, which is an auto-incrementing value.  

* Stored SQL Injection  
http://localhost/users/register.php -> http://localhost/users/similar.php  
The first name field of the register users form contains a stored SQL injection which is then used unsanitized on the similar users page.  

* Reflected SQL Injection  
http://localhost/users/login.php  
The username field is vulnerable.  

* Directory Traversal  
http://localhost/pictures/upload.php  
The tag field has a directory traversal vulnerability enabling a malicious users to overwrite any file the web server uses has access to.  

* Multi-Step Stored XSS  
http://localhost/pictures/view.php?picid=3  
The comment field is vulnerable to XSS, however must go through a preview form.  

* Forceful Browsing  
http://localhost/pictures/highquality.php?picid=3&key=highquality  
The user doesn't have to purchase the picture to see the high quality version.

* Command-line Injection  
http://localhost/passcheck.php  
The password field is vulnerable to a command line injections.  

* File Inclusion  
http://localhost/admin/index.php?page=login  
The page is vulnerable to a file inclusion vulnerability, however you have to include %00 at the end.  

* Parameter Manipulation  
http://localhost/users/sample.php?userid=1  
The userid parameter can be manipulated to see any user's page when you need to be logged in otherwise.  

* Reflected XSS Behind JavaScript  
http://localhost/piccheck.php  
The name parameter is vulnerable.  

* Logic Flaw  
http://localhost/cart/review.php  
A coupon can be applied multiple times reducing the price of an order to zero. The coupon in the initial data is SUPERYOU21.  

* Reflected XSS Behind a Flash Form  
http://localhost/submitname.php  
The value parameter is vulnerable.  

* Weak username/password  
https://localhost/admin/login.php  
There is a default username/password combination of admin/admin.  

