<?php include "../dashboard/db.php"; ?>
<?php session_start(); ?>

<link rel="shortcut icon" type="image/png" href="../images/logo.png" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php 

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM `teacher` WHERE username = '$username'";
    $select_user_query = mysqli_query($connection, $query);
    
    if(!$select_user_query)
    {
        die("QUERY FAILED". mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_user_query))
    {
        $db_user_id = $row['teacher_id'];
        $db_username = $row['username'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['firstname'];
		$db_user_lastname = $row['lastname'];
	}
    
    if($username == $db_username && $password == $db_user_password)
    {
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['teacher_id'] = $db_user_id;
        
        header("Location: ../dashboard/mentors/index.php?teacherID=$db_user_id");
    }
    
    if($username == NULL && $password == NULL && $db_user_id=NULL) 
    {
        echo "<div class='alert alert-danger'> <strong>Please!</strong> Check Username Or Password. </div>";
        header("Location: login.php");
    }
    
    else
    {
        echo "<div class='alert alert-danger'> <strong>Please!</strong> Check Username Or Password. </div>";
        //header("Location: login.php");
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

	<title>Mentor Login</title>
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
			<?php if(isset($_SESSION['firstname'])) { ?>
					<span class="login100-form-title p-b-34">
						<h1>Logged In as <?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></h1>
						<a href="../dashboard/mentors/index.php?teacherID=<?php echo $_SESSION['teacher_id']?>">Proceed to Account</a>
						<a href="logout.php">Log Out</a>
					</span>
				<?php } else { ?>
				<form class="login100-form validate-form" action="login.php" method="post">
				    <h1 class="login100-form-title p-b-34" style="font-size: 50px; margin-top:-40%;">Mentor Login</h1>
					<span class="login100-form-title p-b-34">
						Account Login
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100" type="text" name="username" placeholder="User name">
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
						<!-- <span class="txt1">
							Forgot
						</span>

						<a href="#" class="txt2">
							User name / password?
						</a> -->
						<br>
						<a href="../index.php" class="txt2" style="text-decoration: none; text-transform: uppercase; font-size: 18px;">
								Back To HomePage
						</a>
					</div>
				</form>
				<?php } ?>

				<div class="login100-more" style="background-image: url('../images/penrose.png');"></div>
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