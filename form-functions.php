<?php

//Get Case Function
function get_case ( $name, $pass, $amount, $type) {

  echo "Inside get_case.<br>"
  return $type;

}



function admin ($name, $pass){

  echo "Inside admin. This is just a stub.<br>";
  //exit if bad credentials 
  return;
  
}


function user ($name, $pass, $amount, $type) {
  $sqlStatement = "select * from accounts where user = '$name' and pass =
  '$pass'";
  return $sqlStatement;

  if (mysql_num_rows ($transactions) == 0) {
    exit ("No matching entries found")
  }
//exit if attmepted over-withdraw
}
 
function update ($name, $amount, $type){
echo "Inside update.<br>"; 
// add a row to transactions
}
 
$s = "insert into transactions values ( '$name', '$type', '$amount', NOW())";
echo "<br>SQL insert to transactions: $s.<br>"; 
mysql_query ($s)   or die (mysql_error() );
 
// change a row in accounts -  use an update SQL
 
$s = "Update accounts Set current_balance = current_balance + '$amount' Where user = '$name' ";
 
echo "SQL update of A: $s. <br>" ;
mysql_query ($s)   or die (mysql_error() ) ;
 
 
// if 'D' then add $amount to current_balance of $name in A table
// if 'W' then subtract $amount from current_balance of $name in A
}
print "<br><br>";


?>
