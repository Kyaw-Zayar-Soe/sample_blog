<?php
    require_once "core/base.php";
    require_once "core/functions.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/vendor/feather-icons-web/feather.css">
    <link rel="stylesheet" href="<?php echo $url; ?>/assets/css/style.css">
</head>
<body class="bg-dark">
<div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-center text-primary">
                        <h4><i class="feather-users"></i> User Login</h4>   
                    </div>
                    <div class="card-body">
                    <?php
                        if(isset($_POST['signBtn'])):
                            echo login();
                        endif;
                    ?>
                        <form action="" method="post">
                            
                            <div class="form-group">
                                <label for=""><i class="feather-mail text-primary"></i> Your email</label>
                                <input type="email" name="email" id="" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for=""><i class="feather-lock text-primary"></i> Enter Password</label>
                                <input type="password" name="password" min="6" id="" class="form-control" required>
                            </div> 
                            <div class="form-group mb-0">
                                <button class="btn btn-primary" name="signBtn"><i class="feather-log-in text-white"></i> Sign In</button>
                                <a href="register.php" class="btn btn-link float-right">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo $url; ?>/assets/vendor/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="<?php echo $url; ?>/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $url; ?>/assets/js/app.js"></script>
</body>
</html>