# Kairos 3.0

New features. 

* Improved check in process.
* Improved edit screens.
* Ability to revoke badges and cancel unfinished registrations.
* New vendor list. 


* Payment and Check In moved into a single Check In form. 
* Editing birthdate dynamically updates age display and shows/hides adult information fields (were applicable). 

# Kairos 2.3 (Dec 13)

Removing hardcoded minor age and badge type tabs.

* Admin dashboard nows shows all badge types instead of hardcoded ones.
* Minor age is now set in _includes/constants.php (18 by default).
* Attendee import required fields now matches what the import page shows.
* Editing a minor's information no longer requires adult's name be filled in.

# Kairos 2.2 (Nov 24)

Fixing bugs discovered at Fur Reality.

* Override Price on Pay Form fixed. 
* Pre-reg page now ordered by creation date. 
* Badge type pages now ordered by creation date. 

# Kairos 2.1 (Sep 14, 2015)

Minor Fixes

* Adding optional field Company Name to Attendee. 

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