<?php

 include ("account.php") ;
 include ("form-functions.php");
 
     print "<b>Results from xform.php with data from xform.html</b><br><br>";

     ( $dbh = mysql_connect ( $hostname, $username, $password ) )
       or die ( "Unable to connect to MySQL database" );

print "<br><b>Results from xA1.php with data from A1.html</b>";	
print "<br><b>Connected to MySQL</b><br><br>";

mysql_select_db( $project ); 

//INPUT
$name   = $_GET["user"];
$pass   = $_GET["pass"];
$amount = $_GET["amount"];
$type   = $_GET["type"];

print "Submitted name is: <b>$name</b><br>";
print "Password is: <b>$pass</b><br>";
print "Amount is: <b>$amount</b><br>";
print "Type is: <b>$type</b><br>";
//PROTECTION
$type = get_case ($name, $pass, $amount, $type);
if ($type == 'A') admin ($name, $pass);
if ($type != 'A') user ($name, $pass, $amount, $type);


//UPDATE
$s = "insert into transactions values ( '$name', '$type', '$amount', NOW())";
echo "<br>SQL insert to transactions: $s.<br>"; 
mysql_query ($s)   or die (mysql_error() );
 
// change a row in accounts -  use an update SQL
 
$s = "Update accounts Set current_balance = current_balance + '$amount' Where user = '$name' ";
 
echo "SQL update of A: $s. <br>" ;
mysql_query ($s)   or die (mysql_error() ) ;


//SHOW

//MAIL
?>
