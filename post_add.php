<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/post_list.php">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Post</li>
            </ol>
        </nav>
    </div>
</div>
    <?php
       if(isset($_POST['addPost'])){
           postAdd();
       }
    ?>
<form class="row" method="post">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-plus-circle text-primary"></i> Create New Post
                    </h4>
                    <a href="<?php echo $url; ?>/post_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>
                </div>
                <hr>
                
              
                    <div class="form-group">
                        <label for="">Post Title</label>
                        <input type="text" name="title" id="" class="form-control" required>
                    </div>
                    
                    <div class="form-group mb-0">
                        <label for="">Post Description</label>
                        <textarea name="description" id="description" class="form-control" rows="10" required></textarea>
                    </div>
                    
                
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                     <h4 class="mb-0">
                         <i class="feather-layers text-primary"></i> Select Category
                     </h4>
                     <a href="<?php echo $url; ?>/category_add.php" class="btn btn-outline-primary">
                         <i class="feather-list"></i>
                     </a>
                </div>
                    <hr>
                    <div class="form-group">
                            <?php foreach(categories() as $cats){ ?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio<?php echo $cats['id']; ?>" value="<?php echo $cats['id']; ?>" name="category_id" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio<?php echo $cats['id']; ?>"><?php echo $cats['title']; ?></label>
                                </div>
                            <?php } ?>
                    </div>  
                    <hr>
                    <button class="btn btn-primary" name="addPost">Add Post</button>             
            </div>
        </div>
    </div>
</form>

<?php include "template/footer.php"; ?>
<script>
    $("#description").summernote({
        placeholder: 'Hello Bootstrap 4',
        tabsize: 2,
        height: 500,

    });
</script>