# Secure Mail

## Description

## Technologies

-   Frontend: Basic HTML, CSS and JavaScript
-   Backend: PHP
-   Database: MySQL

# Environment Setup (Linux)

## Install php

-   `sudo apt install php8.1`

## Install MySQL

-   `sudo apt install mysql-server`

## PHP MySQL Integration

-   `sudo apt install php8.1-mysql libapache2-mod-php`
-   `sudo service mysql restart`
-   `sudo mysql -u root`
-   `ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';`

## Nginx Setup

-   `sudo apt install nginx`
-   `sudo apt install php8.1-fpm`
-   `sudo nano /etc/nginx/sites-available/default`

```
uncomment and modify the following lines:

location ~ \.php {
    include snippets/fastcgi-php.conf;
    fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
}
```

## Download & Run (without Docker)

-   `git clone `
-   `cd secure_mail`
-   `mv env.example.php env.php`
-   `Update the database credentials in env.php`
-   `mv ../secure_mail /var/www/html`
-   `sudo service nginx restart`
-   `visit http://localhost/secure_mail/config to create the database`
