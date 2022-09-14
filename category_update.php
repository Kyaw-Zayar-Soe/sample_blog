<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                        <i class="feather-layers text-primary"></i> Category Manager
                    </h4>
                    <a href="<?php echo $url; ?>/item_list.php" class="btn btn-outline-primary">
                        <i class="feather-list"></i>
                    </a>
                </div>
                <hr>
                <?php
                    $id = $_GET['id'];
                    $current = category($id);
                    if(isset($_POST['catUpdate'])){
                        if(categoryUpdate()){
                            linkTo('category_add.php');
                        }
                    }
                ?>
                <form action="#" method="post">
                    <div class="form-inline">
                        <input type="hidden" name="id" value="<?php echo $current['id'] ?>">
                        <input type="text" class="form-control mr-2" name="title" value="<?php echo $current['title'] ?>">
                        <button class="btn btn-primary" name="catUpdate">Update Category</button>
                    </div>
                </form>
                <table class="table table-hover mt-3 mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Control</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           foreach(categories() as $cats){
                        ?>
                             <tr>
                                 <td><?php echo $cats['id'] ?></td>
                                 <td><?php echo $cats['title'] ?></td>
                                 <td><?php echo user($cats['user_id'])['name']; ?></td>
                                 <td>
                                     <a href="category_delete.php?id=<?php echo $cats['id'] ?>"
                                      onclick="return confirm('Are you sure to delete this category')" class="btn btn-outline-danger btn-sm">
                                     <i class="feather-trash-2 fa-fw"></i></a>

                                     <a href="category_update.php?id=<?php echo $cats['id'] ?>" class="btn btn-outline-warning btn-sm">
                                     <i class="feather-edit-2 fa-fw"></i></a>
                                    
                                 </td>
                                 <td><?php echo showTime($cats['created_at']); ?></td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>