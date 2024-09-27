<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata');

$lead_type = "";
$conn = new mysqli('localhost', 'root', '','new_collegesathi');
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

$sql = "SELECT * FROM `job_detail`";
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
                <a class="navbar-brand" href="index.php">Collegesathi job detail</a>
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
                                            
                                            <th>NAME</th>
                                            <th>E-MAIL</th>
                                            <th>CONTACT-NUMBER</th>                                         
                                            
                                            
                                            <th>job role</th>
                                            <th>experience</th>
                                            <th>resume</th>
                                            <th>CREATE DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        while($data = mysqli_fetch_array($query)){
                                            $resume = base64_encode($data['resume']);
                                            $resumeLink = "data:application/octet-stream;base64," . $resume;
                                    
									?>
                                        <tr>
                                        <td><?php echo $serial_number++; ?></td>
                                        <td><?php echo (isset($data['name']) && !empty($data['name'])) ?  $data['name']  : 'N/A'; ?></td>
                                        <td><?php echo (isset($data['email']) && !empty($data['email'])) ?  $data['email']  : 'N/A'; ?></td>
                                        <td><?php echo (isset($data['phone_no']) && !empty($data['phone_no'])) ? $data['phone_no'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['job_role']) && !empty($data['job_role'])) ? $data['job_role'] :'N/A' ; ?></td>
                                        <td><?php echo (isset($data['experience']) && !empty($data['experience'])) ? $data['experience'] :'N/A' ; ?></td>

                                        <td><?php echo (isset($data['created_at']) && !empty($data['created_at'])) ? $data['created_at'] :'N/A' ; ?></td>
                                        <td><a href='<?php echo $resumeLink;?>' download='resume'>Download Resume</a></td>    
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
