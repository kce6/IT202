<?php



//Checks to make sure that both a username and password were entered.  Called in login.php
function nullCheck ($name, $pass, $type){
  //if no username is entered, exit with message
  if ($name == null) {
    exit ("No username entered. Please enter a username");
  }  
  //if no password is entered, exit with message
  if ($pass == null) {
    exit ("No password entered. Please enter a password");
  }
}

function redirect ($m, $u){
  echo $m;
  header ("Refresh: 5; '$u' ");
}

//checks session variables for correct state/input
function gateKeeper ($loggedIn, $type, $formType){
  //uncomment the statement below to test that you are inside of the gatekeeper
  //print "You are currently inside the gateKeeper function";
//working on it
  if ($type != $formType){
    //redirect back to login if the submitted type from the form is not 'administrator'
    redirect ("Your type is not 'administrator', redirecting you to the log in page.", "login.html");
    //exits to prevent further code from running
    exit();
  }
  
  if($loggedIn != true){
    //redirect back to log in if the session state is not set to true
    redirect ("Your session state is not set to true, redirecting you to the log in page.", "login.html");
    //exits to prevent further code from running
    exit();
  }
}

function user ($name, $pass, &$c_bal){

    //inside user
    print "Username: $name";
    
    //retrieves all records from accounts to check the submitted username and password
    $allAccounts = "select * from accounts";
    ($uA = mysql_query($allAccounts)) or die (mysql_error());
    //boolean variable that changes from false to true if the submitted credentials match a record in the DB
    $dbCheck = false;
    
    //retrieves all account information matching submitted username and password 
    while ($r = mysql_fetch_array($uA)) {
      //defining account info
      print "<br><br>";
      $u = $r["user"];
      $pw = $r["pass"];
      
      //changes the boolean dbCheck to true if credentials find a match in the DB
      if (($u == $name) && ($pw == $pass)){
        $dbCheck = true;
      }  
    }
    
    if ($dbCheck == false){
      //redirects since no match has been found in the DB
      redirect ("No matching credentials found in the database, redirecting to login.html", "login.html");
      //exits to make sure no other code is run after the redirect
      exit(); 
    }
    
}
function admin ($name, $pass){
  //inside admin
  if($name != "bond" || $pass != "007"){
    //redirects to login upon failed admin information
     redirect ("Incorrect Admin Information.  Exiting", "https://web.njit.edu/!kce6/downlaod/login.html");
    //exiting to ensure no otehr code is run after redirect 
    exit();
    }
  return;
}
function update ($name, $amount, $type) {
  //Inside update
  //add a row to the transactions table
  $s = "insert into transactions values ('$name', '$type', '$amount', NOW())";
  echo "<br>The SQL statement used to update the Transactions Table: $s.<br>";
  mysql_query ($s) or die (mysql_error());
  
  echo "$type<br>";
  
  //add to current balance if deposit
  if ($type == 'D') {
    $newS = "Update accounts set current_balance = current_balance + '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $newS.<br>";
    mysql_query ($newS) or die (mysql_error());
  }
  
  //subtract from current balance if withdrawl
  if ($type == 'W') {
    $newS = "Update accounts set current_balance = current_balance - '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $newS.<br>";
    mysql_query ($newS) or die (mysql_error());
  }
  
}
function sql ($type, $name, &$uA, &$uT ){
  //If admin, display all table information
  if ($type == 'administrator')
  {
    //accounts table for everyone
    $userAccounts = "SELECT * FROM accounts";
    ($uA = mysql_query($userAccounts)) or die (mysql_error());
    $num = mysql_num_rows($uA);
    while ($r = mysql_fetch_array($uA)) 
    {
      //defining account info
      print "<br><br>";
      $u = $r["user"];
      $pw = $r["pass"];
      $e = $r["email"];
      $fn = $r["fullname"];
      $addr = $r["address"];
      $ib = $r["initial_balance"];
      $cb = $r["current_balance"];
      
      //printing account information
      print "<br>User is: <b>$u</b><br>";
      print "Password is: <b>$$pw</b><br>";
      print "Email Address is: <b>$e</b><br>";
      print "The Full Name is: <b>$fn</b><br>";
      print "The Mailing Address is: <b>$addr</b><br>";
      print "The Initial Balance was: <b>$ib</b><br>";
      print "Current Balance is: <b>$cb</b><br>";
    } 
    //transactions table for everyone
    $userTransactions = "SELECT * FROM transactions";
    ($uT = mysql_query($userTransactions)) or die (mysql_error());
    $num = mysql_num_rows($uT);
    while ($r = mysql_fetch_array($uT)) 
    {
      //defining account info
      print "<br><br>";
      $u = $r["user"];
      $ty = $r["type"];
      $amt = $r["amount"];
      $d = $r["date"];
      
      //printing account information
      print "<br>User is: <b>$u</b><br>";
      print "Type is: <b>$$ty</b><br>";
      print "Amount is: <b>$amt</b><br>";
      print "The Full Name is: <b>$fn</b><br>";
      print "Date Submitted is: <b>$d</b><br>";
    }
    //print "<br>SQL statement used to display the Accounts Table: $uA<br>"; throwing resource error id#5
    //print "<br>SQL statement used to display the Transactions Table: $uT<br>"; throwing resource error id#6
  }
  //If not admin, display only submitted user's information from the tables
  else
  {
    $uA = "SELECT * FROM Accounts WHERE user='$name'";
    $uT = "SELECT * FROM Transactions WHERE user='$name'";
    print "<br>SQL statement used is: $uA<br>";
    print "<br>SQL statement used is: $uT<br>";
  }
}
function get_A ( $uA ) 
{
  $out =  "<br> $uA is:    $uA <br>";
  ($t  = mysql_query($uA)) or die (  mysql_error() );
  while ( $r = mysql_fetch_array($t) ) 
  {
    $u  = $r["user"];
    $e  = $r["email"];
    $out  .= "<br>user is $u";
    $out  .= "<br>mail is $e";
  }
  return $out;
}
function get_T ($uT){
  $out =  "<br> $uT is:    $uT <br>";
  ($t  = mysql_query($uT)) or die (  mysql_error() );
  while ( $r = mysql_fetch_array($t) ) 
  {
    $u  = $r["user"];
    $ty  = $r["type"];
    $amt  = $r["amount"];
    $d  = $r["date"];
    $out  .= "<br>user is $u";
    $out  .= "<br>type is $ty";
    $out  .= "<br>amount is $amt";
    $out  .= "<br>date is $d";
  }
  return $out;
}
?>