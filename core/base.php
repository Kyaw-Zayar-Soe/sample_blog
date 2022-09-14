<?php
    function conn(){
      return mysqli_connect('localhost','root','','sample_blog');
    }
    $info = array(
      "name" => "Mario",
      "short" => "Mr",
      "description" => "မင်္ဂလာပါကိုယ့်လူတို့",
    );


    $role = ['Admin','Editor','User'];
    
    $url = "http://{$_SERVER['HTTP_HOST']}/Projects/testing13/sample_blog";

    date_default_timezone_set('Asia/Yangon');