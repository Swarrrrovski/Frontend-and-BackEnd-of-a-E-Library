<?php
  session_start();
  include "connection.php";
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
            margin: 0;
            padding: 0;
            display: flex; /* Flexbox layout */
            min-height: 100vh; /* Ensures the sidebar takes up full height */
        }

        .sidenav {
            width: 250px; /* Sidebar width */
            position: fixed; /* Keeps the sidebar in place */
            top: 0;
            left: 0;
            background-color: #111; /* Sidebar background color */
            height: 100%; /* Full height */
            overflow-x: hidden; /* Disable horizontal scrolling */
            transition: 0.5s;
            padding-top: 20px;
            z-index: 1;
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
            margin-left: 250px; /* Matches the sidebar width */
            padding: 16px;
            flex-grow: 1; /* Allows the main container to take the remaining width */
            transition: margin-left 0.5s;
        }

        .srch {
            padding-right: 50px;
            text-align: right;
        }

        .img-circle {
            margin-left: 20px;
        }

        .h:hover {
            color: white;
            width: 300px;
            height: 50px;
            background-color: #00544c;
        }

        /* Table Styling */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: #333;
        }

        table th {
            background-color: #6db6b9e6;
            color: white;
            font-size: 18px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td {
            font-size: 16px;
            color: #333;
        }

        /* Responsive View */
        @media screen and (max-width: 768px) {
            table th, table td {
                font-size: 14px;
            }
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
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
                if(isset($_SESSION['login_student']))

                { 	
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_student']; 
                }
                ?>
            </div><br><br>

 
  <div class="h"><a href="Books.php">Books</a></div>
  <div class="h"><a href="issue_info.php">Issue Information</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
  <div class="h"><a href="user-dashboard.php">Back To Dashboard</a></div>

  
</div>
<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
<div class="container">


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
	<br><br>
<?php
	
        if(isset($_SESSION['login_student'])) {
		$query = "SELECT * FROM issue_book WHERE username='$_SESSION[login_student]' ";
		$result = mysqli_query($db, $query);
	
		if(mysqli_num_rows($result) == 0) {
			echo "There's no pending request";
		} else {
			echo "<table class='table table-bordered table-hover'>";
			echo "<tr style='background-color: #6db6b9e6;'>
					<th>Book-ID</th>
					<th>Approve Status</th>
					<th>Issue Date</th>
					<th>Return Date</th>
				  </tr>";
	
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>
						<td>{$row['bid']}</td>
						<td>{$row['approve']}</td>
						<td>{$row['issue']}</td>
						<td>{$row['return']}</td>
					  </tr>";
			}
			echo "</table>";
		}
	}
	
	else
		{
			echo "</br></br></br>"; 
			echo "<h2><b>";
			echo " Please login first to see the request information.";
			echo "</b></h2>";
		}
		?>
	</div>
</div>
</body>
</html>