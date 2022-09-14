<?php include "front_panel/header.php";?>
<title>Home</title>
<?php include "front_panel/side_header.php";?>
<?php 
    if(isset($_GET['category_id'])){
        $id = $_GET['category_id'];
        $current = category($id);
    }else{
        linkTo('index.php');
    }
    
    if(!$current){
        linkTo('index.php');
    }
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo category($id)['title']; ?> Category</li>
            </ol>
        </nav>
            <div class="">
                <?php foreach(fPostByCat($id) as $ps){ ?>
                <div class="card shadow-sm mb-4 post">
                    <div class="card-body">
                        <a href="detail.php?id=<?php echo $ps['id']; ?>" class="h4 text-info"><?php echo $ps['title']; ?></a>
                    <div class="my-3">
                        <i class="feather-user text-info"></i>
                        <?php echo user($ps['user_id'])['name']; ?>

                        <i class="feather-layers text-success"></i>
                        <?php echo category($ps['category_id'])['title']; ?>

                        <i class="feather-calendar text-danger"></i>
                        <?php echo showTime($ps['created_at'],'M j \a\t\ g:i A'); ?>
                    </div>
                        <p class="text-black-50"><?php echo short(strip_tags(html_entity_decode($ps['description'])),"200");?></p>
                    </div>
                </div>
                <?php }; ?>
            </div>
        </div>
        <?php require_once "side_bar.php";?>
    </div>
</div>

<?php include "front_panel/footer.php";?>