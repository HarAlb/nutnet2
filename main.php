<?php 

define("APP" , require_once __DIR__ . "/config/config.php");
require_once __DIR__. "/db/db.php";

if(isset($_POST['clicked'])){
    $inputs = $_POST['clicked'];
    $errors = [];
    $mess = 'This field is not valid';

    if(!preg_match( '#^\w{1,100}#' , $inputs['username'])){
        $errors['username'] = $mess;
    }

    if(!preg_match( '#^\w{1,100}#' , $inputs['surname'])){
        $errors['surname'] = $mess;
    }

    if(!preg_match( '#^\d{1,2}#' , intval($inputs['surname']))){
        $errors['age'] = $mess;
    }

    if(empty($errors)){
        $db = new DB(APP["host"] , APP["user"] , APP["password"] , APP["db"]);
        $db->insertTable($inputs);
        
        echo json_encode(['success' => 'you registered Successfuly'] , JSON_FORCE_OBJECT); 
        exit();
    }

    echo json_encode($errors , JSON_FORCE_OBJECT); 
    exit();
}

if(isset($_POST['upload']))
{
    $db = new DB(APP['host'] , APP['user'] , APP['password'] , APP['db']);


}


exit("Silence is golden");