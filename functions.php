<?php
function get_case($name, $pass, $amount, $type)
{
    //no type selected
    if($type != 'A' && $type != 'W' && $type != 'D')
    {
        exit ("Exiting, No Type Selected");
    }
    
    //no username typed.  this will never execute because the username field in HTML is a required field
    if($name == null)
    {
        exit ("No Username Entered.  Please enter a username");
    }
    
    //no pw typed.  this will never execute because the pw field in HTML is a required field
    if($pass == null)
    {
        exit ("No Password Entered.  Please enter a password.");
    }
    
    //admin has amoutn specified (not allowed)
    if($type == 'A' && $amount != null)
    {
        exit("Admin does not have an account.  Cannot specify amount for Admin.");
    }
    
    //no specified amount for user
    if($type != 'A' && $amount == null)
    {
        exit("No amount specified for the user.  User MUST specify an amount.");
    }
    
    //Not a number
    if($type != 'A' && !is_numeric($amount)){
        exit("Cannot enter a non-number.  Please enter a numeric value and try again.");
    }
    
    //less than 0
    if($type != 'A' && $amount < 0){
        exit("Cannot enter a number less than 0.  Please edit amount and try again.");
    }
    return $type;
}
function user ($name, $pass, $amount, $type)
{
    //inside user
    $user = $_GET [ "user" ];
    print "<br>The submitted user is: <b>$user</b><br><br>";
    //only display submitted users information
    $userAccounts = "SELECT * FROM accounts where user = '$name'";
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
    };
    //number of rows retrieved
    print "<br>The number of rows retrieved from the table is: <b>$num</b><br>";
    
}
function admin ($name, $pass)
{
  //inside admin
  if($name != "bond" || $pass != "007"){
    exit("Incorrect Admin Information.  Exiting");
    }
  return;
}
function update ($name, $amount, $type) 
{
  //Inside update
  //add a row to the transactions table
  $s = "insert into transactions values ('$name', '$type', '$amount', NOW())";
  echo "<br>The SQL statement used to update the Transactions Table: $s.<br>";
  mysql_query ($s) or die (mysql_error());
  
  echo "$type<br>";
  
  //add to current balance if deposit
  if ($type == 'D') 
  {
    $newS = "Update accounts set current_balance = current_balance + '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $newS.<br>";
    mysql_query ($newS) or die (mysql_error());
  }
  
  //subtract from current balance if withdrawl
  if ($type == 'W') 
  {
    $newS = "Update accounts set current_balance = current_balance - '$amount' where user = '$name' ";
    echo "<br>The SQL statement used to update the Current Balance: $newS.<br>";
    mysql_query ($newS) or die (mysql_error());
  }
  
}
function sql ($type, $name, &$uA, &$uT ){
  //If admin, display all table information
  if ($type == 'A')
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





































?>