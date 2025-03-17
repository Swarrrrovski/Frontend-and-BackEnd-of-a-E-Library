<?php
  include "connection.php";
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">

		.srch
		{
			padding-left: 70%;
		}
		.form-control
		{
			width: 300px;
			height: 40px;
			background-color: black;
			color: white;
		}
		
		body {
			background-image: url("images/aa.jpg");
			background-repeat: no-repeat;
  			font-family: "Lato", sans-serif;
  			transition: background-color .5s;
		}

		.sidenav {
			height: 100%;
			margin-top: 50px;
			width: 0;
			position: fixed;
			z-index: 1;
			top: 0;
			left: 0;
			background-color: #222;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
		}

		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
			display: block;
			transition: 0.3s;
		}

		.sidenav a:hover {
			color: white;
		}

		.sidenav .closebtn {
			position: absolute;
			top: 0;
			right: 25px;
			font-size: 36px;
			margin-left: 50px;
		}

		#main {
			transition: margin-left .5s;
			padding-left: 50px;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
		}

		.img-circle {
			margin-left: 20px;
		}
		.h:hover {
			color:white;
			width: 300px;
			height: 50px;
			background-color: #00544c;
		}
		.container {
			height: 1000px;
			background-color: black;
			opacity: .8;
			color: white;
			width: 90%;
			margin-top: 10px;
		}
		.scroll {
			width: 100%;
			height: 1000px;
			overflow: auto;
		}
		th, td {
			width: 10%;
		}
	</style>

</head>

<body>
<!--_________________sidenav_______________-->
	
	<div id="mySidenav" class="sidenav">
  		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  		<div style="color: white; margin-left: 60px; font-size: 20px;">
    		<?php
    			if(isset($_SESSION['login_user'])) {
    				echo "</br></br>";
    				echo "Welcome ".$_SESSION['login_user']; 
    			}
    		?>
    	</div><br><br>

  		<div class="h"><a href="Book.php">Books</a></div>
		  <div class="h"><a href="add.php">Add Books</a></div> 
  		<div class="h"><a href="request.php">Book Request</a></div>
  		<div class="h"><a href="student.php">Student Information</a></div>
  		<div class="h"><a href="issue-info.php">Issue Information</a></div>
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

  		<div class="container">
  			<?php
  				if(isset($_SESSION['login_user'])) { 
  			?>
  				<div style="float: left; padding: 25px;">
  					<form method="post" action="">
  						<button name="submit2" type="submit" class="btn btn-default" style="background-color: #06861a; color: yellow;">RETURNED</button> 
  						&nbsp;&nbsp;
  						<button name="submit3" type="submit" class="btn btn-default" style="background-color: red; color: yellow;">EXPIRED</button>
  					</form>
  				</div>
  				<div class="srch">
  					<form method="post" action="" name="form1">
  						<input type="text" name="username" class="form-control" placeholder="Username" required="">
  						<input type="text" name="bid" class="form-control" placeholder="Book ID" required="">
  						<button class="btn btn-default" name="submit" type="submit">Submit</button>
  					</form>
  				</div>
  				<?php
  					if (isset($_POST['submit'])) {
                        $var1 = '<p style="color:yellow; background-color:green;">RETURNED</p>';
                        $username = mysqli_real_escape_string($db, $_POST['username']);
                        $bid = mysqli_real_escape_string($db, $_POST['bid']);
                        
                        // First, update the `issue_book` table to mark the book as returned
                        mysqli_query($db, "UPDATE issue_book SET approve='$var1' WHERE username='$username' AND bid='$bid'");
                        
                        // Then, check the current status and quantity of the book in the `books` table
                        $query = "SELECT quantity, status FROM books WHERE bid='$bid'";
                        $result = mysqli_query($db, $query);
                        $book = mysqli_fetch_assoc($result);
                        
                        if ($book) {
                            $quantity = $book['quantity'];
                            $status = $book['status'];
                    
                            // If the status is 'unavailable' and quantity is 0, set the status to 'available' and increment quantity by 1
                            if ($status == 'unavailable' && $quantity == 0) {
                                mysqli_query($db, "UPDATE books SET status='available', quantity=quantity + 1 WHERE bid='$bid'");
                            } else {
                                // If the status is not 'unavailable', simply increment the quantity by 1
                                mysqli_query($db, "UPDATE books SET quantity=quantity + 1 WHERE bid='$bid'");
                            }
                        }
                    }
                    
  				?>
  			<?php
  				}
  			?><br>

  			<?php
  				if(isset($_SESSION['login_user'])) {   
  					$ret = '<p style="color:yellow; background-color:green;">RETURNED</p>';
  					$exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
  					if(isset($_POST['submit2'])) {
  						$sql = "SELECT student_register.username, books.bid, name, authors, approve, edition, issue, issue_book.return 
  								FROM student_register 
  								INNER JOIN issue_book ON student_register.username = issue_book.username 
  								INNER JOIN books ON issue_book.bid = books.bid 
  								WHERE issue_book.approve = '$ret' 
  								ORDER BY issue_book.return DESC";
  					} else if(isset($_POST['submit3'])) {
  						$sql = "SELECT student_register.username, books.bid, name, authors, approve, edition, issue, issue_book.return 
  								FROM student_register 
  								INNER JOIN issue_book ON student_register.username = issue_book.username 
  								INNER JOIN books ON issue_book.bid = books.bid 
  								WHERE issue_book.approve = '$exp' 
  								ORDER BY issue_book.return DESC";
  					} else {
  						$sql = "SELECT student_register.username, books.bid, name, authors, approve, edition, issue, issue_book.return 
  								FROM student_register 
  								INNER JOIN issue_book ON student_register.username = issue_book.username 
  								INNER JOIN books ON issue_book.bid = books.bid 
  								WHERE issue_book.approve != '' AND issue_book.approve != 'Yes' 
  								ORDER BY issue_book.return DESC";
  					}

  					$res = mysqli_query($db, $sql);

  					echo "<table class='table table-bordered' style='width:100%;'>";
  					// Table header
  					echo "<tr style='background-color: #6db6b9e6;'>";
  					echo "<th>Username</th>";
  					echo "<th>BID</th>";
  					echo "<th>Book Name</th>";
  					echo "<th>Authors Name</th>";
  					echo "<th>Status</th>"; 
  					echo "<th>Edition</th>";
  					echo "<th>Issue Date</th>";
  					echo "<th>Return Date</th>";
  					echo "</tr>";
  					echo "</table>";

  					echo "<div class='scroll'>";
  					echo "<table class='table table-bordered'>";
  					while($row = mysqli_fetch_assoc($res)) {
  						echo "<tr>";
  						echo "<td>{$row['username']}</td>";
  						echo "<td>{$row['bid']}</td>";
  						echo "<td>{$row['name']}</td>";
  						echo "<td>{$row['authors']}</td>";
  						echo "<td>{$row['approve']}</td>";
  						echo "<td>{$row['edition']}</td>";
  						echo "<td>{$row['issue']}</td>";
  						echo "<td>{$row['return']}</td>";
  						echo "</tr>";
  					}
  					echo "</table>";
  					echo "</div>";
  				} else {
  					echo "<h3 style='text-align:center;'>Login to see information of borrowed books.</h3>";
  				}
  			?>
  		</div>
	</div>
</body>
</html>