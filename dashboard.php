<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card mb-4 status-card" >
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <i class="feather-eye h1 text-primary"></i>
                    </div>
                    <div class="col-9">
                        <p class="mb-1 h4 font-weight-bolder">
                            <span class="counter-up"><?php echo countTable('viewers'); ?></span>
                        </p>
                        <p class="mb-0 text-black-50">Today Visitor</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card mb-4 status-card" onclick="go('<?php echo $url; ?>/post_list.php')">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <i class="feather-list h1 text-primary"></i>
                    </div>
                    <div class="col-9">
                        <p class="mb-1 h4 font-weight-bolder">
                            <span class="counter-up"><?php echo countTable('posts'); ?></span>
                        </p>
                        <p class="mb-0 text-black-50">Total Post</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card mb-4 status-card" onclick="go('<?php echo $url; ?>/category_add.php')">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <i class="feather-layers h1 text-primary"></i>
                    </div>
                    <div class="col-9">
                        <p class="mb-1 h4 font-weight-bolder">
                            <span class="counter-up"><?php echo countTable('categories'); ?></span>
                        </p>
                        <p class="mb-0 text-black-50">Total Category</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-3">
        <div class="card mb-4 status-card" onclick="go('<?php echo $url; ?>/user_list.php')">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-3">
                        <i class="feather-users h1 text-primary"></i>
                    </div>
                    <div class="col-9">
                        <p class="mb-1 h4 font-weight-bolder">
                            <span class="counter-up"><?php echo countTable('users'); ?></span>
                        </p>
                        <p class="mb-0 text-black-50">Total User</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-12 col-xl-7">
        <div class="card overflow-hidden shadow mb-4">
            <div class="">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <h4 class="mb-0">Visitors</h4>
                    <div class="">
                        <?php foreach(users() as $u){ ?>
                        <img src="<?php echo $url;?>/assets/img/user/<?php echo $u['photo']; ?>" class="ov-img rounded-circle" alt="">
                        <?php }; ?>
                    </div>
                </div>                
                <canvas id="ov" height="138"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-6 col-xl-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <h4 class="mb-0">Post / Category</h4>
                    <div class="">
                        <i class="feather-pie-chart h4 mb-0 text-primary"></i>
                    </div>
                </div>
                
                <canvas id="op" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <div class="card overflow-hidden mb-4" onclick="go('<?php echo $url; ?>/wallet.php')">
            <div class="">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <p class="mb-0">Transition History</p>
                    <div class="">
                        <i class="feather-more-vertical h4 mb-0 text-primary"></i>
                    </div>
                </div>
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
                           foreach(dashboardTran(7) as $t){
                        ?>
                          <tr>
                              <td class="text-nowrap"><?php echo $t['id']; ?></td>
                              <td class="text-nowrap"><?php echo user($t['from_user'])['name']; ?></td>
                              <td class="text-nowrap"><?php echo user($t['to_user'])['name']; ?></td>
                              <td class="text-nowrap"><?php echo $t['amount']; ?></td>
                              <td class="text-nowrap"><?php echo $t['description']; ?></td>
                              <td class="text-nowrap"><?php echo showTime($t['created_at'],'d-m-y /g:i A'); ?></td>
                          </tr>   
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-7">
        <div class="card overflow-hidden mb-4" onclick="go('<?php echo $url; ?>/post_list.php')">
            <div class="">
                <div class="d-flex justify-content-between align-items-center p-3">
                    <p class="mb-0">Recent Posts</p>
                    <div class="">
                        <?php
                            $currentUserId = $_SESSION['user']['id'];
                            $postTotal = countTable('posts');
                            $currentUserPostTotal = countTable('posts',"user_id = $currentUserId");
                            $totalPercentage = ($currentUserPostTotal/$postTotal)*100;
                            $finalPercentage = floor($totalPercentage);
                        ?>
                        <small>Your posts : <?php echo $currentUserPostTotal; ?></small>
                        <div class="progress" style="width: 300px;height: 15px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $finalPercentage; ?>%; " aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover mt-3 mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                        <?php if($_SESSION['user']['role'] == 0){ ?>
                            <th>User</th>
                        <?php } ?>
                            <th>Viewer Count</th>                            
                            <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           foreach(dashboardPosts(5) as $ps){
                        ?>
                             <tr>
                                 <td><?php echo $ps['id']; ?></td>
                                 <td><?php echo short($ps['title']); ?></td>
                                 <td><?php echo short(strip_tags(html_entity_decode($ps['description']))); ?></td>
                                 <td class="text-nowrap"><?php echo category($ps['category_id'])['title']; ?></td>                                 
                                 <?php if($_SESSION['user']['role'] == 0){ ?>
                                    <td><?php echo user($ps['user_id'])['name']; ?></td>                      
                                 <?php } ?>
                                 <td class="text-nowrap text-center">
                                     <?php echo count(viewRecordByPost($ps['id'])); ?>
                                 </td>
                                 
                                 <td class="text-nowrap"><?php echo showTime($ps['created_at']); ?></td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
<script src="<?php echo $url;?>/assets/vendor/way_point/jquery.waypoints.js"></script>
<script src="<?php echo $url;?>/assets/vendor/counter_up/counter_up.js"></script>
<script src="<?php echo $url;?>/assets/vendor/chart_js/chart.min.js"></script>
<script>
    $('.counter-up').counterUp({
    delay: 10,
    time: 1000
});
<?php
    $dateArry = [];
    $viewercount = [];
    $transitioncount = [];
    $today = date('Y-m-d');
    for($i=0;$i<20;$i++){
        $date = date_create($today);
        date_sub($date,date_interval_create_from_date_string("$i days"));
        $current = date_format($date,'Y-m-d');
        array_push($dateArry, $current);

        $result = countTable('viewers',"CAST(created_at AS DATE)='$current'");
        array_push($viewercount,$result);

        $result1 = countTable('transition',"CAST(created_at AS DATE)='$current'");
        array_push($transitioncount,$result1);
    }
   
    
?>
let dateArr = <?php  echo json_encode($dateArry); ?>;
let tranCountArr = <?php  echo json_encode($transitioncount); ?>;
let viewerCountArr = <?php echo json_encode($viewercount); ?>;

let ov = document.getElementById('ov').getContext('2d');
let ovChart = new Chart(ov, {
    type: 'line',
    data: {
        labels: dateArr,
        datasets: [
            {
                label: 'Transition Count',
                data: tranCountArr,
                backgroundColor: [
                    '#007bff30',
                ],
                borderColor: [
                    '#007bff',
                ],
                borderWidth: 1,
                tension:0
            },
            {
                label: 'Viewer Count',
                data: viewerCountArr,
                backgroundColor: [
                    '#28a74530',
                ],
                borderColor: [
                    '#28a745',
                ],
                borderWidth: 1,
                tension:0
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                display:false,
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes:[
                {
                    display:false,
                    gridLines:[
                        {
                            display:false
                        }
                    ]
                }
            ]
        },
        legend:{
            display: true,
            shape:"circle",
            position: 'top',
            labels: {
                fontColor: '#333',
                usePointStyle:true
            }
        }
    }
});

<?php
    $catarry = [];
    $countPostByCat = [];
    foreach(categories() as $c){
        array_push($catarry,$c['title']);
        array_push($countPostByCat,countTable('posts', "category_id = {$c['id']}"));
    }
   
?>

let catAry = <?php echo json_encode($catarry); ?>;
let countPost = <?php echo json_encode($countPostByCat); ?>;

let op = document.getElementById('op').getContext('2d');
let opChart = new Chart(op, {
    type: 'doughnut',
    data: {
        labels:catAry,
        datasets: [{
            label: '# of Votes',
            data:countPost,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                display:false,
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [
                {
                    display:false
                }
            ]
        },
        legend:{
            display: true,
            position: 'bottom',
            labels: {
                fontColor: '#333',
                usePointStyle:true
            }
        }
    }
});
</script>