<?php
session_start();  
  include "connection.php";
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		
		/* General Body Style */
		body {
			background-color: rgb(115, 137, 184); /* Beige background */
			font-family: "Lato", sans-serif;
			transition: background-color .5s;
			color: #333; /* Darker text for better readability on beige */
		}

		/* Sidebar Styles */
		.sidenav {
			height: 100%;
			margin-top: 50px;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #333;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
			box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.3);
		}

		.sidenav a {
			padding: 10px 20px;
			text-decoration: none;
			font-size: 20px;
			color: #b0b0b0;
			display: block;
			transition: 0.3s;
			border-bottom: 1px solid #444;
		}

		.sidenav a:hover {
			color: white;
			background-color: #5d8f8f;
			font-weight: bold;
		}

		.sidenav .closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 36px;
			color: white;
			margin-left: 50px;
		}

		#main {
			transition: margin-left .5s;
			padding: 16px;
		}

		/* Responsive Design for Sidebar */
		@media screen and (max-height: 450px) {
			.sidenav { padding-top: 15px; }
			.sidenav a { font-size: 18px; }
		}

		/* Hover effect for menu items */
		.h:hover {
			color: white;
			width: 300px;
			height: 50px;
			background-color: #555;
		}

		/* Center the main content */
		.container {
			text-align: center;
			padding: 20px;
		}

		/* Styling the Form and Inputs */
		.book {
			width: 400px;
			margin: 0px auto;
			background-color: #fff; /* White background for form */
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 4px 8px rgba(8, 9, 9, 0.01);
		}

		.form-control {
			background-color: #ddd; /* Light beige background for inputs */
			color: #333; /* Darker text for readability */
			height: 40px;
			border: 1px solid #bca877; /* Subtle beige border */
			border-radius: 5px;
			padding: 5px;
			margin-bottom: 10px;
			width: 100%;
		}

		.form-control::placeholder {
			color: #666; /* Placeholder text color */
		}

		/* Button Styles */
		.btn {
			background-color: #bca877; /* Beige background for button */
			color: #fff; /* White text */
			border: none;
			padding: 10px 20px;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			transition: background-color 0.3s ease;
			width: 100%;
		}

		.btn:hover {
			background-color: #8d745c; /* Darker beige on hover */
		}

		/* Responsive Styling for Form */
		@media screen and (max-width: 768px) {
			.book {
				width: 90%; /* Responsive width */
			}
		}
	

	</style>


</head>
<body>
	<!--_________________sidenav_______________-->
	
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  			<div style="color: white; margin-left: 60px; font-size: 20px;">

                <?php
                if (isset($_SESSION['login_user'])) {
                  
                  echo "<br><br>";
                  echo "Welcome ".$_SESSION['login_user']; 
              } else {
                  echo "Please log in.";
                  exit();
              }
                ?>
            </div><br><br>


  <div class="h"> <a href="Book.php"> Books</a></div>
  <div class="h"> <a href="issue-info.php">Issue Information</a></div>
  <div class="h"> <a href="expired.php">Expired List</a></div>
  <div class="h"> <a href="admin-dashboard.php">Back To DashBoard</a></div>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
  <div class="container" style="text-align: center;">
    <h2 style="color:black; font-family: Lucida Console; text-align: center"><b>ADD NEW BOOKS</b></h2>
    <br><br>
    <form class="book" action="" method="post">
        
        <input type="text" name="bid" class="form-control" placeholder="Book id" required=""><br><br>
        <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br><br>
        <input type="text" name="authors" class="form-control" placeholder="Authors Name" required=""><br><br>
        <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br><br>
        <input type="text" name="status" class="form-control" placeholder="Status" required=""><br><br>
        <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br><br>
        <input type="text" name="department" class="form-control" placeholder="Department" required=""><br><br>

        <button style="text-align: center;" class="btn btn-default" type="submit" name="submit">ADD</button>
    </form>
  </div>
<?php
    if(isset($_POST['submit']))
    {
      if(isset($_SESSION['login_user']))
      {
        mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bid]', '$_POST[name]', '$_POST[authors]', '$_POST[edition]', '$_POST[status]', '$_POST[quantity]', '$_POST[department]') ;");
        ?>
          <script type="text/javascript">
            alert("Book Added Successfully.");
          </script>

        <?php
         

      }
      else
      {
        ?>
          <script type="text/javascript">
            alert("You need to login first.");
          </script>
        <?php
      }
    }
?>
</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#024629";
}
</script>

</body>