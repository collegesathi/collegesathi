<?php
date_default_timezone_set('Asia/Kolkata');

$lead_type = "";
$conn = new mysqli('localhost', 'onlinevidhya_user', 'wXqc2p1R#9YEW4Dw', 'collegesathi_new');
if(isset($_GET['search'])){
    $lead_type = $_GET['search'];
}

$number = 1;
$limit = 20;  
if (isset($_GET["page"])) {
	$page  = $_GET["page"]; 
	} 
	else{ 
	$page=1;
	}; 
$serial_number = ($page-1) * $limit + $number;
$start_from = ($page-1) * $limit; 

$sql = "SELECT * FROM `leads` WHERE `type` LIKE  '%$lead_type%' or `name` LIKE  '%$lead_type%' or `email` LIKE  '%$lead_type%' or `contactno` LIKE  '%$lead_type%' or `city` LIKE  '%$lead_type%' or `leadtype` LIKE  '%$lead_type%' ORDER BY id Desc LIMIT $start_from, $limit";
$query = mysqli_query($conn,$sql) or die("Error establishing a database connection". mysqli_error($conn));

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Collegesathi LMS</title>
    <!-- Favicon-->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
    <!-- Bootstrap Core Css -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-red">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a> -->
                <a class="navbar-brand" href="index.php">Collegesathi LMS</a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
        <section class="content">
            <div class="container-fluid">
                <!-- Basic Table -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="admin-pannel-excel">
                        <div class="card">
                            <div class="card-filter-section">
                            <div class="cstm_search">
                                <form method = "get" action="">
                                    <label>Search Leads:</label>
                                    <input type="text" class="form-filter" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="Search leads">
                                    <button class="btn btn-primary" name="filter">Submit</button>
                                </form>
                            </div>
                            <div class="cstm_search_type">
                                <form method="get" action="" class="cstm_type">
                                    <div class="form-inline">
                                        <label>Type:</label>
                                        <select class="cstm_filter form-filter" name="search">
                                            <option value="">Select</option>
                                            <option value="online-all-mba-colleges-india">online-all-mba-colleges-india</option>
                                            <option value="Amity-Online-MBA">Amity-Online-MBA</option>
                                            <option value="nmims-global-odl">nmims-global-odl</option>
                                            <option value="nmims-global-distance">nmims-global-distance</option>
                                            <option value="mba-wx">mba-wx</option>
                                            <option value="Manipalonline">Manipalonline</option>
                                        </select>
                                        <button class="btn btn-primary" name="filter">Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="cstm_filter_fb">
                                <form method="get" action="" class="cstm_type">
                                    <div class="form-inline">
                                        <label>From Facebook:</label>
                                        <select class="cstm_filter form-filter" name="search">
                                            <option value="">Select</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <button class="btn btn-primary" name="filter">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="admin-pannel-btn">
                            <div class="reset-button">
                            <button class="btn" name="reset"><b><img src="images/filter-btn.png"><a href="index.php">Reset All Filter</a></b></button>
                        </div> 
                        <div class="export-excelfile">  
                            <button id = "btnExport" class="btn btn-primary"><b><img src="images/download-btn.png"><a href="excel.php">Export to Excel</a></b></button>  
                            </div>
                        </div>   
                            <div class="body table-responsive">
                                <table class="table table-bordered" id="theTable">
                                    <thead>
                                        <tr>
                                            <th>S.NO</th>
                                            <th>TYPE</th>
                                            <th>NAME</th>
                                            <th>E-MAIL</th>
                                            <th>CONTACT-NUMBER</th>
                                            <th>PROGRAM</th>
                                            <th>FROM FACEBOOK</th>
                                            <th>ADMISSION</th>
                                            <th>CITY</th>
                                            <th>Qualification</th>
                                            <th>CREATE DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($data = mysqli_fetch_array($query)){
									?>
                                        <tr>
                                        <td><?php echo $serial_number++; ?></td>
                                        <td><?php echo (isset($data['type']) && !empty($data['type'])) ?  $data['type']  : 'N/A'; ?></td>
                                        <td><?php echo (isset($data['name']) && !empty($data['name'])) ?  $data['name']  : 'N/A'; ?></td>
                                        <td><?php echo (isset($data['email']) && !empty($data['email'])) ?  $data['email']  : 'N/A'; ?></td>
                                        <td><?php echo (isset($data['contactno']) && !empty($data['contactno'])) ? $data['contactno'] :'N/A' ; ?></td>
									    <td><?php echo (isset($data['program']) && !empty($data['program'])) ? $data['program'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['leadtype']) && !empty($data['leadtype'])) ? $data['leadtype'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['admission']) && !empty($data['admission'])) ? $data['admission'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['city']) && !empty($data['city'])) ? $data['city'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['qualification']) && !empty($data['qualification'])) ? $data['qualification'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['created_at']) && !empty($data['created_at'])) ? $data['created_at'] :'N/A' ; ?></td>
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                                <?php
                                if(!isset($_GET['search'])){
                                    $result_db = mysqli_query($conn,"SELECT COUNT(id) FROM leads"); 
                                    $row_db = mysqli_fetch_row($result_db);  
                                    $total_records = $row_db[0];  
                                    $total_pages = ceil($total_records / $limit); ?>                                              
                            </div>
                            <div class="excel-pegination">
                                <p>© All right reserved Collegesathi.com</p>

								<ul class="pagination ">                                    
									<li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
										<a class="page-link"
											href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $i=1; } ?>"><<</a>
									</li>
									 
									<?php
										$paggingStart	=	1;
										$paggingEnd		=	$total_pages;
										
										if(($page - 3) > 0 ){
											$paggingStart	=	$page - 3;
										}
										
										if(($page + 3) <= $total_pages){
											$paggingEnd		=	$page + 3;
										}
										
									?>
									
									<?php for($i = $paggingStart; $i <= $paggingEnd; $i++ ): ?>
									<li class="page-item ">
										<a class="page-link <?php if($page == $i) {echo 'active'; } ?>" href="index.php?page=<?= $i; ?>"> <?= $i; ?> </a>
									</li>
									<?php endfor; ?>
									 
									<li class="page-item <?php if($page >= $total_pages) { echo 'disabled'; } ?>">
										<a class="page-link"
											href="<?php if($page >= $total_pages){ echo '#'; } else {echo "?page=". $total_pages; } ?>">>></a>
									</li>
								</ul>
								
                            </div>
                            <?php  } ?>
                        </div>
                     </div>
                    </div>
                </div>
            </div>
        </section>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>
</body>
</html>
