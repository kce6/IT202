<?php

function get_case ( $name, $pass, $amount, $type) {

  echo "Inside get_case.<br>";
  return $type;

}


function user ($name, $pass, $amount, $type) {
  
  echo "Inside User.<br>";
  //exit if bad credentials
  $s = "select * from accounts";
  ($t = mysql_query($s) or die (mysql_error()));
  $r = mysql_fetch_array($t);
  //exit if attempted overdraft

}


function admin ($name, $pass) {

  echo "Inside Admin.<br>";
  //exit if bad credentials
  
  if ($name != 'admin'){
    echo "<br><b>Incorrect Credentials</b>";
    exit;
  }

  else {
    
    if ($pass != '007') {
      echo "<br><b>Incorrect Credentials</b>";
      exit;
    }
  
  }
  
}


function update ($name, $amount, $type) {
  
  echo "Inside Update.<br>";
  //add a row to the transactions table
  
  $s = "insert into transactions values ('$name', '$type', '$amount', NOW())";
  echo "<br>The SQL statement used to update the Transactions Table: $s.<br>";
  mysql_query ($s) or die (mysql_error());
  
  echo "$type<br>";
  
  if ($type == 'D') {
  
    $s = "Update accounts set current_balance = current_balance + '$amount' where user = '$name' ";
    
  }
  
  if ($type == 'W') {
  
    $s - "Update accounts set current_balance = current_balance - '$amount' where user = '$name' ";
    
  }
  
  echo "The SQL Statement used to update the Accounts Table: $s.<br>";
  mysql_query($s) or die (mysql_error());
  
}



function get_A ($type, $s) {

  $result = "";
  $result .= "<br> \$s is: $s <br>";
  $result .= "<br> \$type is: $type <br>";
  
  ($t = mysql_query ($s) ) or die (mysql_error() );
  
  while ($r = mysql_fetch_array($t) ) {
    $user = $r["user"];
    $email = $r["email"];
    $result .= "<br>User is $user ";
    $result .= "<br>$user email is $email";
    
  }
  return $result




?>





































?>