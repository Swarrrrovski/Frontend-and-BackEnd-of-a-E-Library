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
	<style type="text/css">
   .form-control {
      width: 300px;
      height: 40px;
      background-color: black;
      color: white;
    }
    
    body {
      
      background-repeat: no-repeat;
      font-family: "Lato", sans-serif;
      transition: background-color .5s;
      background-image:url('Images/im5.png');
      background-size: cover; /* Ensure the image covers the entire body */
     background-position: center center; /* Center the image both horizontally and vertically */
     background-attachment: fixed; /* Keeps the background image fixed while scrolling */
    margin: 0;
    padding: 0;
    }

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

    .container {
      height: 600px;
      background-color: black;
      opacity: .8;
      color: white;
    }

    .scroll {
      width: 100%;
      height: 500px;
      overflow: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    th, td {
      padding: 8px;
      text-align: center;
      border: 1px solid #ddd;
      width: 14.28%; /* Divide equally across the 7 columns */
    }

    th {
      background-color: #6db6b9e6;
      color: white;
    }

    .scroll {
      overflow-y: auto;
      max-height: 400px;
    }
   


		tr:hover {
			background-color: #444;
		}

		.expired {
			color: red;
			font-weight: bold;
		}

		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
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
  <div class="h"> <a href="add.php">Add Books</a></div>
  <div class="h"> <a href="request.php">Book Request</a></div>
  <div class="h"> <a href="student.php">Student Information</a></div>
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
  <div class="container">
    <h3 style="text-align: center;">Information of Borrowed Books</h3><br>
    <?php
    $c=0;

      if(isset($_SESSION['login_user']))
      {
        $sql="SELECT student_register.username,books.bid,name,authors,edition,issue,issue_book.approve,issue_book.return FROM student_register inner join issue_book ON student_register.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='Yes' ORDER BY `issue_book`.`return` ASC";
        $res=mysqli_query($db,$sql);
        
        
        echo "<table class='table table-bordered' style='width:100%;' >";
        //Table header
        
        echo "<tr style='background-color: #6db6b9e6;'>";
        echo "<th>"; echo "Username";  echo "</th>";
        echo "<th>"; echo "BID";  echo "</th>";
        echo "<th>"; echo "Book Name";  echo "</th>";
        echo "<th>"; echo "Authors Name";  echo "</th>";
        echo "<th>"; echo "Edition";  echo "</th>";
        echo "<th>"; echo "Status";  echo "</th>";
        echo "<th>"; echo "Issue Date";  echo "</th>";
        echo "<th>"; echo "Return Date";  echo "</th>";

      echo "</tr>"; 
      echo "</table>";

       echo "<div class='scroll'>";
        echo "<table class='table table-bordered' >";
      while($row=mysqli_fetch_assoc($res))
      {
        $d=date("Y-m-d");
        if($d > $row['return'])
        {
          $c=$c+1;
          $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';

          mysqli_query($db,"UPDATE issue_book SET approve='$var' where `return`='$row[return]' and approve='Yes' limit $c;");
          
          echo $d."</br>";
        }

        echo "<tr>";
          echo "<td>"; echo $row['username']; echo "</td>";
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['name']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['approve']; echo "</td>";
          echo "<td>"; echo $row['issue']; echo "</td>";
          echo "<td>"; echo $row['return']; echo "</td>";
        echo "</tr>";
      }
    echo "</table>";
        echo "</div>";
       
      }
      else
      {
        ?>
          <h3 style="text-align: center;">Login to see information of Borrowed Books</h3>
        <?php
      }
    ?>
  </div>
</div>
</body>
</html>