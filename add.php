<?php
/Applications/XAMPP/xamppfiles/htdocs/Project/add.php
//Yasia Sylla R01483577

    require_once 'session.php';
    require_once 'login.php';
    
    $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    
     if ($connection->connect_error) die($connection->connect_error);
     
     $bandname=$members=$yearformed=$active="";
    
    $bandname   = get_post($connection, 'bandName');
    $members    = get_post($connection, 'members');
    $yearformed = get_post($connection, 'yearformed');
    $active     = get_post($connection, 'active'); 
    
    $query    = "INSERT INTO bands VALUES" .
      "('$bandname', '$members', '$yearformed', '$active')";
    $result   = $connection->query($query);
    echo "Successfully added $bandname to database!<br>";
  	if (!$result) echo "INSERT failed: $query<br>" .
      $connection->error . "<br><br>";
  //} 

  function get_post($connection, $var)
  {
    return $connection->real_escape_string($_POST[$var]);
  }
  


  echo "<p><a href=menu.php>Return To Menu</a></p>";
  
  ?>