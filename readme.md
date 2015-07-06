# Kairos Registration System

Kairos is an offline registration system and an attendee database written for Ringtail Cafe Productions. It is used at Fur Reality in Cincinnati, OH and the International Steampunk Symposium, also in Cincinnati. 

## Features

* At Door Registration Form
* Pre-Registration Check In 
* Searchable Attendee Database
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


