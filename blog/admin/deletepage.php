<?php
	include 'inc/header.php';
?>

<?php

	if(!isset($_GET['delpage']) || $_GET['delpage'] == NULL){
		echo "<scrip>window.location = 'index.php'; </script>";
	}
	else{
		$pageid = $_GET['delpage'];
		$query = "delete from tbl_page where id='$pageid'";
		$delData = $db->delete($query);
		if($delData){
			echo "<script>alert('Page Deleted Successful.');</script>";
			echo "<script>window.location = 'index.php';</script>";
		}
		else{
			echo "<script>alert('Page Not Deleted !');</script>";
			echo "<script>window.location = 'index.php';</script>";
		}
	}

?>