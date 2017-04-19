<?php

include ( "functions.php" );
include ( "account.php" );

//starts the session
session_start();

//connects to the database in order to begin retrieving information
( $dbh = mysql_connect ( $hostname, $username, $password ) )
or die ( "Unable to connect to MySQL database" );
mysql_select_db($project);

//retrieving session variables to be called in the admin page
$username = $_SESSION["NAME"];
$loggedIn = $_SESSION["LOGGED_IN"];
$type = $_SESSION["STATE"];

//calls gateKeeper to validate session tokens
gateKeeper($loggedIn, $type, "administrator");

//call sql function to actually display the user account/transaction information
sql ($type, $name, $uA, $uT);
echo $s1;
$out1 = get_A($type, $uA);
print $out1;
$out1 = get_T( $type, $uT);
print $out1;


?>