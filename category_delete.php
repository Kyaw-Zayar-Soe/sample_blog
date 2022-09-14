<?php
    include "template/header.php";
    $id = $_GET['id'];
    if(categoryDelete($id)){
        linkTo('category_add.php');
    }