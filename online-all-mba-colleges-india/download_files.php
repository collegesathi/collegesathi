<?php session_start();
/* 
$_SESSION['university_name']	=	'Jain_University';
$_SESSION['download_broch']	=	'yes';
*/
 
if(isset($_SESSION['download_broch']) && ($_SESSION['download_broch'] == 'yes') && isset($_SESSION['university_name']) && !empty($_SESSION['university_name'])){
	
	$university_name	=	$_SESSION['university_name'];
	unset($_SESSION['download_broch']);
	unset($_SESSION['university_name']);
	
	$file_url	= 	'https://collegesathi.com/online-all-mba-colleges-india/pdf/' . $university_name .'.pdf';  
	$file_name	=	'university.pdf';  
	 
		
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	readfile($file_url);	
		
	/*
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: 0");
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	header('Content-Length: ' . filesize($file_url));
	header('Pragma: public');
	//Clear system output buffer
	flush();
	//Read the size of the file
	readfile($file_url);
	*/
	
	
	/* header('Content-Type: application/octet-stream');  
	header("Content-Transfer-Encoding: Binary");   
	header("Content-disposition: attachment; filename=\"" . basename($file_name) . "\"");   
	readfile($file_url);   */
	//header("Location: http://" . $_SERVER['SERVER_NAME']."/online-all-mba-colleges-india");
	exit;
}  
?>