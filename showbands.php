<?php

//Yasia Sylla R01483577

    require_once 'session.php';
    require_once 'login.php';
    
            echo "<p><a href=menu.php>Return To Menu</a></p>";
    
    echo "<title>Band List</title><h1>List of Bands</h1>";
    
    $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    
     if ($connection->connect_error) die($connection->connect_error);
     
     $query  = "SELECT bandname, members, yearformed, active FROM bands";
  $result = $connection->query($query);
  if (!$result) die($conn->error);

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo 'Name: ' .        $row['bandname']   . '<br>';
    echo '# of Members: ' .$row['members']    . '<br>';
    echo 'Year Formed: ' . $row['yearformed'] . '<br>';
    echo 'Active?: ' .     $row['active']     . '<br>';
    
    echo '<br>';
  }

  $result->close();
  $connection->close();
  
  ?>