# Kairos Registration System

Kairos is an offline registration system and an attendee database written for Ringtail Cafe Productions. It is used at Fur Reality in Cincinnati, OH and the International Steampunk Symposium, also in Cincinnati. 


![Sign Up Form](/screenshots/signup-form.png?raw=true "Sign Up Form")

## Features

* At Door Registration Form
* Pre-Registration Check In 
* Searchable Attendee Database
* Automatic banlist flagging.
* Live Numbers

Kairos works best if you import all of your pre-registered attendees into the database.

## Goals of the system

### Work at a hotel with limited equipment and no internet access. 

Kairos only requires a single computer running Windows, OS X or Linux to function as a server. No internet access is required. 

You can even use a Raspberry Pi if you have the technical skill to install and configure Apache, MySQL, and PHP yourself. 

### Minimal training for convention staff

As much of the process of registration is as automated as possible. The concepts behind the UI are relatively simple.The error messages explain why things are invalid. 

### Reduce the amount of paperwork for convention staff. 

By having people registering at the door fill out an electronic application, there is no need to do data entry to a database. 

If you import your pre-registered attendees into the database, pre-registration can also be handled electronically. 

Everything you need is a search away. No hunting through paper forms.

## Recommend equipment setup

### Network Requirements

Any consumer router with Ethernet ports can be used. For security, it is highly recommend to use a wired network and disable WiFi on any router used for this system. 

If you must use WiFi, it is recommended to have a knowledgeable tech secure the system. A number of consumer routers have security issues.

It is also important to keep an eye on the equipment to make sure no one attempts to physically access the system. 

### Server Requirements

Any system capable of running XAMPP (Apache + MySQL + PHP) can function as a server. 

### Client Requirements

For laptops: Any system capable of running Google Chrome or Firefox. Chromebooks or Raspberry Pis with are a good choice. 

For tablets: Most android/iOS tablets. (This requires a secure wifi system.)

## Install Instructions

1. Download a copy of XAMPP 5.6.8 
2. Configure XAMPP security: set mysql to local access only and add a secure password to phpmyadmin.
  * Run `/Applications/XAMPP/xamppfiles/xampp security` (Mac specific. Command will be different on windows and linux.)
3. Copy XAMPP's htdocs folder to a safe place.
4. Replace the contents of XAMPP's htdocs folder with this application.
5. Replace .htpasswd file with a more secure username and password. (The default is admin/Password1.)
5. Load database.sql into mysql using phpmyadmin.
6. Load blacklist.sql into mysql using phpmyadmin. (If provided)
7. Swap out the Code of Conduct in index.php for your convention's Code of Conduct. 
8. Edit the various configuration values in _includes/config.php as needed. 

## Sign Up Screenshots

### Sign Up Code of Conduct

This is the first page someone sees when they go to sign up at the door. 

![Sign Up Code of Conduct](/screenshots/signup-codeofconduct.png?raw=true "Sign Up Code of Conduct")

### Sign Up Form

After agreeing to the Code of Conduct, this is the form they need to fill out. 

![Sign Up Form](/screenshots/signup-form.png?raw=true "Sign Up Form")

### Sign Up Form with Errors

Here are most of the error messages that will appear if someone doesn't fill out a required field.

![Sign Up Form Errors](/screenshots/signup-form-errors.png?raw=true "Sign Up Form Errors")


## Admin Screenshots

![admin-attendees-tab](/screenshots/admin-attendees-tab.png?raw=true "admin-attendees-tab")
![admin-search](/screenshots/admin-search.png?raw=true "admin-search")
![admin-numbers](/screenshots/admin-numbers.png?raw=true "admin-numbers")
![admin-at-door-checkin](/screenshots/admin-at-door-checkin.png?raw=true "admin-at-door-checkin")
![admin-normal-pay](/screenshots/admin-normal-pay.png?raw=true "admin-normal-pay")
![admin-normal-checkin](/screenshots/admin-normal-checkin.png?raw=true "admin-normal-checkin")
![admin-banned-pay](/screenshots/admin-banned-pay.png?raw=true "admin-banned-pay")
![admin-minor-under13-checkin](/screenshots/admin-minor-under13-checkin.png?raw=true "admin-minor-under13-checkin")
![admin-warn-checkin](/screenshots/admin-warn-checkin.png?raw=true "admin-warn-checkin")
![admin-edit](/screenshots/admin-edit.png?raw=true "admin-edit")
