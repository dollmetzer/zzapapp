Installation
============

Prerequisite
------------
Before you install zzapapp, be sure your server have already installed and working the following tools:

- A Webserver. I prefer Apache, but NGINX should work fine.
- PHP as mod_php or php-fpm
- MySQL
- Composer (https://getcomposer.org/)
- git (If you want to install direct from Github)

You should know where to put your application and how to set the webservers webroot and logfile directories.
In the following instruction, we assume /var/www/zzapapp ist your application root directory.

Install from Github
-------------------
Clone the zzapapp into the application directory. For example:

  cd /var/www
  git clone https://github.com/dollmetzer/zzapapp.git zzapapp
  
Install from ZIP file
---------------------
Get the latest ZIP file from https://github.com/dollmetzer/zzapapp/archive/master.zip .

  cd /var/www
  gunzip master.zip
  mv zzapapp-master zzapapp
  
Directory rights
----------------
The following  directories need read/write access:
- data
- logs
- tmp
  
Install zzaplib library
-----------------------
Run composer in the application root directory
 
  cd /var/www
  composer install

Prepare the database
--------------------

Configure the Webserver
-----------------------