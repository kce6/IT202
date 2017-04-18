<?php
include("functions.php");
include (  "account.php"     ) ;
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors' , 1);
print"<b>Results from xform.php with data from xform.html</b><br><br>";
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
$s = "select * from accounts where user = '$name' ";

//echo $s1;
sql ( $type , $name, $s1, $s2 );
echo $s1;
$out1 = get_A($type, $s);
print $out1;
$out1 = get_T( $type, $s1);
print $out1;
//SHOW
?>