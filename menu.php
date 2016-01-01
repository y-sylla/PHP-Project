<?php
    
    //Yasia Sylla R01483577
    
    require_once 'session.php';

    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    echo "Welcome back $username!";
   
    echo <<<_END
     
    <!DOCTYPE html><html><head><title>Main Menu</title>
    <br><br>
    <style>
    ul {
        list-style-type:none;
        margin: 0;
        padding: 0;
        }
        
    a {
        color:#162955;
        text-decoration: none;
        }
        
    a:hover {
        text-decoration:underline;
        }
    </style>
    
        <!DOCTYPE html><head><title>User Menu</title>
    
    <!-- HTML for Menu -->

    </head>
    <body>
    <ul>        
        <li>
        <a href="showbands.php">List of Bands</a>
        </li>
        
        <li>
        <a href="search.html">Search Database</a>
        </li>
        
        <li>
        <a href="add.html">Add Band to Database</a>
        </li>
        
        <li>
        <a href="delete.php">Delete Band From Database</a>
        </li>
        
        <li>
        <a href="logout.php">Log Out</a>
        </li>
    </ul>
    </body>
    </html>

_END;
  
?>