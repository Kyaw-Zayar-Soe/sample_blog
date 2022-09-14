<?php
    include "template/header.php";
    $id = $_GET['id'];
    if(postDelete($id)){
        linkTo('post_list.php');
    }