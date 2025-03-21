<?php
  include "connection.php";  
  session_start();  
?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="Book.js"></script>
    <link rel="shortcut icon" href="book.png" type="image/x-icon">
</head>
<body>
<style type="text/css">
    
    body {
    font-family: 'Lato', sans-serif;
    background-color: #f4f4f9;
    background-image: url('Images/im2.png'); /* Background image URL */
    background-size: cover; /* Ensure the image covers the entire body */
    background-position: center center; /* Center the image both horizontally and vertically */
    background-attachment: fixed; /* Keeps the background image fixed while scrolling */
    margin: 0;
    padding: 0;
    transition: background-color .5s;
}



h2 {
    text-align: center;
    color: #333;
    font-size: 32px;
    margin-top: 30px;
}

/* Sidenav Styles */
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

/* Main Content Area */
#main {
    transition: margin-left .5s;
    padding: 20px;
    margin-left: 0;
}

/* Search Section */
.srch {
    display: flex;
    justify-content: center;
    margin-top: 20px;
    gap: 40px;  /* Added gap to make buttons appear closer */
}

.srch form {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 600px;
    width: 100%;
}

.form-control {
    width: 80%;
    height: 40px;
    padding: 0 10px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-right: 10px;
}

.srch button {
    width: 80px; /* Increased width */
    height: 60px; /* Increased height for better proportion */
    background-color: #6db6b9e6; /* Soft teal background */
    border: none;
    border-radius: 8px; /* Rounded corners for a softer look */
    cursor: pointer;
    font-size: 16px; /* Ensures text size is readable */
    font-weight: bold; /* Bold text for emphasis */
    color: white; /* White text */
    transition: background-color 0.3s, transform 0.2s; /* Added transition for smooth scaling effect */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
}
.srch button:hover {
    background-color: #4a9c9c;
}

/* Delete Button Style */
.srch .btn-default {
    width: 70px;  /* Ensuring consistency with search button size */
    height: 50px;  /* Same height as search button */
    background-color: #6db6b9e6;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.srch .btn-default:hover {
    background-color: #4a9c9c;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
}

table th {
    background-color: #6db6b9;
    color: white;
    font-weight: bold;
}

table td {
    background-color: #222;
    color: white;
}

table tr:nth-child(even) td {
    background-color: #333;
}

table tr:hover {
    background-color: #4a5c5c;
}
/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    background-color: rgba(0, 0, 0, 0.6); /* Added transparency (0.6 is 60% opaque) */
    color: white;
}

table th {
    background-color: rgba(109, 182, 185, 0.7); /* Lightly transparent header */
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) td {
    background-color: rgba(51, 51, 51, 0.6); /* Even row with transparency */
}

table tr:hover {
    background-color: rgba(74, 92, 92, 0.7); /* Hover effect with transparency */
}

/* Table Column Widths */
table th, table td {
    width: auto;
    word-wrap: break-word;
}

/* Hover Effect on Sidenav Links */
.h:hover {
    color: white;
    width: 300px;
    height: 50px;
    background-color: #00544c;
    border-radius: 5px;
}

/* Image Styling */
.img-circle {
    margin-left: 20px;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .sidenav a {
        font-size: 18px;
        padding: 8px 15px;
    }

    .srch form {
        flex-direction: column;
        justify-content: center;
    }

    .form-control {
        width: 100%;
        margin-bottom: 10px;
    }

    .srch button {
        width: 80px;
        height: 80px;
    }

    table th, table td {
        padding: 12px;
    }
}

</style>
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
        </div>
        <br><br>

        <div class="h"><a href="add.php">Add Books</a></div> 
        <div class="h"><a href="issue-info.php">Issue Information</a></div>
        <div class="h"><a href="expired.php">Expired List</a></div>
        <div class="h"><a href="admin-dashboard.php">Back To Dashboard</a></div>

    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

        <div class="srch">
            <!-- Search form for books -->
            <form class="navbar-form" method="post" name="form1">
			    <input class="form-control" type="text" name="search" placeholder="Search books..." required>
                <button style="width: 50px; height: 50px; background-color: #6db6b9e6; background-image: url('search.png'); background-size: cover; background-repeat: no-repeat; background-position: center;" type="submit" name="submit" class="btn btn-default"></button>
            </form>

            <!-- Delete form for books -->
            <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="bid" placeholder="Enter Book ID" required>
                <button style="background-color: #6db6b9e6;" type="submit" name="submit1" class="btn btn-default">Delete</button>
            </form>
        </div>

        <h2>List Of Books</h2>

        <?php
            // Handle book deletion before displaying books
            if (isset($_POST['submit1'])) {
                if (isset($_SESSION['login_user'])) {
                    $bid = mysqli_real_escape_string($db, $_POST['bid']);
                    $check = mysqli_query($db, "SELECT * FROM books WHERE bid = '$bid'");
                    
                    if (mysqli_num_rows($check) > 0) {
                        mysqli_query($db, "DELETE FROM books WHERE bid = '$bid'");
                        echo "<script type='text/javascript'>alert('Delete Successful.');</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('Book ID not found.');</script>";
                    }
                } else {
                    echo "<script type='text/javascript'>alert('Please Login First.');</script>";
                }
            }

            // If the search form is submitted
            if (isset($_POST['submit'])) {
                // Ensure safe input handling with prepared statements
                $search = mysqli_real_escape_string($db, $_POST['search']);
                
                // Build the SQL query to search by name, authors, bid, or department
                $q = mysqli_query($db, "SELECT * FROM books WHERE name LIKE '%$search%' OR authors LIKE '%$search%' OR bid LIKE '%$search%' OR department LIKE '%$search%'");
            
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
            }
            else {
                // Display all books if no search is made
                $res = mysqli_query($db, "SELECT * FROM books ORDER BY name ASC");

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