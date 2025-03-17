<?php
  include "connection.php";
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">

		.srch
		{
			padding-left: 850px;

		}
		.form-control
		{
			width: 300px;
			height: 45px;
			background-color: black;
			color: white;
		}
		
		body {
			background-image: url("images/1111.jpg");
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
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
	margin-left: 20px;
}
.h:hover
{
	color:white;
	width: 300px;
	height: 50px;
	background-color: #00544c;
}
.container
{
	height: 600px;
	background-color: black;
	opacity: .8;
	color: white;
}
.Approve
{
  margin-left: 420px;
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
            </div><br><br>

 
  <div class="h"> <a href="Book.php">Books</a></div>
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"> <a href="expired.php">Expired List</a></div>
  <div class="h"> <a href="issue-info.php">Issue Information</a></div>
  <div class="h"> <a href="admin-dashboard.html">Back To Dashboard</a></div>

 
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
    <br><h3 style="text-align: center;">Approve Request</h3><br><br>
    
    <form class="Approve" action="" method="post">
        <input class="form-control" type="text" name="approve" placeholder="Yes or No" required=""><br>

        <input type="text" name="issue" placeholder="Issue Date yyyy-mm-dd" required="" class="form-control"><br>

        <input type="text" name="return" placeholder="Return Date yyyy-mm-dd" required="" class="form-control"><br>
        
        <button class="btn btn-default" type="submit" name="submit" >Approve</button>

    </form>
  
  </div>
</div>

<?php
if (isset($_POST['submit'])) {
    // Make sure session variables are set
    if (isset($_SESSION['name']) && isset($_SESSION['bid'])) {
        $approve = $_POST['approve'];
        $issue = $_POST['issue'];
        $return = $_POST['return'];
        $name = $_SESSION['name'];
        $bid = $_SESSION['bid'];

        // Update approval information
        $updateQuery = "UPDATE `issue_book` SET `approve` = '$approve', `issue` = '$issue', `return` = '$return' WHERE username = '$name' AND bid = '$bid';";
        if (mysqli_query($db, $updateQuery)) {
            // Update book quantity
            mysqli_query($db, "UPDATE books SET quantity = quantity - 1 WHERE bid = '$bid';");

            // Fetch quantity to update book status if necessary
            $res = mysqli_query($db, "SELECT quantity FROM books WHERE bid = '$bid';");
            if ($res) {
                $row = mysqli_fetch_assoc($res);
                if ($row['quantity'] == 0) {
                    mysqli_query($db, "UPDATE books SET status = 'not-available' WHERE bid = '$bid';");
                }
            } else {
                echo "Error fetching quantity: " . mysqli_error($db);
            }

            echo '<script>alert("Updated successfully."); window.location="request.php";</script>';
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    } else {
        echo "Session variables 'name' and 'bid' not set.";
    }
}
?>
</body>
</html>