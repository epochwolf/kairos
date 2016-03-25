function date_parse(str_mm_dd_yyyy){
  if(!str_mm_dd_yyyy.match(/\d\d\/\d\d\/\d\d\d\d/)){
    return null;
  }
  var parts = str_mm_dd_yyyy.split("/");

  if(parts.length == 3){
    var year  = parseInt(parts[2], 10);
    var month = parseInt(parts[0], 10);
    var day   = parseInt(parts[1], 10);
    return new Date(year, month - 1, day);
  }else{
    return null;
  }
}


// value should be a string with format MM/DD/YYYY
// Returns a positive integer or null on an error.
function birthdate_to_age(date_str){
  var birthdate = date_parse(date_str);
  if(birthdate === null){ return null; }

  var today = new Date();

  var year = today.getFullYear() - birthdate.getFullYear();
  var month = today.getMonth() - birthdate.getMonth();

  if (month < 0 || (month === 0 && today.getDate() < birthdate.getDate())){
      year--;
  }

  return year;
}

// value should be a string with format MM/DD/YYYY
// Returns a boolean or null on an error.
function is_minor(age){
  if(age === null || age >= window.app_config.minor_age){
    return false;
  }else{
    return true;
  }
}

$("body").on("keyup", "#birthdate", function(){
  var self = $(this);
  var minor_fields = self.data("minor-fields");
  var minor_div;
  var age = birthdate_to_age(self.val());

  $("input#age").val(age);

  if(minor_fields){
    minor_div = $(minor_fields);

    if(is_minor(age)){
      minor_div.show();
    }else{
      minor_div.hide();
    } 
  }
});