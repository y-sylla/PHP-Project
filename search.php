<?php

require_once 'login.php';

//Yasia Sylla R01483577


$search= $_POST['search'];
$term=$_POST['term'];

echo <<<_END

Select a value to search from:<br>

<form method="post">
<select name="search">
        <option value="">Select...</option>
        <option value="BandName">Band Name</option>
        <option value="members">Number of Members</option>
        <option value="YearFormed">Years Formed</option>
        <option value="Status">Status</option>
</select>
<br><br>
Term to search:<br>
<input type="text" name="term" value="$term">
<input type="submit" value="Search">
</form>

_END;

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);

$query  = "SELECT * FROM bands WHERE $search='$term'";


  $result = $connection->query($query);
  if (!$result) die($connection->error);

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);

    echo 'Name: '   . $row['bandName']   . '<br>';
    echo 'Formed: ' . $row['YearFormed'] . '<br>';
    echo '<br>';
  }

  $result->close();
  $connection->close();
  
  
  echo "<p><a href=menu.php>Return To Menu</a></p>";

?>