<?php
//MAIN

sql ($type, $name, &$s1, &$s2);
echo $s1;

$out1 = get_A($type, $s1);
print $out1;

$out2 = get_T($type, $s1);
print $out2;

//FUNCTIONS

function sql ($type, $name, $s1, $s2) {

if ($type != 'A') {
  &$s1 = "select * from accounts where user = '$name'";
}
else ($type == 'A'){
  &$s1 = "select * from accounts";
}

if type not 'A' then &$s1 = "select * from accounts where user = '$name'";
else then &$s1 = "select * from accounts";

function get_A ($type, $s){
   $result = "";
   print "<br> \$s is: $s <br>";
   print "<br> \$type is: $type <br>";
   
   ($t = mysql_query($s)) or die (mysql_error());

   while ($r = mysql_fetch_array($t)){

      $user = $r["user"];
      $email = $r["email"];
      print "<br>user is is $user";
      print "<br>email is is email";
   }  
}

$to      = "joel123-njit@mailinator.com"    
$subject = "202";
$message = "This is <br> mine.";
$headers = "";
mail ($to, $subject, $message, $headers);
//joel123-njit@mailinator.com


PHP: if(isset($_GET["mailresult"]))
google: php mail headers manual
$headers = 'MME-Version: 1.0';
$headers .= 'Content-type: text/html; charset=iso-8859-1';




?>
