<?php
  include "connection.php";
  session_start();
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Information</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body {
    font-family: "Lato", sans-serif;
    background-color: #f4f4f4;
    transition: background-color .5s;
    margin: 0;
    padding: 0;
}

.container {
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.srch {
    display: flex;
    justify-content: flex-end;
    padding: 20px;
}

.srch input {
    width: 250px;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.srch button {
    background-color: #6db6b9e6;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-image: url('search.png');
    background-size: cover;
    background-position: center;
    cursor: pointer;
}

.srch button:hover {
    background-color: #5a9a9a;
}

h2 {
    font-size: 24px;
    color: #333;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
}

/* Sidebar styles */
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


/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #6db6b9e6;
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Media queries for responsiveness */
@media screen and (max-width: 768px) {
    .sidenav a {
        font-size: 18px;
        padding: 12px 20px;
    }

    .srch input {
        width: 200px;
    }

    h2 {
        font-size: 20px;
    }
}

@media screen and (max-width: 450px) {
    .sidenav a {
        font-size: 16px;
        padding: 10px 15px;
    }

    .srch input {
        width: 160px;
    }

    h2 {
        font-size: 18px;
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
                if(isset($_SESSION['login_user']))
                	
                { 
                  
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user']; 
                }
                
                ?>
            </div>
<br><br>
  <div class="h"><a href="request.php">Book Request</a></div>
  <div class="h"><a href="issue-info.php">Issue Information</a></div>
  <div class="h"><a href="fine.php">Fine</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
  <div class="h"><a href="admin-dashboard.php">Back To Dashboard</a></div>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>

	<!--__________________________search bar________________________-->
<div class="container">
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="Student username.." required="">
				<button style="width: 30px; height: 30px; background-color: #6db6b9e6; background-image: url('search.png'); background-size: cover; background-repeat: no-repeat; background-position: center;" type="submit" name="submit" class="btn btn-default"></button>
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>

	<h2>List Of Students</h2>
	<?php

		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT fname,mname,lname,username,email FROM `student_register` where username like '%$_POST[search]%' ");

			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No student found with that username. Try searching again.";
			}
			else
			{
		echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "First Name";	echo "</th>";
				echo "<th>"; echo "Middle Name";  echo "</th>";
				echo "<th>"; echo "Last Name";  echo "</th>";
				echo "<th>"; echo "Username";  echo "</th>";
				echo "<th>"; echo "Email";  echo "</th>";
				
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($q))
			{
				echo "<tr>";
				echo "<td>"; echo $row['fname']; echo "</td>";
				echo "<td>"; echo $row['mname']; echo "</td>";
				echo "<td>"; echo $row['lname']; echo "</td>";
				echo "<td>"; echo $row['username']; echo "</td>";
				echo "<td>"; echo $row['email']; echo "</td>";
			

				echo "</tr>";
			}
		echo "</table>";
			}
		}
			/*if button is not pressed.*/
		else
		{
			$res=mysqli_query($db,"SELECT fname,mname,lname,username,email FROM `student_register`;");

		echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "First Name";	echo "</th>";
				echo "<th>"; echo "Middle Name";	echo "</th>";
				echo "<th>"; echo "Last Name";  echo "</th>";
				echo "<th>"; echo "Username";  echo "</th>";
				echo "<th>"; echo "Email";  echo "</th>";
		
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				
				echo "<td>"; echo $row['fname']; echo "</td>";
                echo "<td>"; echo $row['mname']; echo "</td>";
				echo "<td>"; echo $row['lname']; echo "</td>";
				echo "<td>"; echo $row['username']; echo "</td>";
			    echo "<td>"; echo $row['email']; echo "</td>";
				

				echo "</tr>";
			}
		echo "</table>";
		}

	?>
</div>
</body>
</html>