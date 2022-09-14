<?php include "template/header.php"; ?>
<?php include "core/admin.php"; ?>
<?php include "core/admin&editor.php"; ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Ads</li>
            </ol>
        </nav>
    </div>
</div>
<?php
    if(isset($_POST['addBtn'])){
        userAdd();
    }
?>    
<form class="row" method="post" enctype="multipart/form-data">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-users text-primary"></i> Add Ads
                    </h4>
                    <a href="<?php echo $url; ?>/user_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>                    
                </div>
                <hr>
               
                <div class="form-group">
                    <label for=""><i class="feather-user text-primary"></i> Enter Ownername</label>
                    <input type="text" name="username" id="" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for=""><i class="feather-file text-primary"></i> Choose Photo</label>
                    <div class="row">
                    <div class="col-6">
                        <input type="file" class="form-control" name="" id="">
                    </div>
                    OR
                    <div class="col-5">
                        <input type="text" class="w-100 form-control" name="" id="">
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for=""><i class="feather-calendar text-primary"></i> Start Date</label>
                    <input type="date" name="start" class="form-control" id="">
                </div>
                <div class="form-group">
                    <label for=""><i class="feather-calendar text-primary"></i> End Date</label>
                    <input type="date" name="end" class="form-control" id="">
                </div>
                <div class="form-group mb-0">
                    <button class="btn btn-primary" name="addBtn">Add</button>                        
                </div> 
            </div>
        </div>
    </div>
    
</form>

<?php include "template/footer.php"; ?>
