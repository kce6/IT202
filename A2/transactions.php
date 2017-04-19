<?php

include ( "functions.php" );
include ( "account.php" );

session_start();

//connects to the database in order to begin retrieving information
( $dbh = mysql_connect ( $hostname, $username, $password ) )
  or die ( "Unable to connect to MySQL database" );
mysql_select_db($project);

//retrieve the amount and type from the form
$amount = $_GET["amount"];
$transaction = $_GET["transaction"];

//declares session variables locally in transactions.php
$username = $_SESSION["NAME"];
$loggedIn = $_SESSION["LOGGED_IN"];
$type = $_SESSION["STATE"];
$c_bal = $_SESSION["CURRENT_BALANCE"];

//prints locally stored transaction information
print "Name of the user is: $username";
print "Current Balance for submitted user is: $c_bal";

//makes sure the correct type is logged in
gateKeeper ($loggedIn, $type, "user");

//runs the update function to make the transaction, either withdrawl or deposit
update ($username, $amount, $transaction);

?>