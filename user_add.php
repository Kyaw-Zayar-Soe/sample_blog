<?php include "template/header.php"; ?>
<?php include "core/admin.php"; ?>
<?php include "core/admin&editor.php"; ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/user_list.php">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add User</li>
            </ol>
        </nav>
    </div>
</div>
<?php
    if(isset($_POST['regBtn'])){
        userAdd();
    }
?>    
<form class="row" method="post">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-user-plus text-primary"></i> Create New User
                    </h4>
                    <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>                    
                </div>
                <hr>
               
                    <div class="form-group">
                        <label for=""><i class="feather-user text-primary"></i> Enter Username</label>
                        <input type="text" name="username" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-mail text-primary"></i> Enter User's email</label>
                        <input type="mail" name="email" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-lock text-primary"></i> Enter Password</label>
                        <input type="password" name="password" min="6" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-lock text-primary"></i> Confirm Password</label>
                        <input type="password" name="cpassword" min="6" id="" class="form-control" required>
                    </div>  
                    <div class="form-group mb-0">
                        <button class="btn btn-primary" name="regBtn">Submit</button>                        
                    </div> 
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                     <h4 class="mb-0">
                         <i class="feather-feather text-primary"></i> Select Role
                     </h4>
                     <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                         <i class="feather-list"></i>
                     </a>
                </div>
                    <hr>
                <div class="form-group">
                        <?php foreach($role as $k=>$ur){ ?>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="RadioRole<?php echo $k;?>" value="<?php echo $k;?>" name="user_role" class="custom-control-input" required>
                                <label class="custom-control-label" for="RadioRole<?php echo $k;?>"> <?php echo $ur; ?> </label>
                            </div>
                        <?php }; ?>
                </div>  
            </div>
        </div>
    </div>
</form>

<?php include "template/footer.php"; ?>
