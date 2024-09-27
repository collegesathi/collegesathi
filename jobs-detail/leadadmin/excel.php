<?php
$conn = new mysqli('localhost', 'collegesathi_live', '5SE9fLzA1!V%', 'collegesathi_live');
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

 $sql = "SELECT * FROM `leads`";
 $query = mysqli_query($conn,$sql) or die("database error:". mysqli_error($conn));
  
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "leads-data_" . date('Y-m-d') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('S.NO', 'TYPE', 'NAME', 'E-MAIL', 'CONTACT-NUMBER', 'PROGRAM', 'FROM FACEBOOK', 'ADMISSION','CITY'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $query->fetch_assoc()){ 
        $lineData = array($serial_number++, $row['type'], $row['name'], $row['email'], $row['contactno'], $row['program'], $row['leadtype'], $row['admission'], $row['city']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
?>