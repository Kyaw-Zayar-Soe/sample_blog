<?php session_start(); ?>
<?php include "front_panel/header.php";?>
<title>Home</title>
<?php include "front_panel/side_header.php";?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item active" aria-current="page">Home</li>
            </ol>
        </nav>
            <div class="">
                <div class="dropdown mb-4 text-right">
                    <button class="btn btn-dark dropdown-toggle" data-toggle="dropdown" href="#" role="button" id="dropdownMenuButton"  aria-haspopup="true" aria-expanded="false">
                        <i class="feather-calendar"></i> Sort News
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo $url;?>">
                            <i class="feather-list"></i> Default
                        </a>
                        <a class="dropdown-item" href="<?php echo $url;?>?order_by=created_at&order_type=ASC">
                            <i class="feather-arrow-down-circle"></i> Oldest to Newest
                        </a>
                        <a class="dropdown-item" href="<?php echo $url;?>?order_by=created_at&order_type=DESC">
                            <i class="feather-arrow-up-circle"></i> Newest to Oldest
                        </a>  
                    </div>
                </div>
                <?php 
                    if(isset($_GET['order_by']) && isset($_GET['order_type'])){
                        $ordercol = $_GET['order_by'];
                        $ordertype = strtoupper( $_GET['order_type']);
                        $posts = fposts($ordercol,$ordertype);
                    }else{
                        $posts = fposts();
                    }
                    
                    foreach($posts as $ps){ ?>
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