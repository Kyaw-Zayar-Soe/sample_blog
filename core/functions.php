<?php
    //common start
        function showTime($time,$format = 'd-m-y'){
            return date($format,strtotime($time));
        }

        function short($str,$length="40"){
            return substr($str,0,$length)."...";
        }

        function textFilter($text){
            $text1 = trim($text);
            $text2 = htmlentities($text1,ENT_QUOTES);          //entites change html tag sign twy ko
            $text3 = stripcslashes($text2);                   //slah twy ko phyat htote
            return $text3;
        }

        function alert($text,$color){
            return "<p class='alert alert-$color'>$text</p>";
        }

        function query($sql){
            $conn = conn();
            if(mysqli_query($conn,$sql)):
                return true;
            else:
                die("Fail : ".mysqli_error($conn));
            endif;
        }

        function fetch($sql){
            $query = mysqli_query(conn(),$sql);
            $row = mysqli_fetch_assoc($query);            
            return $row;
        }

        function fetchAll($sql){
            $query = mysqli_query(conn(),$sql);
            $rows = [];
            while($row = mysqli_fetch_assoc($query)){
                array_push($rows,$row);
            }
            return $rows;
        }

        function redirect($l){
            return header("location:$l");
        }

        function linkTo($l){
            echo "<script>location.href='$l'</script>";
        }

        function countTable($table, $condition = 1){
            $sql = "SELECT COUNT(id)AS Total FROM $table WHERE $condition";
            $row = fetch($sql);
            return $row['Total'];
        }
    //common end

    // auth start
        function register(){
        $name = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if($password == $cpassword):
            $super = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$super')";
           if(query($sql)){
                redirect('login.php');
           };
        else:
            return alert('Password don\'t match!','warning');
        endif;

        }

        function login(){
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $sql = "SELECT * FROM users WHERE email='$email'";
            $query = mysqli_query(conn(),$sql);
            $row = mysqli_fetch_assoc($query);
            if(!$row){
                return alert('Email or Password don\'t match','warning');
            }else{
                if(!password_verify($pass,$row['password'])){
                    return alert('Email or Password don\'t match','warning');
                }else{
                    session_start();
                    $_SESSION['user'] = $row;
                    redirect('dashboard.php');
                }
            }
        }
    // auth end

    // user start
        function userDelete($id){
            $sql = "DELETE FROM users WHERE id = $id";
            return query($sql);
        }
        
        function user($id){
            $sql = "SELECT * FROM users WHERE id = $id";
            return fetch($sql);
        }

        function users(){
            $sql = "SELECT * FROM users";
            return fetchAll($sql);
        }

        function userAdd(){
            $name = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $userRole = $_POST['user_role'];

            if($password == $cpassword):
                $super = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$super','$userRole')";
                if(query($sql)){
                    linkTo('user_list.php');
                };
            else:
                echo alert("Password don't match!","warning");
            endif;        
            
        }

        function userUpdate(){
            $id = $_POST['id'];
            $usrname = $_POST['usrname'];
            $usremail = $_POST['usremail'];
            $usrpass = $_POST['usrpass'];
            $usrcpass = $_POST['usrcpass'];
            $role = $_POST['role'];

            if($usrpass == $usrcpass):
                $super = password_hash($usrpass,PASSWORD_DEFAULT);
                $sql = "UPDATE users SET name='$usrname',email='$usremail',password='$super',role='$role' WHERE id=$id";
                if(query($sql)){
                    linkTo('user_list.php');
                };
            else:
                echo alert("Password don't match!","warning");
            endif;       
        }

        
    // user end

    //post start
        function postAdd(){
            $title = textFilter($_POST['title']);
            $description = textFilter($_POST['description']);
            $category_id = isCategory($_POST['category_id']);
            $user_id = $_SESSION['user']['id'];
            $sql = "INSERT INTO posts (title,description,user_id,category_id) VALUES ('$title','$description','$user_id','$category_id')";
             if(query($sql)){
                 linkTo('post_add.php');
             }
        }

        function postUpdate(){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            $description = isCategory($_POST['description']);
            $sql = "UPDATE posts SET title='$title',category_id='$category_id',description='$description' WHERE id =$id";
            return query($sql);
        }

        function postDelete($id){
            $sql = "DELETE FROM posts WHERE id = $id";
            return query($sql);
        }

        function post($id){
            $sql = "SELECT * FROM posts WHERE id = $id";
            return fetch($sql);
        }

        function posts(){
            if($_SESSION['user']['role']){
                $current_user_id = $_SESSION['user']['id'];
                $sql = "SELECT * FROM posts WHERE user_id='$current_user_id'";
            }else{
                $sql = "SELECT * FROM posts";
            }
            return fetchAll($sql);
        }

    //post end

    //category start

        function isCategory($id){
            if(category($id)){
                return $id;
            }else{
                die(alert("Category is invalid",'danger'));
            }
        }    

        function categoryAdd(){
            $title = textFilter($_POST['title']);
            $user_id = $_SESSION['user']['id'];
            $sql = "INSERT INTO categories (title,user_id) VALUES ('$title','$user_id')";
            if(query($sql)){
                linkTo('category_add.php');
            }
        }

        function categoryUpdate(){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $sql = "UPDATE categories SET title='$title' WHERE id =$id";
            return query($sql);
        }

        function categoryDelete($id){
            $sql = "DELETE FROM categories WHERE id = $id";
            return query($sql);
        }

        function category($id){
            $sql = "SELECT * FROM categories WHERE id = $id";
            return fetch($sql);
        }

        function categories(){
            $sql = "SELECT * FROM categories ORDER BY ordering DESC";
            return fetchAll($sql);
        }

        function pinToTop($id){
            $sql = "UPDATE categories SET ordering='0'";
            mysqli_query(conn(),$sql);

            $sql = "UPDATE categories SET ordering='1' where id=$id";
            return query($sql);
        }

        function removePin(){
            $sql = "UPDATE categories SET ordering='0'";
            return query($sql);
        }

    //category end

    //frontpanel start

        function fposts($ordercol='id',$ordertype='DESC'){
            $sql = "SELECT * FROM posts ORDER BY $ordercol $ordertype";
            return fetchAll($sql); 
        }

        function fcategories(){
            $sql = "SELECT * FROM categories ORDER BY ordering DESC";
            return fetchAll($sql);
        }

        function fPostByCat($x,$limit="9999",$y=0){
            $sql = "SELECT * FROM   posts WHERE category_id = $x AND id != $y ORDER BY id DESC LIMIT $limit";
            return fetchAll($sql);
        }

        function fSearch($search){
            $sql = "SELECT * FROM posts WHERE title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY id DESC";
            return fetchAll($sql);
        }

        function fSearchByDate($start,$end){
            $sql = "SELECT * FROM posts WHERE created_at BETWEEN '$start' AND '$end' ORDER BY id DESC";
            return fetchAll($sql);
        }
        
    //frontpanel end

    //View count start
        
        function viewRecord($userID,$postID,$device){
            $sql = "INSERT INTO viewers (user_id,post_id,device) VALUES ('$userID','$postID','$device')";
            return query($sql);
        }

        function viewRecordByPost($postId){
            $sql = "SELECT * FROM viewers WHERE post_id='$postId'";
            return fetchAll($sql);
        }

    //View count end

    //ads start

        function ads(){
            $today = date('Y-m-d');
            $sql = "SELECT * FROM ads WHERE start <= '$today' AND end > '$today'";
            return fetchAll($sql);
        }
        
    //ads end

    //payment start
        
        function payNow(){
            $from = $_SESSION['user']['id'];
            $to = $_POST['toUser'];
            $amount = $_POST['amount'];
            $description = $_POST['description'];

            //from user money update
            $fromUserDetail = user($from);
            $leftMoney = $fromUserDetail['money'] - $amount;
            if($fromUserDetail['money'] >= $amount){
                $sql = "UPDATE users SET money = '$leftMoney' WHERE id = '$from'";
                mysqli_query(conn(),$sql);

                //to user money update
                $toUserDetail = user($to);
                $newMoney = $toUserDetail['money'] + $amount;
                $sql = "UPDATE users SET money = '$newMoney' WHERE id = '$to'";
                mysqli_query(conn(),$sql);

                //add to transition table
                $sql = "INSERT INTO transition (from_user,to_user,amount,description) VALUES ('$from','$to','$amount','$description')";
                query($sql);
            }    
        }

        function transition($id){
            $sql = "SELECT * FROM transition WHERE id = '$id'";
            return fetchAll($sql);
        }

        function transitions(){
            $userId = $_SESSION['user']['id'];
            if($_SESSION['user']['role'] == 0){
                $sql = "SELECT * FROM transition";
            }else{
                $sql = "SELECT * FROM transition WHERE from_user = '$userId' OR to_user = '$userId'";
            }            
            return fetchAll($sql);
        }
        
    //payment end

    //dashboard start

        function dashboardPosts($limit = 999999){
            if($_SESSION['user']['role']){
                $current_user_id = $_SESSION['user']['id'];
                $sql = "SELECT * FROM posts WHERE user_id='$current_user_id' ORDER BY id DESC LIMIT $limit";
            }else{
                $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $limit";
            }
            return fetchAll($sql);
        }   
        
        function dashboardTran($limit = 999999){
            $userId = $_SESSION['user']['id'];
            if($_SESSION['user']['role'] == 0){
                $sql = "SELECT * FROM transition ORDER BY id DESC LIMIT $limit";
            }else{
                $sql = "SELECT * FROM transition WHERE from_user = '$userId' OR to_user = '$userId' ORDER BY id DESC LIMIT $limit";
            }            
            return fetchAll($sql);
        }

    //dashboard end

    //api start
        
        function apiOutput($re){
            echo json_encode($re);  
        }    

    //api end