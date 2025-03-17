<?php
include "connection.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fine Calculation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">

#main {
  transition: margin-left .5s;
  padding-left: 100px;
  margin-top: 50px; /* Adjust as needed */
}

        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
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

        th {
            background-color: #6db6b9e6;
            color: white;
        }
        .no-fines {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: green;
        }
    </style>
</head>
<body>
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

 
  <div class="h"><a href="student.php">Student Information</a></div>
  <div class="h"><a href="issue-info.php">Issue Information</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
  <div class="h"><a href="request.php">Fine </a></div>
  <div class="h"><a href="admin-dashboard.html">Back To Dashboard</a></div>
</div>
    <div class="container">
        <h2>Fine Details</h2>

        <?php
        if (isset($_SESSION['login_student']) || isset($_SESSION['login_user'])) {
            $today = date("Y-m-d"); // Get current date

            // If an admin is logged in, show all expired fines
            if (isset($_SESSION['login_user'])) {
                $sql = "SELECT issue_book.username, books.bid, books.name,issue_book.issue, issue_book.return 
                        FROM issue_book 
                        INNER JOIN books ON issue_book.bid = books.bid 
                        WHERE issue_book.approve = '<p style=\"color:yellow; background-color:red;\">EXPIRED</p>'";
            } 
            // If a student is logged in, show only their expired fines
            else {
                $username = $_SESSION['login_student'];
                $sql = "SELECT issue_book.username, books.bid, books.name,issue_book.issue, issue_book.return 
                        FROM issue_book 
                        INNER JOIN books ON issue_book.bid = books.bid 
                        WHERE issue_book.username = '$username' 
                        AND issue_book.approve = '<p style=\"color:yellow; background-color:red;\">EXPIRED</p>'";
            }

            $res = mysqli_query($db, $sql);

            if (mysqli_num_rows($res) > 0) {
                echo "<table>";
                echo "<tr>
                        <th>Username</th>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Fine (₹5 per day overdue)</th>
                        <th>Days</th>
                      </tr>";

                $totalFine = 0;

                while ($row = mysqli_fetch_assoc($res)) {
                    $returnDate = $row['return'];
                    $overdueDays = max(0, (strtotime($today) - strtotime($returnDate)) / (60 * 60 * 24)); // Calculate overdue days
                    $fineAmount = $overdueDays * 5; // Fine calculation

                    $totalFine += $fineAmount;
                    

                    

                         
        $insertFineSQL = "INSERT INTO fine (username, book_id, issue_date, return_date, fine, days_login) 
                          VALUES ('{$row['username']}', '{$row['bid']}', '{$row['issue']}', '{$row['return']}', '{$fineAmount}', '{$overdueDays}')";

        // Execute the query
        mysqli_query($db, $insertFineSQL);

        echo "<tr>
                <td>{$row['username']}</td>
                <td>{$row['bid']}</td>
                <td>{$row['name']}</td>
                <td>{$row['issue']}</td>
                <td>{$row['return']}</td>
                <td>₹{$fineAmount}</td>
                <td>{$overdueDays}</td>
              </tr>";
                
                
                        }        

                echo "</table>";

                if ($totalFine == 0) {
                    echo "<p class='no-fines'>No overdue books. No fine applicable.</p>";
                }
            } else {
                echo "<p class='no-fines'>No expired fines found.</p>";
            }
        } else {
            echo "<p class='no-fines'>Please login to view fine details.</p>";
        }
        ?>
        <br><br> <div class="h">
    <button onclick="window.location.href='admin-dashboard.php'" style="padding: 10px 20px; background-color: #6db6b9e6; color: white; border: none; border-radius: 5px; cursor: pointer;">
        Back To Dashboard
    </button>
    </div>
</body>
</html>
