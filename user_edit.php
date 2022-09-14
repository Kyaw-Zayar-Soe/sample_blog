<?php include "template/header.php"; ?>
<?php include "core/admin.php"; ?>
<?php include "core/admin&editor.php"; ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/user_list.php">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
</div>
<?php
    $id = $_GET['id'];
    $current = user($id);
    if(isset($_POST['updBtn'])){
        userUpdate();
    }
?>    
<form class="row" method="post">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-users text-primary"></i> Edit User
                    </h4>
                    <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>                    
                </div>
                <hr>
                        <input type="hidden" name="id" value="<?php echo $current['id']; ?>">
                    <div class="form-group">
                        <label for=""><i class="feather-user text-primary"></i> Enter Username</label>
                        <input type="text" name="usrname" id="" value="<?php echo $current['name']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-mail text-primary"></i> Enter User's email</label>
                        <input type="mail" name="usremail" id="" value="<?php echo $current['email']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-lock text-primary"></i> Create new Password</label>
                        <input type="password" name="usrpass" min="6" id="" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for=""><i class="feather-lock text-primary"></i> Re-type Password</label>
                        <input type="password" name="usrcpass" min="6" id="" class="form-control" required>
                    </div>  
                    <div class="form-group mb-0">
                        <button class="btn btn-primary" name="updBtn">Update</button>                        
                    </div> 
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                     <h4 class="mb-0">
                         <i class="feather-layers text-primary"></i> Select Role
                     </h4>
                     <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                         <i class="feather-list"></i>
                     </a>
                </div>
                    <hr>
                 
                <div class="form-group">
                        <label for="">Choose Role</label>
                        <select name="role" id="" class="custom-select">
                            <?php foreach($role as $k=>$usr){ ?>
                                <option value="<?php echo $k; ?>"
                                    <?php echo $k==$current['role']?'Selected':''; ?>
                                ><?php echo $usr; ?></option>
                            <?php }; ?>
                        </select>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include "template/footer.php"; ?>
