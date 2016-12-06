<?php include 'inc/header.php'; ?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$fname = $fm->validation($_POST['firstname']);
		$lname = $fm->validation($_POST['lastname']);
		$email = $fm->validation($_POST['email']);
		$body  = $fm->validation($_POST['body']);

		$fname = mysqli_real_escape_string($db->link, $fname);
		$lname = mysqli_real_escape_string($db->link, $lname);
		$email = mysqli_real_escape_string($db->link, $email);
		$body  = mysqli_real_escape_string($db->link, $body);

		$error = "";

		/*  every form show this error in up
		$errorf = "";
		$errorl = "";
		$errore = "";
		$errorb = "";
		
		if(empty($fname)){
			$errorf = "First name must no be empty !";
		}
		if(empty($lname)){ 
			$errorl = "Last name must not be empty !";
		}
		if(empty($email)){
			$errore = "Email Field must not be empty !";
		}
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errore = "Invalid Email Address !";
		}
		if(empty($body)){
			$errorb = "Message field must not be empty !";
		}*/

		
		if(empty($fname)){
			$error = "First name must not be empty !";
		}
		elseif(!filter_var($lname,FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
			$error = "Last name must not be empty !";
		}
		elseif(empty($email)){
			$error = "Email field must not be empty !";
		}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Invalid Email Address !";
		}
		elseif(empty($body)){
			$error = "Message field must not be empty !";
		}
		else{
			$query = "insert into tbl_contact(firstname, lastname, email, body) values('$fname', '$lname', '$email', '$body') ";
			$inserted_row = $db->insert($query);
			if($inserted_row){
				$msg = "Message Sent Successful.";
			}
			else{
				$error = "Message Not Sent !";
			}
		}

	}

?>
<style>
	.cuserror{
		color: red;
		float: left;
	}
</style>>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
			<?php 
				if(isset($error)){
					echo "<span style='color:red'>$error</span>";
				}
				if(isset($msg)){
					echo "<span style='color:green'>$msg</span>";
				}
			?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<?php
						/*if(isset($errorf)){
							echo "<span class='cuserror'>$errorf</span>";
						}*/
					?>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<?php
						/*if(isset($errorl)){
							echo "<span class='cuserror'>$errorl</span>";
						}*/
					?>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<?php
						/*if(isset($errore)){
							echo "<span class='cuserror'>$errore</span>";
						}*/
					?>

					<input type="text" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<?php
						/*if(isset($errorb)){
							echo "<span class='cuserror'>$errorb</span>";
						}*/
					?>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

	</div>
		
<?php
	include "inc/sidebar.php";
	include "inc/footer.php";
	
?>
