# WackoPicko Vulnerable Website

WackoPicko is a website that contains known vulnerabilities. It was first used for the paper [Why Johnny Can't Pentest: An Analysis of Black-box Web Vulnerability Scanners](http://cs.ucsb.edu/~adoupe/static/black-box-scanners-dimva2010.pdf)

## External Links/Help
* [WackoPicko on aldeid](http://www.aldeid.com/index.php/WackoPicko), a security wiki.

### Converting VMware Image to VirtualBox
This was sent to me by Matthew Harbage, to get the VMware image working on VirtualBox on a Windows host:

> Two actions to get the virtualized version of WackoPicko working so you can connect to Apache from the host machine (using VirtualBox)
> 
> 1. On the guest: delete /etc/udev/rules.d/70-persistent-net.rules (to clear MAC address details of the adapter from the machine the virual image was greated by). This enables Ubuntu to enable the (virtualized) network adapter.
> 
> 2. On the host: map port 80 through from the guest to be accessible from the host using 
> 
> "C:\Program Files\Oracle\VirtualBox\VBoxManage.exe" modifyvm "X" --natpf1 "guestweb,tcp,,8888,,80"
>
> where X is the name of the VirtualBox virual machine.
>
> This means in your favourate browser from your host machine, you can access WackoPicko via:
> http://[ip-address of VirtualBox adapter]:8888


## Install From Source 
Import the WackoPicko database into MySQL using a command like the following:  
  mysql -u <user> -p < current.sql
  
This will create the MySQL user wackopicko with the password webvuln!@# as well as create the wackopicko table.

The wackopicko table contains all of the data that was present while testing the scanners in [Why Johnny Can't Pentest](http://cs.ucsb.edu/~adoupe/static/black-box-scanners-dimva2010.pdf).

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

