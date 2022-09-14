<?php include "front_panel/header.php";?>
<title>Home</title>
<?php include "front_panel/side_header.php";?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Search posts between &nbsp; <b> " <?php echo $_POST['start']; ?> "</b> &nbsp; and &nbsp; <b> " <?php echo $_POST['end']; ?> "</b>
                </li>
            </ol>
        </nav>
            <div class="">
                <?php
                    $result = fSearchByDate($_POST['start'],$_POST['end']);
                    if(count($result) == 0){
                        echo alert("There is no result",'warning');
                    }
                ?>
                <?php foreach($result as $s){ ?>
                    <div class="card shadow-sm mb-4 post">
                        <div class="card-body">
                            <a href="detail.php?id=<?php echo $s['id']; ?>" class="h4 text-info"><?php echo $s['title']; ?></a>
                        <div class="my-3">
                            <i class="feather-user text-info"></i>
                            <?php echo user($s['user_id'])['name']; ?>

                            <i class="feather-layers text-success"></i>
                            <?php echo category($s['category_id'])['title']; ?>

                            <i class="feather-calendar text-danger"></i>
                            <?php echo showTime($s['created_at'],'M j \a\t\ g:i A'); ?>
                        </div>
                            <p class="text-black-50"><?php echo short(strip_tags(html_entity_decode($s['description'])),"200");?></p>
                        </div>
                    </div>
                <?php }; ?>
            </div>
        </div>
        <?php require_once "side_bar.php";?>
    </div>
</div>

<?php include "front_panel/footer.php";?>