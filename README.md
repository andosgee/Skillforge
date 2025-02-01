# SkillForge 
A Full Stack High Fidelity Model
___
## Table of Contents
- [About](#about)
- [Installation](#installation)
- [License](#license)
___
## About
SkillForge is a full stack development that simplifies SOP training and Staff training tools through a Web-based application. It will allow multiple types of users (admins, clients) to interact through a log in to their own companies resources.
It allows for the company to create a module that can be completed by the user for training and/or compliance. Its aim is to centralise a learning hub in a business environment.
![Home](https://andrewdevelops.com/wp-content/uploads/2024/07/Home-1.png)
![Internal Dashboard](https://andrewdevelops.com/wp-content/uploads/2024/07/Admin-1.png)

### Langauges/Markup Used
PHP, HTML, JS, SASS, SQL

### Index Page
#### Marquee
Uses `x` amount of pictures from the assets/image/assets/marquee/ directory. Each image lasts for 5 seconds and can be overrun from the side buttons or using the radio buttons at the bottom of the marquee.

#### Request Demo
Library used: Chosen. This is for searching in a dropdown. Jquery is called.
Quill has been used as a text editor.

### Runs On
Xampp Stack, using PHP MyAdmin, MYsql, Apache
___

## Installation
Using an Xampp stack with PHP, MySQL, and an Apache WebServer.

1. Download or Clone the Repo.
2. Unzip the download (if applicable).
3. Place the folder into `[webserver path]/htdocs`
4. Start the Webserver.
5. Create the database in PHP MyAdmin called SkillForge
6. Upload the the `database.sql` file

### php.ini email setup for windows
[mail function] \
; For Win32 only. \
; http://php.net/smtp \
SMTP=smtp.gmail.com \
; http://php.net/smtp-port \
smtp_port=587 \
; For Win32 only. \
; http://php.net/sendmail-from \
sendmail_from = mail.skillforge@gmail.com \
; For Unix only.  You may supply arguments as well (default: "sendmail -t -i"). \
; http://php.net/sendmail-path \
sendmail_path ="\"C:\xampp\sendmail\sendmail.exe\" -t" \

### sendmail.ini email setup for windows
[sendmail] \
smtp_server=smtp.gmail.com \
smtp_port=587 \
smtp_ssl=auto \
error_logfile=error.log \
debug_logfile=debug.log \
auth_username=mail.skillforge@gmail.com \
auth_password=<create app password by signing into Google account> \
force_sender=mail.skillforge@gmail.com 

### Useful Login information
**Feel Good Inc** 
**Company Admin** - *Username*: damon@feelgoodinc.com
*Password*: Pa$$w0rd 

**Admin for Adding a Company** 
*Username*: webmaster@skillforge.com 
*Password*: Pa$$w0rd
___
## License
Distributed under the Apache License. See `LICENSE` for more information.
