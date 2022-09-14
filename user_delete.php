<?php
    include "template/header.php";
    $id = $_GET['id'];
    if(userDelete($id)){
        linkTo('user_list.php');
    }