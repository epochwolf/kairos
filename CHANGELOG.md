
# Kairos 2.0 (Sep 5, 2015)

Moving all configuration to the database and adding real users instead of relying on basic aut via htaccess files. Adding ability to import pre-registered attendees via CSV.

* All configuration has been moved into the database.
* All configuration except database can be changed in the UI.
* Database configuration is now in _includes/config.json
* User login added instead of using basic auth in an htaccess file. 
* Blacklist now supports wildcard character * in triggers. 
* New Blacklist UI. 
* Improved blacklist warnings on attendees.
* Allow attendees to be manually blacklisted.
* Attendees can be imported via CSV file.

# Kairos 1.3 (Sep 1, 2015)

Improved printing of pre-registration page. 

* The pre-registration tab can be printed on paper as a backup. 
* Code of Conduct is now an html file. 

# Kairos 1.2 (Aug 21, 2015)

Adding badge reprinting and audit logging. 

* Added badge reprinting button.
* Added upgraded badge, reprinted badge, and comped badge numbers to numbers page.
* Added a dollar sign to the overprice price field in the edit and pay forms. 
* Added badge name to check in form.
* Added attendee_logs table which records every insert and update to the attendees table. 

# Kairos 1.1 (Aug 11, 2015)

Minor update

* Updated Numbers view. 
* Adding asterisks to required fields on the sign up form.
* Removed phone number field from search results, shows a minor's adult information instead.

# Kairos 1.0 (Jul 6, 2015)

Initial Version

* At Door Registration Form
* Pre-Registration Check In
* Searchable Attendee Database
* Automatic blacklist flagging.
* Automatic minor flagging.
* Live Numbers