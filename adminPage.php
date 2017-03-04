<?php

include (    "account.php"            );
//include (    "form-functions.php"     );
print "<b>Results from adminPage.php with data from login.html</b><br><br>";

($dbh = mysql_connect ( $hostname, $username, $password ) )
or die ( "Unable to connect to MySQL database" );
	
print "<b>Connected to MySQL</b><br><br>";

mysql_select_db( $project ); 

$user = $_GET [ "user" ];
print "<br>The submitted user is: <b>$user</b><br><br>";



$userAccounts = "SELECT * FROM accounts";
print "<br>SQL statement used is: $userAccounts<br>";

($uA = mysql_query($userAccounts)) or die (mysql_error());

$num = mysql_num_rows($uA);

    while ($r = mysql_fetch_array($uA)) {
         $u = $r["user"];
         $pw = $r["pass"];
         $e = $r["email"];
         $fn = $r["fullname"];
         $addr = $r["address"];
         $ib = $r["initial_balance"];
         $cb = $r["current_balance"];
         
         
	       print "<br>User is: <b>$u</b><br>";
         print "Password is: <b>$$pw</b><br>";
         print "Email Address is: <b>$e</b><br>";
         print "The Full Name is: <b>$fn</b><br>";
         print "The Mailing Address is: <b>$addr</b><br>";
         print "The Initial Balance was: <b>$ib</b><br>";
         print "Current Balance is: <b>$cb</b><br>";

    };
    
print "<br>The number of rows retrieved from the table is: <b>$num</b><br>";

$userTransactions = "SELECT * FROM transactions";
print "<br>SQL statement used is: $userTransactions<br>";

($uT = mysql_query($userTransactions)) or die (mysql_error());

$num = mysql_num_rows($uT);

    while ($r = mysql_fetch_array($uT)) {
         $u = $r["user"];
         $t = $r["type"];
         $a = $r["amount"];
         $d = $r["date"];
	       print "<br>User is: <b>$u</b><br>";
         print "<br>Type is: <b>$t</b><br>";
         print "<br>Amount is: <b>$a</b><br>";
         print "<br>Date is: <b>$d</b><br>";
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