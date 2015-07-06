<?php // This contains configuration information.

$CONFIG = [
  "default_page_title" => "Kairos",
  "admin_header" => "Kairos",
  "database" => ['mysql:host=localhost;dbname=kairos', 'root'], // This is passed directly to PDO constructor.
]; 

$TSHIRT_SIZES = [
  "S",
  "M",
  "L",
  "XL",
  "2X",
];

$PAYMENT_TYPES = [
  "cash" => "Cash",
  "credit" => "Credit",
];

// Registration levels available at the door. 
$AT_DOOR_REGISTRATION = [
  "standard",
  "sponsor",
  "friday-only",
  "saturday-only",
  "sunday-only",
];

// Registration levels available for pre-registration.
$PRE_REGISTRATION = [
  "standard",
  "sponsor",
  "super-sponsor",
  "dealer-table",
  "god-level",
];

$BADGE_TYPES = [
  "attendee" => "Attendee",
  "minor"    => "Minor",
  "guest"    => "Guest",
  "staff"    => "Staff",
  "dealer"   => "Dealer",
];

// Configures how badge type is displayed next to attendance level in list views
// Recommendation is that the most common type of attendance isn't display. 
$BADGE_LABELS = [
  "minor" => "label-info",
  "guest" => "label-default",
  "staff" => "label-primary",
  "dealer" => "label-success",
];

// All registration levels and their names.
$REGISTRATION_LEVELS = [
  "friday-only"     => "Friday Only",
  "saturday-only"   => "Saturday Only",
  "sunday-only"     => "Sunday Only",

  "standard"        => "Standard",
  "sponsor"         => "Sponsor",

  "super-sponsor"   => "Super Sponsor",
  "god-level"       => "God Level",
  "dealer-table"    => "Dealer Table"
];

// All registration levels and their prices.
$REGISTRATION_PRICING = [
  "friday-only"     =>  45,
  "saturday-only"   =>  45,
  "sunday-only"     =>  45,
  
  "standard"        =>  55,
  "sponsor"         =>  85,
  "super-sponsor"   => 125,
  "god-level"       => 200,
  "dealer-table"    =>  80,
];

// Upgrade pricing at the door. 
// array(old_level => array(new_level => price))
$REGISTRATION_UPGRADE_PRICING = [
  "friday-only" => [
    "standard" => $REGISTRATION_PRICING["standard"] - $REGISTRATION_PRICING["friday-only"],
    "sponsor" => $REGISTRATION_PRICING["sponsor"] - $REGISTRATION_PRICING["friday-only"],
  ],
  "saturday-only" => [
    "standard" => $REGISTRATION_PRICING["standard"] - $REGISTRATION_PRICING["saturday-only"],
    "sponsor" => $REGISTRATION_PRICING["sponsor"] - $REGISTRATION_PRICING["saturday-only"],
  ],
  "sunday-only" => [
    "standard" => $REGISTRATION_PRICING["standard"] - $REGISTRATION_PRICING["sunday-only"],
    "sponsor" => $REGISTRATION_PRICING["sponsor"] - $REGISTRATION_PRICING["sunday-only"],
  ],
  "standard" => [
    "sponsor" => $REGISTRATION_PRICING["sponsor"] - $REGISTRATION_PRICING["standard"],
  ],
];