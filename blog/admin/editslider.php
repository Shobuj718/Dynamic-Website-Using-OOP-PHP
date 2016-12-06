<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
    if(!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL){
        echo "<script>window.location = 'sliderlist.php';</script>";
    }
    else{
        $sliderid = $_GET['sliderid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Slider</h2>
<?php  
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $title = mysqli_real_escape_string($db->link, $_POST['title']);
        $descrip = mysqli_real_escape_string($db->link, $_POST['descrip']);

        $permited  = array('jpg','jpeg','png','gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $upload_image = "upload/".$unique_image;

        if($title == "" || $descrip ==""){
            echo "<span class='error'>Field must not by empty !</span>";
        }
        else{
          if(!empty($file_name)){
            if($file_size > 104867){
                echo "<span class='error'>Image size should be less then 1MB !</span>";
            }
            elseif (in_array($file_ext, $permited) == false) {
                echo "<span class='error'>You can upload only:-".implode(',', $permited)."</span>";
            }
            else{
                move_uploaded_file($file_temp, $upload_image);

                $query = "UPDATE tbl_slider
                        SET
                        title  = '$title',
                        descrip= '$descrip',
                        image  = '$upload_image'
                        WHERE id='$sliderid'";

                $updated_rows = $db->update($query);
                if($updated_rows){
                    echo "<span class='success'>Slider Updated successful.</span>";
                }
                else{
                    echo "<span class='error'>Slider not Updated !</span>";
                }
            }
        }
        else{
          $query = "UPDATE tbl_slider
                    SET
                    title  = '$title',
                    descrip= '$descrip'
                    WHERE id='$sliderid'";

            $updated_rows = $db->update($query);
            if($updated_rows){
                echo "<span class='success'>Slider Updated successful.</span>";
            }
            else{
                echo "<span class='error'>Slider not Updated !</span>";
            }
        }
       }

    }
?>
        <div class="block">  
    <?php
        $query = "select * from tbl_slider where id='$sliderid'";
        $getslider = $db->select($query);
        if($getslider){
            while ( $sliderresult = $getslider->fetch_assoc()) {
                
    ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $sliderresult['title']; ?>" class="medium" />
                    </td>
                </tr>
             
                <tr>
                    <td>Image Link</td>
                    <td>
                    <input type="text" name="descrip" value="<?php echo $sliderresult['descrip']; ?>" class="medium" />
                    </td>
                </tr>

           
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    <img src="<?php echo $sliderresult['image']; ?>" height="110px" width="160px" /><br/>
                        <input type="file" name="image" />
                    </td>
                </tr>

               

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
    <?php } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
    <script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
<!-- /TinyMCE -->

 <?php include 'inc/footer.php';  ?>

    