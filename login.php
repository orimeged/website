<?php 

    include 'connect.php'; 
	
    session_start();
   	
	if (isset($_POST['uname']) && isset($_POST['psw']))
	{
		$uname = mysqli_real_escape_string($conn , $_POST['uname']); 
        $psw = mysqli_real_escape_string($conn , md5($_POST['psw'])); 
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username= '$uname' AND password = '$psw' ");
	    if (mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_assoc($result);
			$_SESSION['username'] = $row['username'];
			 header ("Location: welcome.php")	;	
		}
		else
		{
			echo "<script>alert('User does not exist . ')</script>";
		}
	
	}
	
?>


<form action="login.php" method="post">
  <div class="imgcontainer">


  <div class="container">
        <label>User Name</label>

        <input type="text" name="uname"  placeholder="User Name"><br>

        <label>Password</label>

        <input type="password" name="psw"  placeholder="Password" ><br> 

    <button type="submit">Login</button>
	
		<p class="center"><br />
		You want to  <a href="register.php">sign up</a>

  </div>
</form>



