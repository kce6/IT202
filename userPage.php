<?php

include (    "account.php"         );
print "<b>Results from xform.php with data from xform.html</b><br><br>";

($dbh = mysql_connect ( $hostname, $username, $password ) )
or die ( "Unable to connect to MySQL database" );
	
print "<b>Connected to MySQL</b><br><br>";

mysql_select_db( $project ); 

$user = $_GET [ "user" ];
print "<br>The submitted user is: <b>$user</b><br><br>";



$userAccount = "SELECT * FROM accounts WHERE user='$user'";
print "<br>SQL statement used is: $userAccount<br>";

($uA = mysql_query($userAccount)) or die (mysql_error());

$num = mysql_num_rows($uA);

    while ($r = mysql_fetch_array($uA)) {
         $x = $r["user"];
         $y = $r["current_balance"];
	 print "<br>User is: <b>$x</b><br>";
   print "Current Balance is: <b>$y</b><br>";
    };
    
print "<br>The number of rows retrieved from the table is: <b>$num</b><br>";

$userTransactions = "SELECT * FROM transactions WHERE user='$user'";
print "<br>SQL statement used is: $userTransactions<br>";

($uT = mysql_query($userTransactions)) or die (mysql_error());

$num = mysql_num_rows($uT);

    while ($r = mysql_fetch_array($uT)) {
         $x = $r["user"];
         $y = $r["type"];
         $z = $r["amount"];
         $a = $r["date"];
	 print "<br>User   is: <b>$x</b><br>";
   print "<br>Type   is: <b>$y</b><br>";
   print "<br>Amount is: <b>$z</b><br>";
   print "<br>Date   is: <b>$a</b><br>";
    };
    
print "<br>The number of rows retrieved from the table is: <b>$num</b><br>";
print "<br><b>NOTICE:</b> Mail service was requested but that feature has not been implemented yet";
print "<br>This interaction is complete. Goodbye";


/*

GOES INSIDE YOUR PHP FILE 
AT THE START OF THE PHP SECTION.

IT ASSUMES YOUR account.php FILE 
HAS ALREADY BEEN DEFINED
IS IN SAME DIRECTORY.


DON'T CHANGE THE NAMES OF THE VARIABLES IN THE account.php FILE
OR THEY WON'T MATCH THE NAMES IN THE CONNECT CODE.

THE CODE GOES BETWEEN THE 
<?php   and  ?> 
TAGS OF THE .php FILE.
YOU PASTE IT INTO


*/




?>
