
<?php include "template/header.php"; ?>
<?php include "core/admin.php"; ?>
<?php include "core/admin&editor.php"; ?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-users text-primary"></i> User List
                    </h4>
                   <div class="">
                        <a href="<?php echo $url; ?>/user_add.php" class="btn btn-outline-primary">
                                <i class="feather-user-plus"></i>
                            </a>
                        <a href="#" class="btn btn-outline-secondary full-screen-btn">
                                <i class="feather-maximize-2"></i>
                        </a>
                   </div>
                    
                </div>
          
                <hr>
                <table class="table table-hover mt-3 mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Control</th>
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           foreach(users() as $us){
                        ?>
                             <tr>
                                 <td><?php echo $us['id']; ?></td>
                                 <td><?php echo $us['name']; ?></td>
                                 <td><?php echo $us['email']; ?></td>
                                 <td><?php echo $role[$us['role']]; ?></td>
                                 <td>
                                     <a href="user_delete.php?id=<?php echo $us['id'] ?>"
                                      onclick="return confirm('Are you sure to delete this user')" class="btn btn-outline-danger btn-sm">
                                     <i class="feather-trash-2 fa-fw"></i></a>

                                     <a href="user_edit.php?id=<?php echo $us['id'] ?>" class="btn btn-outline-warning btn-sm">
                                     <i class="feather-edit-2 fa-fw"></i></a>
                                    
                                 </td>
                                 <td><?php echo showTime($us['created_at']); ?></td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
<script>
    $(".table").dataTable({
        "order" : [[0,"desc"]]
    });
</script>