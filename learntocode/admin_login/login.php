<?php include "../dashboard/db.php"; ?>
<?php session_start(); ?>

<?php 


if(isset($_POST['login']))
{
    $username = $_POST['admin_username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);
    
	$query = "SELECT * FROM admin WHERE admin_username = '{$username}' AND password = '{$password}'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query)
    {
        die("QUERY FAILED". mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_user_query))
    {
        $db_user_id = $row['adminID'];
        $db_username = $row['admin_username'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['firstname'];
		$db_user_lastname = $row['lastname'];
	}
    
    if($username == $db_username && $password == $db_user_password)
    {
        $_SESSION['admin_username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
        
		header("Location: ../dashboard/main_index.php");
    }
    
    else
    {
		header("Location: login.php");
		echo 
		"<div class='alert alert-danger' role='alert'> 
			Please check your username and password. 
		</div>";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/penrose_logo.jpg"/>
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../style/Login_v17/css/main.css">
	<link rel="stylesheet" type="text/css" href="../style/Login_v17/css/util.css">

	<title>Admin Login</title>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<?php if(isset($db_username)) { ?>
					<span class="login100-form-title p-b-34">
						<h1>Logged In as <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></h1>
						<a href="../dashboard">Proceed to Account</a>
						<a href="logout.php">Log Out</a>
					</span>
				<?php } else { ?>

				<form class="login100-form validate-form" action="login.php" method="post">
				    <h1 class="login100-form-title p-b-34" style="font-size: 50px; margin-top:-40%;">Admin Login</h1>
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="admin_username" placeholder="User name">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login" type="submit">Login</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">
						<span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a>
						<br>
						<a href="../index.php" class="txt2" style="text-decoration: none; text-transform: uppercase; font-size: 18px;">
								Back To HomePage
						</a>
					</div>
				</form>
				<?php } ?>
				<div class="login100-more" style="background-image: url('../images/penrose_logo_transparent.png');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../vendor/animsition/js/animsition.min.js"></script>
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>

	<script src="../vendor/daterangepicker/moment.min.js"></script>
	<script src="../vendor/daterangepicker/daterangepicker.js"></script>
	<script src="../vendor/countdowntime/countdowntime.js"></script>
	<script src="../js/main.js"></script>

</body>
</html>