<?php

include ( "functions.php" );
include ( "account.php" );

session_start();

( $dbh = mysql_connect ( $hostname, $username, $password ) )
       or die ( "Unable to connect to MySQL database" );
mysql_select_db($project);
       
//INPUT
$name = $_GET["user"];
$pass = $_GET["pass"];
$type = $_GET["type"];

//ESCAPE STRING
$sName = mysql_real_escape_string($name);
$sPass = mysql_real_escape_string($pass);


//Checks the submitted user type and runs the appropriate functions
if ($type == "user"){
  //if type is the user, run the user function
  user($name, $pass, $c_bal);
  //sets the session variable for the username
  $_SESSION["NAME"] = $name;
  //sets the session variable for the submitted type, user
  $_SESSION["STATE"] = $type;
  //sets the session variable for whether or not the user is logged in, boolean
  $_SESSION["LOGGED_IN"] = true;
  //saves current balance as a session variable to be called on the userPage.html before a transaction is made
  $_SESSION["CURRENT_BALANCE"] = $c_bal;
  //redirects to the userPage.html if type is user and login information checks out
  redirect ("Credentials validated, redirecting you to userPage.html", "userPage.html");
  exit();
}

//Checks the submitted user type and runs the appropriate functions
if ($type == "administrator"){
  //if type is the admin, run the admin function
  admin($name, $pass);
  //sets the session variable for the username
  $_SESSION["NAME"] = $name;
  //sets the session variable for the submitted type, admin
  $_SESSION["STATE"] = $type;
  //sets the session variable for whether or not the user is logged in, boolean
  $_SESSION["LOGGED_IN"] = true;
  redirect ("Credentials validated, redirecting you to adminPage.php", "adminPage.php");
  exit();
}
  
?>