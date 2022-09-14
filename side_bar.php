
<div class="col-12 col-md-4">
    
            <img src="./assets/img/Coffee-adv.jpeg" class="w-100" alt="">
      
    <div class="frontpanel_sidebar">
        <div class="card mb-4">
            <div class="card-body">
                <?php if(isset($_SESSION['user']['id'])){ ?>
                    <p>Hi <b class="text-capitalize"><?php echo $_SESSION['user']['name'];?></b></p>
                    <a href="dashboard.php" class="btn btn-info">Go Dashboard</a>
                <?php }else{ ?>
                    <p>Hi <b>Guest</b></p>
                    <a href="register.php" class="btn btn-info">Register Here!</a> 
                <?php } ?>
            </div>
        </div>
        <h4>Category List</h4>
        <div class="list-group mb-4">
            <a href="<?php echo $url; ?>/index.php" class="list-group-item list-group-item-dark list-group-item-action <?php echo isset($_GET['category_id'])?'':'active'; ?>" aria-current="true">
                All categories
            </a>
            <?php foreach(fcategories() as $cs){ ?>
            <a href="cat_sidebar.php?category_id=<?php echo $cs['id'] ?>" class="list-group-item list-group-item-action 
                <?php echo isset($_GET['category_id'])? $_GET['category_id']==$cs['id']?'active':'' :''; ?>">
                <?php if($cs['ordering']==1){ ?>
                    <i class="feather-paperclip text-primary"></i>
                <?php }?>
                <?php echo $cs['title']; ?></a>
            <?php }?>
        </div>
        
        <div class="mb-0">
        <h4>Search By Date</h4>
            <div class="card">
                <div class="card-body">
                
                    <form action="search_by_date.php" method="Post">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end" class="form-control" id="">
                        </div>
                        <button class="btn btn-info">
                            <i class="feather-calendar"></i>Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>