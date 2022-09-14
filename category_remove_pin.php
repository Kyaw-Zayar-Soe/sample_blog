<?php
    include "template/header.php";
    
    if(removePin()){
        linkTo('category_add.php');
    }