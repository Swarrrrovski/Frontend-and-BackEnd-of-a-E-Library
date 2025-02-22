<?php
  include "connection.php";
  session_start();  // Ensure session is started to use session variables
?>

<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="Book.css">
    <script src="Book.js"></script>
    
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
	<!--_________________sidenav_______________-->
	
	<div id="mySidenav" class="sidenav">
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

		<div style="color: white; margin-left: 60px; font-size: 20px;">
			<?php
				if(isset($_SESSION['login_user'])) {
					echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
					echo "<br><br>";
					echo "Welcome ".$_SESSION['login_user']; 
				}
			?>
		</div>
		<br><br>

		<div class="h"><a href="add.php">Add Books</a></div> 
  		<div class="h"><a href="request.php">Book Request</a></div>
  		<div class="h"><a href="issue_info.php">Issue Information</a></div>
  		<div class="h"><a href="expired.php">Expired List</a></div>
	</div>

	<div id="main">
		<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

		<div class="srch">
			<form class="navbar-form" method="post" name="form1">
				<input class="form-control" type="text" name="search" placeholder="Search books..." required>
				<button style="background-color: #6db6b9e6;" type="submit" name="submit" class="btn btn-default">
					<span class="glyphicon glyphicon-search"></span>
				</button>
			</form>

			<form class="navbar-form" method="post" name="form1">
				<input class="form-control" type="text" name="bid" placeholder="Enter Book ID" required>
				<button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Delete</button>
			</form>
		</div>

		<h2>List Of Books</h2>

		<?php
			// If the search form is submitted
			if (isset($_POST['submit'])) {
				$q = mysqli_query($db, "SELECT * FROM books WHERE name LIKE '%$_POST[search]%'");
				
				if (mysqli_num_rows($q) == 0) {
					echo "Sorry! No book found. Try searching again.";
				} else {
					echo "<table class='table table-bordered table-hover'>";
					echo "<tr style='background-color: #6db6b9e6;'>";
					echo "<th>ID</th>";
					echo "<th>Book-Name</th>";
					echo "<th>Authors Name</th>";
					echo "<th>Edition</th>";
					echo "<th>Status</th>";
					echo "<th>Quantity</th>";
					echo "<th>Department</th>";
					echo "</tr>";

					while ($row = mysqli_fetch_assoc($q)) {
						echo "<tr>";
						echo "<td>".$row['bid']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['authors']."</td>";
						echo "<td>".$row['edition']."</td>";
						echo "<td>".$row['status']."</td>";
						echo "<td>".$row['quantity']."</td>";
						echo "<td>".$row['department']."</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
			} else {
				// Display all books if no search is made
				$res = mysqli_query($db, "SELECT * FROM `books` ORDER BY `books`.`name` ASC");

				echo "<table class='table table-bordered table-hover'>";
				echo "<tr style='background-color: #6db6b9e6;'>";
				echo "<th>ID</th>";
				echo "<th>Book-Name</th>";
				echo "<th>Authors Name</th>";
				echo "<th>Edition</th>";
				echo "<th>Status</th>";
				echo "<th>Quantity</th>";
				echo "<th>Department</th>";
				echo "</tr>";

				while ($row = mysqli_fetch_assoc($res)) {
					echo "<tr>";
					echo "<td>".$row['bid']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td>".$row['authors']."</td>";
					echo "<td>".$row['edition']."</td>";
					echo "<td>".$row['status']."</td>";
					echo "<td>".$row['quantity']."</td>";
					echo "<td>".$row['department']."</td>";
					echo "</tr>";
				}
				echo "</table>";
			}

			// Handle book deletion
			if (isset($_POST['submit1'])) {
				if (isset($_SESSION['login_user'])) {
					mysqli_query($db, "DELETE FROM books WHERE bid = '$_POST[bid]'");
					echo "<script type='text/javascript'>alert('Delete Successful.');</script>";
				} else {
					echo "<script type='text/javascript'>alert('Please Login First.');</script>";
				}
			}
		?>
	</div>

	<!-- JavaScript for Sidenav -->
	<script>
		function openNav() {
			document.getElementById("mySidenav").style.width = "250px";
			document.getElementById("main").style.marginLeft = "250px";
		}

		function closeNav() {
			document.getElementById("mySidenav").style.width = "0";
			document.getElementById("main").style.marginLeft = "0";
		}
	</script>
</body>
</html>
