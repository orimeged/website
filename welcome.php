
<?php 

    include 'connect.php'; 
    session_start();
	
	
    $result = mysqli_query($conn, "SELECT * FROM posts");
	echo "<table>";
	echo "<tr><td><h3>name: </h3></td>  <td><h2></h2></td>  <td><h3>data: </h3></td></tr>";


	while ($row_users = mysqli_fetch_array($result)) {
		//output a row here
		$data_new = $row_users['data'];
		$name_new = $row_users['name'];
		echo "<tr><td>". (htmlentities($name_new)) ."</td>  <td>   </td>   <td> " . (htmlentities($data_new)) . "</td></tr>";
	}

	echo "</table>";
   
	if (isset($_POST['data']))
	{
		
		var_dump($_SESSION['username']);
		$name = $_SESSION['username']; 

		$data = mysqli_real_escape_string($conn , $_POST['data']);

		
		$sql = "INSERT INTO posts (name , data )
				VALUES ('$name' , '$data' )";
		$result = mysqli_query($conn , $sql);
		if ($result)
		{
			 header("Location: welcome.php");				 
		}
		else
			 echo "<script>alert('Sorry, please do again')</script>"; 

	}
	


	
?>


<form action="welcome.php" method="post">
  <div class="posts">


  <div class="cont">
        <label>Your post</label>

        <input type="text" name="data"  placeholder="your post"><br>



    <button type="submit" >Send</button>


  </div>
</form>