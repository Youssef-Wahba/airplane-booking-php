
<?php require "config/database.php"?>
<?php require "src/controllers/AccountController.php";

   $ret = AccountController::register("test@gmaifl.com", "testdf", "test", 1);
    if($ret){
         echo "success";
    } else {
         echo "fail";
    }
    




?>
