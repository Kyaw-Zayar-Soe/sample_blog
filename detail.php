<?php session_start(); ?>
<?php include "front_panel/header.php";?>
<title>Home</title>
<?php include "front_panel/side_header.php";?>
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $current = post($id);
    }else{
        linkTo('index.php');
    }

    if(!$current){
        linkTo('index.php');
    }
   


    $currentcat = $current['category_id']; 

    if(isset($_SESSION['user']['id'])){
        $userId = $_SESSION['user']['id'];
    }else{
        $userId = 0;
    }
    viewRecord($userId,$id,$_SERVER['HTTP_USER_AGENT'])
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Post Detail</li>
                </ol>
            </nav>
            <div class="">   
                <div class="card shadow-sm mb-4 post">
                    <div class="card-body">
                        <h4><?php echo $current['title'];?></h4>
                        <div class="my-3">
                            <i class="feather-user text-primary"></i>
                            <?php echo user($current['user_id'])['name']; ?>

                            <i class="feather-layers text-success"></i>
                            <?php echo category($current['category_id'])['title']; ?>

                            <i class="feather-calendar text-danger"></i>
                            <?php echo showTime($current['created_at'],'M j \a\t\ g:i A'); ?>
                        </div>
                        <div class="">
                            <?php echo html_entity_decode($current['description'],ENT_QUOTES);?>
                        </div>
                    </div>
                </div>
             
            <div class="row">
                <?php foreach(fPostByCat($currentcat,2,$id) as $ps){ ?>
                <div class="col-12 col-md-6">
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
                </div>
                <?php }; ?>
            </div>
            
            </div>
        </div>
        
        <?php require_once "side_bar.php";?>
    </div>
</div>

<?php include "front_panel/footer.php";?>