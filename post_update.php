<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/post_list.php">Post</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-plus-circle text-primary"></i> Edit Post
                    </h4>
                    <a href="<?php echo $url; ?>/post_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>
                </div>
                <hr>
                <?php
                    $id = $_GET['id'];
                    $current = post($id);
                    if(isset($_POST['updateBtn'])){
                        if(postUpdate()){
                            linkTo('post_list.php');
                        }
                    }
                ?>
                <form action="#" method="post">
                        <input type="hidden" name="id" value="<?php echo $current['id'];?>">
                    <div class="form-group">
                        <label for="">Post Title</label>
                        <input type="text" name="title" id="" value="<?php echo $current['title'];?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select name="category_id" id="" class="custom-select">
                            <?php foreach(categories() as $cats){ ?>
                                <option value="<?php echo $cats['id']; ?>"
                                    <?php echo $cats['id']==$current['category_id']?'Selected':''; ?>
                                ><?php echo $cats['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Post Description</label>
                        <textarea name="description" id="" class="form-control" cols="" rows="7" required><?php echo $current['description'];?></textarea>
                    </div>
                    <hr>
                    <button class="btn btn-primary" name="updateBtn">Update Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>