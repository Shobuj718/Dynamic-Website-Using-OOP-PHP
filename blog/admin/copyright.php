<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
<?php
    $query = "select * from tbl_footer where id='1'";
    $footernote = $db->select($query);
    if($footernote){
        while ($result = $footernote->fetch_assoc()) {
?>
                <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['note']; ?>" name="note" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
<?php } } ?>
            </div>
        </div>
       <?php include 'inc/footer.php';  ?>