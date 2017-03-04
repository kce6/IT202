<?php
    if (isset($_POST['type']) && $_POST['type'] == 'withdraw') {
        include('userPage.php');
    } elseif (isset($_POST['type']) && $_POST['type'] == 'deposit') {
         include('userPage.php');
    } elseif (isset($_POST['type']) && $_POST['type'] == 'admin') {
         include('adminPage.php');
    } else {
          echo "Please make a selection"
    }
 ?>
















