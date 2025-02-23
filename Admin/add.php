<?php
  include "connection.php";
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">
		body {
    background-color: rgb(245, 245, 220); /* Beige background */
    font-family: "Lato", sans-serif;
    transition: background-color .5s;
    color: #333; /* Darker color for better contrast on beige */
  }

  .srch {
    padding-left: 1000px;
  }

  .sidenav {
    height: 100%;
    margin-top: 50px;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #3e3e3e; /* Darker side nav */
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #d3c6aa; /* Lighter beige color for links */
    display: block;
    transition: 0.3s;
  }

  .sidenav a:hover {
    color: #fff; /* White hover effect for links */
  }

  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
    color: #d3c6aa; /* Lighter beige for the close button */
  }

  #main {
    transition: margin-left .5s;
    padding: 16px;
  }

  @media screen and (max-height: 450px) {
    .sidenav { padding-top: 15px; }
    .sidenav a { font-size: 18px; }
  }

  .img-circle {
    margin-left: 20px;
    border-radius: 50%; /* Ensures the image remains circular */
  }

  .h:hover {
    color: white;
    width: 300px;
    height: 50px;
    background-color: #555; /* Dark hover for menu items */
  }

  .book {
    width: 400px;
    margin: 0px auto;
  }

  .form-control {
    background-color: #ddd; /* Light beige form background */
    color: #333; /* Darker text color for visibility */
    height: 40px;
    border: 1px solid #bca877; /* Subtle beige border for form fields */
    border-radius: 5px;
    padding: 5px;
  }

  .form-control::placeholder {
    color: #666; /* Placeholder color */
  }

  .btn {
    background-color: #bca877; /* Beige button background */
    color: #fff; /* White text on buttons */
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }

  .btn:hover {
    background-color: #8d745c; /* Darker beige on hover */
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

                { 	echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user']; 
                }
                ?>
            </div><br><br>

 <div class="h"> <a href="add.php">Add Books</a> </div> 
  <div class="h"> <a href="delete.php">Delete Books</a></div>
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"> <a href="issue-info.php">Issue Information</a></div>
</div>

<div id="main">
  <span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
  <div class="container" style="text-align: center;">
    <h2 style="color:black; font-family: Lucida Console; text-align: center"><b>Add New Books</b></h2>
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