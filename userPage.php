<?php

include("functions.php");

include (  "account.php"     ) ;

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

ini_set('display_errors' , 1);

print"<b>Results from userPage.php with data from login.html</b><br><br>";

( $dbh = mysql_connect ( $hostname, $username, $password ) )
       or die ( "Unable to connect to MySQL database" );
   
print "Successfully connected to MySQL.<br>";
mysql_select_db( $project ); 

//INPUT
$name = $_GET["user"];
$pass = $_GET["pass"];
$amount = $_GET["amount"];
$type = $_GET["type"];

//PROTECTION
$type = get_case ( $name, $pass, $amount, $type);
if ($type == 'A') admin ($name, $pass);
if ($type != 'A') user ($name, $pass, $amount, $type);

//UPDATE

if($type != 'A' ) update ( $name, $amount, $type);


//echo $s1;
sql ( $type , $name, $uA, $uT );

$out1 = get_A($uA);
print $out1;

$out1 = get_T($uT);
print $out1;

//MAIL
//Unable to get mail working properly
?>