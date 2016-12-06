<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Slider Title</th>
					<th>Image</th>
					<th>Link</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
		<?php 
			$query = "select * from tbl_slider";

			$slider  = $db->select($query);
			if($slider){
				$i = 0;
				while ($result = $slider->fetch_assoc()) {
					$i++;
		?>
		<tr class="odd gradeX">
			<td><?php echo $i;?></td>
			<td><?php echo $result['title']; ?></td>
			<td><img src="<?php echo $result['image']; ?>" height="50px" width="70px" /></td>
			<td><?php echo $result['descrip']; ?></td>
			
			<td>
			<?php if(Session::get('userRole') == '0'){ ?>
				<a href="editslider.php?sliderid=<?php echo $result['id'];?>">Edit</a>|| 
			 	<a onclick="return confirm('Are You Sure to Delete This Post !');" href="deleteslider.php?delslider=<?php echo $result['id']; ?>">Delete</a>
			<?php } ?>
			 </td>
		</tr>

		<?php  } } ?>
				
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
 <?php include 'inc/footer.php';  ?>
