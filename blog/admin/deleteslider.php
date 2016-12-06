<?php
	include '../lib/Session.php';
	Session::checkSession();
	include '../config/config.php';
	include '../lib/Database.php';

?>
<?php
	$db  = new Database();
?>

<?php
	if(!isset($_GET['delslider']) || $_GET['delslider'] == NULL){
		echo "<script> window.location = 'sliderlist.php';</script>";
	}
	else{
		$delslider = $_GET['delslider'];

		$query = "select * from tbl_slider where id='$delslider'";
		$getSlider = $db->select($query);
		if($getSlider){
			while ($delSliderimg = $getSlider->fetch_assoc()) {
				$dellink = $delSliderimg['image'];
				unlink($dellink);
			}
		}
		$delquery = "delete from tbl_slider where id='$delslider'";
		$delSlider = $db->delete($delquery);
		if($delSlider){
			echo "<script>alert('Page Deleted Successful.');</script>";
			echo "<script>window.location = 'sliderlist.php';</script>";
			//echo "<span class='success'>Data Deleted Successful.</span>";
			//echo "<script>window.location = 'postlist.php';</script>";

		}
		else{
			echo "<script>alert('Page Not Deleted .');</script>";
			echo "<script>window.location = 'sliderlist.php';</script>";
			//echo "<span error='success'>Data Not Updated.</span>";
			//echo "<script>window.location = 'postlist.php';</script>";


		}
	}
?>