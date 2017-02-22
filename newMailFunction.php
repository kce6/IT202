<?php
$result1 = get_A ('some paramters');
echo $result1;

$result2 = get_T ('some paramters');
echo $result2;

$message = $result1 . $result2

isset ($_GET["mailresults"])

mymail ($type, $name, $message)

get_case ($type)

//BAD EXIT

//The Type is neither 'A' or 'D' or 'W'
if ($type != 'A' && $type != 'D' && $type != 'W') (exit ("invalid choice");

//No Number Input
if (is_numeric ($amount) {
  return $amount;
} else {
  exit ( "Invalid amount, please re-enter");
}

//Amount is Negative
if ($amount < 0) (exit ("no negative numbers");

//No Input in Username or Password
if (strlen($user) < 1) && (strlen($pass) < 1) {
  echo "Username or Password field is blank.  Please enter a both Username and
  Password";
}

//Is Username and Password in Accounts Table
$sqlStatement = "select * from accounts where user = '$name' and pass =
'$pass'";
return $sqlStatement;

if (mysql_num_rows ($transactions) == 0) (exit("No matching entries found")

//Overdraft Protection
while ($r = mysql_fetch_array($t)){
  $x = $r ["current_balance"];
}

//Check Admin Login
$adminCheck = "select * from Administrator where username = '$user' and
password = '$password'";
return $adminCheck

if (mysql_num_rows ($Administrator) == 0){
  exit "Administrator Username/Password Pair Incorrect";
}














?>
