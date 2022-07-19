
<?php 
    // include our connect script 
   include 'connect.php'; 
   error_reporting(0);
    
    // check to see if there is a user already logged in, if so redirect them 
    session_start(); 
    if (isset($_SESSION['username']) && isset($_SESSION['userid'])) 
        header("Location: ./index.php");  // redirect the user to the home page
	
	if (isset($_POST['registerBtn']))
	{ 
	    $username = mysqli_real_escape_string($conn  ,$_POST['username']); 
	    $email = mysqli_real_escape_string($conn , $_POST['email']); 
	    $passwd = md5($_POST['passwd']); 
	    $passwd_again = md5($_POST['confirm_password']); 
    }
    
	// make sure the two passwords match
	if ($passwd === $passwd_again)
	{
		// make sure the password meets the min strength requirements
		if ( strlen($passwd) >= 4   && strpbrk($email, "@.") != false )
		{
			$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' OR username = '$username'");
			if (mysqli_num_rows($result) > 0)
			{
				echo "<script>alert('The user already exists .')</script>";
			}
			else
			{
				var_dump($username);

				$sql = "INSERT INTO users (username , email , password)
						VALUES ('$username' , '$email' , '$passwd' )";
				$result = mysqli_query($conn , $sql);
				if ($result)
				{
                     //header ("Location: login.php")	;				 
				}
				else
					 echo "<script>alert('Sorry, please do again')</script>"; 
				 
			}

			$username = '';
			$email = '';
			$_POST['passwd'] = '';
			$_POST['confirm_password']= '';
		}

		

	}
	else
	    echo "<script>alert('Your passwords did not match.')</script>"; 

	


?>

<form action="./register.php" class="form" method="POST">
	
	<h1>create a new account</h1>


	<div class="">
		<input type="text" name="username" value="<?php echo $username ?>" placeholder="enter a username" autocomplete="off" required />
	</div>
	<div class="">
		<input type="text" name="email" value="<?php echo $email ?>" placeholder="provide an email" autocomplete="off" required />
	</div>
	<div class="">
		<input type="password" name="passwd" value="<?php echo $_POST['passwd'] ?>" placeholder="enter a password" autocomplete="off" required />
	</div>
	<div class="">
		<p>password must be at least 5 characters and<br /> have a special character, e.g. !#$.,:;()</font></p>
	</div>					
	<div class="">
		<input type="password" name="confirm_password" value="<?php echo $_POST['confirm_password'] ?>" placeholder="confirm your password" autocomplete="off" required />
	</div>
	
	<div class="">
		<input class="" type="submit" name="registerBtn" value="create account" />
	</div>

	<p class="center"><br />
		Already have an account? <a href="login.php">Login here</a>

	</p>
</form>

