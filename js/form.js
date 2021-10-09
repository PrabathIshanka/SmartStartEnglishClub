function isEmail(email) {
var regex = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
return regex.test(email);
}

$('#submit').click(function () {
  var errormsg = '';
  var missingfield = '';

  //Check missing fields
if ($('#firstname').val() === '') {
  missingfield += '<br>First Name';
}

if ($('#email').val() === '') {
  missingfield += '<br>Email';
}

if ($('#password').val() === '') {
  missingfield += '<br>Password';
}

if ($('#repassword').val() === '') {
  missingfield += '<br>Retype Password';
}

//Show missing fields
if (missingfield !== '') {
  errormsg += 'The following mandatory fields are missing:' + missingfield;
}

//Validation
if (isEmail($('#email').val()) === false) {
  errormsg += '<p>Email address not valid</p>';
}

if ($.isNumeric($('#phone').val()) === false) {
  errormsg += '<p>Phone number not valid</p>';
}

if (($('#password').val()) !== ($('#repassword').val())) {
  errormsg += '<p>Passwords not a match</p>';
}

if (errormsg !== '') {
  $('#errormessage').html(errormsg).addClass('animated slideInDown');
}
else {
  $('#errormessage').hide();
  $('#successmessage').show().addClass('animated bounceIn');
}
});
