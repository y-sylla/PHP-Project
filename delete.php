<?php

//Yasia Sylla R01483577

  require_once 'login.php';
  
  echo "<p><a href=menu.php>Return To Menu</a></p>";
  
  $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
  
  if ($connection->connect_error) die($connection->connect_error);
  
  if (isset($_POST['delete']) && isset($_POST['bandname']))
  {
    $bandname   = get_post($connection, 'bandname');
    $query  = "DELETE FROM bands WHERE bandname='$bandname'";
    $result = $connection->query($query);
  	if (!$result) echo "DELETE failed: $query<br>" .
      $connection->error . "<br><br>";
  }
  
    $query  = "SELECT * FROM bands";
  $result = $connection->query($query);
  if (!$result) die ("Database access failed: " . $connection->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    Name:     $row[0]
    Members:  $row[1]
    Formed:   $row[2]
    Active:   $row[3]
  </pre>
  <form action="delete.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="bandname" value="$row[0]">
  <input type="submit" value="DELETE RECORD"></form>
_END;
  }
  
  $result->close();
  $connection->close();
    
   function get_post($connection, $var)
  {
    return $connection->real_escape_string($_POST[$var]);
  }
?>