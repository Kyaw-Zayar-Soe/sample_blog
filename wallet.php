<?php include "template/header.php"; ?>
<?php
    if(isset($_POST['paynow'])){
        if(payNow()){
            linkTo('wallet.php');
        }
    }
?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wallet</li>
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
                        <i class="feather-dollar-sign text-primary"></i> My Wallet
                    </h4>
                    <div class="">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="feather-user"></i> Your Money <?php echo user($_SESSION['user']['id'])['money'] ;?>
                        </a>
                    </div>                    
                </div>
                
                <hr>
                
                <form action="#" method="post">
                    <div class="form-inline">
                        <select name="toUser" id="" class="custom-select w-25 mr-2" required>
                                <option value="0" selected disabled>Select User</option>
                            <?php foreach(users() as $usr){ ?>
                                <?php if($usr['id'] != $_SESSION['user']['id']){ ?>
                                    <option value="<?php echo $usr['id']; ?>"><?php echo $usr['name'] ?></option>
                                <?php }?>    
                            <?php } ?>
                        </select>
                        <input type="number" class="form-control mr-2 w-25" min="100" max="<?php echo user($_SESSION['user']['id'])['money'] ;?>" name="amount" placeholder="Pay Amount" required>
                        <input type="text" class="form-control mr-2 w-25" name="description" placeholder="For What" required>
                        <button class="btn btn-primary" name="paynow">Transfer</button>
                    </div>
                </form>
                <hr>
               
                <table class="table table-hover mt-3 mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount</th>
                            <th>For What</th>
                            <th>Date / Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           foreach(transitions() as $t){
                        ?>
                          <tr>
                              <td><?php echo $t['id']; ?></td>
                              <td><?php echo user($t['from_user'])['name']; ?></td>
                              <td><?php echo user($t['to_user'])['name']; ?></td>
                              <td><?php echo $t['amount']; ?></td>
                              <td><?php echo $t['description']; ?></td>
                              <td><?php echo showTime($t['created_at'],'d-m-y /g:i A'); ?></td>
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
