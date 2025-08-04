<!DOCTYPE html>
<html>
<head>
  <title>Admin Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      background-color: #ffffff;
    }

     h2 {
      text-align: left;
    }

    form {
      text-align: center;
    }

    label {
      display: block;
      margin-right: 600px;
    }

    input[type="text"], input[type="password"] {
      width: 20%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"] {
      background-color: #333;
      color: #ffffff;
      border: none;
      padding: 10px 15px;
      border-radius: 3px;
      cursor: pointer;
      margin-right: 10px;
      width:30%;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      
    }

    table, th, td {
      border: 5px solid #ccc;
      border: 3px solid #333;
      
    }

    th {
      padding: 10px;
      text-align: left;
      
    }
    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1px 0;
      border-radius: 10px;
    }
  </style>
</head>
<body>
  <header>
  <h1>Admin page of CabsOnline</h1>
  
  </header>
  <br>
  <h2>1. Click below button to search for all Unassigned boking requests with a pick-up time within 3 hours.</h2>
  <br>
   <br>

     <form method="get" action="" >  
     <input type="submit" name="submit2" value="List All">
     <br>
     </form>

     <?php
  // Database credentials
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "cabsOnline";

  // Create a database connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Check if the "List All" button is clicked
  if (isset($_GET['submit2'])) {
    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM BookingTable WHERE status = 'Unassigned' AND TIMESTAMPDIFF(SECOND, NOW(), pickupDateTime) <= 3*3600";

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      echo '<br>';
      echo '<table border="1">';
      echo '<tr>
              <th>Reference</th>
              <th>Customer Name</th>
              <th>Passenger Name</th>
              <th>Passenger contact number</th>
              <th>Pick-up address</th>
              <th>Destination Suburb</th>
              <th>Pick-time</th>
            </tr>';

      while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['bookingReferencenumber'] . '</td>';
        echo '<td>' . $row['customerName'] . '</td>';
        echo '<td>' . $row['passengername'] . '</td>';
        echo '<td>' . $row['phoneNumber'] . '</td>';
        echo '<td>' . $row['pickupAddress'] . '</td>';
        echo '<td>' . $row['destination'] . '</td>';
        echo '<td>' . $row['pickupDateTime'] . '</td>';
        echo '</tr>';
      }

      echo '</table>';
    } else {
      
      echo '<script>
              alert("No unassigned bookings found within 3 hours.");
              </script>';

              
    }

    $stmt->close();
  }
  ?>
   <br>
   <br>
<h2>2. Input a reference number below and click "update" button to assign a taxi to that request.</h2>

<form method="get" action="">
        
        <label>Reference Number <input type="text" name="referencenumber" > </label>

    
        <input type="submit" name="submit" value="Update">
    </form>

    <?php

if (isset($_GET['submit'])) {
  // Get the reference number from the form
  $bookingReferenceNumber = $_GET['referencenumber'];

  // Validate input (you might want to add more validation)
  if (!empty($bookingReferenceNumber)) {
      // Use prepared statement to prevent SQL injection
      $query1 = "UPDATE BookingTable SET status = 'assigned' WHERE bookingReferencenumber = ?";

      $stmt = $conn->prepare($query1);
      $stmt->bind_param("s", $bookingReferenceNumber);

      if ($stmt->execute()) {
          echo '<script>
              alert("The booking request ' . $bookingReferenceNumber . ' has been properly assigned.");
              </script>';
      } else {
          // The query encountered an error
          echo "Error updating record: " . $stmt->error;
      }

      // Close the statement
      $stmt->close();
  } else {
    echo '<script>
              alert("Reference Number is empty!");
              </script>';
      
  }
}

// Close the database connection when you're done
$conn->close();
?>

</body>
</html>