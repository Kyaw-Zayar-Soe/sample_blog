<?php
    include "template/header.php";
    $id = $_GET['id'];
    if(pinToTop($id)){
        linkTo('category_add.php');
    }