<?php

//Yasia Sylla R01483577

    require_once 'login.php';
    
    echo "<p><a href=menu.php>Return To Menu</a></p>";
  
    $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

  if ($connection->connect_error) die($connection->connect_error);
  

 $forename = $surname = $username = $password = $confirm = $email = "";

  if (isset($_POST['forename']))
    $forename = fix_string($_POST['forename']);
  if (isset($_POST['surname']))
    $surname  = fix_string($_POST['surname']);
  if (isset($_POST['username']))
    $username = fix_string($_POST['username']);
  if (isset($_POST['password']))
    $password = fix_string($_POST['password']);
  if (isset($_POST['confirm']))
    $confirm      = fix_string($_POST['confirm']);
  if (isset($_POST['email']))
    $email    = fix_string($_POST['email']);

  $fail  = validate_forename($forename);
  $fail .= validate_surname($surname);
  $fail .= validate_username($username);
  $fail .= validate_password($password);
  $fail .= validate_confirm($confirm,$password);
  $fail .= validate_email($email);
  
    $token=encrypt($password);
  

  echo "<!DOCTYPE html>\n<html><head><title>An Example Form</title>";

  if ($fail == "")
  {
    echo "</head><body>Form data successfully validated.</body></html>";

    $query  = "INSERT INTO users VALUES('$forename','$surname','$username', '$email', '$token')";
    $result = $connection->query($query);
    if (!$result) die($connection->error);

	exit;
  }

  echo <<<_END

    <!-- The HTML/JavaScript section -->

    <style>
      .signup {
        border:1px solid #999999;
        font:  normal 14px helvetica;
        color: #162955;
      }
    </style>

    <script>
      function validate(form)
      {
        fail  = validateForename(form.forename.value)
        fail += validateSurname(form.surname.value)
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        fail += validateConfirm(form.confirm.value)
        fail += validateEmail(form.email.value)
      
        if (fail == "")     return true
        else { alert(fail); return false }
      }
      
      function validateForename(field)
      {
        return (field == "") ? "Please enter a forename.\n" : ""
      }

      function validateSurname(field)
      {
        return (field == "") ? "Please enter a surname.\n" : ""
      }

      function validateUsername(field)
      {
        if (field == "") return "Please enter username.\n"
        else if (field.length < 8)
          return "Usernames must be at least 8 characters.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field))
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
        return ""
      }

      function validatePassword(field)
      {
        if (field == "") return "Please enter password.\n"
        else if (field.length < 8)
          return "Passwords must be at least 8 characters.\n"
        else if (!/[a-z]/.test(field) || ! /[A-Z]/.test(field) ||
                 !/[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\n"
        return ""
      }

     function validateConfirm(field)
     {
        if (field== "") return "Please confirm password.\n"
        else if (field!==password) return "Passwords do not match.\n"
        return""
     }

      function validateEmail(field)
      {
        if (field == "") return "Please enter email.\n"
          else if (!((field.indexOf(".") > 0) &&
                     (field.indexOf("@") > 0)) ||
                    /[^a-zA-Z0-9.@_-]/.test(field))
            return "The Email address is invalid.\n"
        return ""
      }
    </script>
  </head>
  <body>

    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#50638F">
      <th colspan="2" align="center">Registration Form</th>

        <tr><td colspan="2">Sorry, the following errors were found<br>
          in your form: <p><font color=red size=1><i>$fail</i></font></p>
        </td></tr>

      <form method="post" action="adduser.php" onSubmit="return validate(this)">
               <tr><td>Forename</td>
          <td><input type="text" maxlength="32" name="forename" value="$forename">
        </td></tr><tr><td>Surname</td>
          <td><input type="text" maxlength="32" name="surname"  value="$surname">        
          </td></tr><tr><td>Username</td>
          <td><input type="text" maxlength="16" name="username" value="$username">
           <tr><td>Email</td>
          <td><input type="text" maxlength="64" name="email" value="$email"></td></tr>
        </td></tr><tr><td>Password</td>
          <td><input type="text" maxlength="12" name="password" value="$password">
        </td></tr><tr><td>Confirm PAssword</td>
          <td><input type="text" maxlength="12"  name="confirm"      value="$confirm">
        </td></tr><tr><td colspan="2" align="center"><input type="submit"
          value="Signup"></td></tr>
      </form>
    </table>
  </body>
</html>

_END;

  // The PHP functions

    function validate_forename($field)
  {
  	return ($field == "") ? "No Forename was entered<br>": "";
  }
  
  function validate_surname($field)
  {
  	return($field == "") ? "No Surname was entered<br>" : "";
  }
  
  function validate_username($field)
  {
    if ($field == "") return "No Username was entered<br>";
    else if (strlen($field) < 5)
      return "Usernames must be at least 5 characters<br>";
    else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
      return "Only letters, numbers, - and _ in usernames<br>";
    return "";		
  }
  
  function validate_password($field)
  {
    if ($field == "") return "No Password was entered<br>";
    else if (strlen($field) < 6)
      return "Passwords must be at least 6 characters<br>";
    else if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
      return "Passwords require 1 each of a-z, A-Z and 0-9<br>";
    return "";
  }
  
  function validate_confirm($field,$password)
  {
    if ($field == "") return "No Password was entered<br>";
    else if ($field !== $password)
        return "Does not match password<br>";
    return "";
  }
  
  function validate_email($field)
  {
    if ($field == "") return "No Email was entered<br>";
      else if (!((strpos($field, ".") > 0) &&
                 (strpos($field, "@") > 0)) ||
                  preg_match("/[^a-zA-Z0-9.@_-]/", $field))
        return "The Email address is invalid<br>";
    return "";
  }
  
  function fix_string($string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities ($string);
  }
  
  function encrypt($pw)
  {
    $salt1    = "qm&h*";
    $salt2    = "pg!@";
    $token    = hash('ripemd128', "$salt1$pw$salt2");
    return $token;
    }

?>
