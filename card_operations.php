<?php
/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 11/3/2015
 * Time: 11:18 PM
 */

include 'functions.php';

if(isset($_POST['action']) && is_numeric($_POST['id'])){

    if($_POST['action'] == 'delete'){

        deleteCard($_POST['id']);

        echo 'apple';
    } else if($_POST['action'] == 'toggle' && is_numeric($_POST['value'])){

        toggleCardStatus($_POST['id'], $_POST['value']);

        echo 'apple';
    }

} else {
    header("HTTP/1.0 404 Not Found");
}

?>