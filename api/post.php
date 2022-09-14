<?php
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: *");               //domain ma tu lal tone loz ya ag

    require_once "../core/base.php"; 
    require_once "../core/functions.php"; 
    $sql = "SELECT * FROM posts WHERE 1";
    
    if(isset($_GET['id'])){
        $id = textFilter($_GET['id']);
        $sql .= " AND id = $id";
    }
    if(isset($_GET['limit'])){
        $limit = textFilter($_GET['limit']);
        $sql .= " LIMIT $limit";
    }
    if(isset($_GET['offset'])){
        $offset = textFilter($_GET['offset']);
        $sql .= " OFFSET $offset";
    }
    $query =mysqli_query(conn(),$sql);
    $rows = [];
    while($row = mysqli_fetch_assoc($query)){
        $ary = [
            "id" => $row['id'],
            "title" => $row['title'],
            "description" => $row['description'],
            "category" => category($row['category_id'])['title'],
        ] ;
        array_push($rows,$ary);
    }
    apiOutput($rows);