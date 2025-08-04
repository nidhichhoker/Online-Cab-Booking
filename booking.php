<!DOCTYPE html>
<html>
<head>
  <title>Booking</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      
    }

    h1, h2 {
      text-align: center;
    }

    form {
      max-width: 500px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-top: 10px;
    }

    label {
      display: block;
      margin-bottom: 1px;
    }

    input[type="text"] {
      width: 440px; 
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 15px;
      border-radius: 3px;
      cursor: pointer;
      align: center;
      width:100%;


     
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1px 0;
      border-radius: 10px;
    }
    .center-button {
            display: inline-block;
         
        }
        label, input[type="date"], input[type="time"] {
    display: inline-block;
    vertical-align: top;
    margin-right: 10px; /* Adjust the spacing as needed */
}

.btn
{
  margin-bottom: 15px;
  margin-top: 15px;
}
  </style>
</head>
<body>
  <header>
  <h1>Booking a Cab</h1>
  <h2>Please fill the fields below to book a taxi</h2>
  </header>

  <form method="post" action="">
    <label><strong>Passenger name: </strong></label>
    <br>
    <input type="text" name="passengernamefield" required pattern="[A-Za-z\s]+">
    <br>
    <label><strong>Contact phone of the passenger: </strong>
    <br>
    <input type="text" name="contactphonepassengerfield" required pattern="\d{9}" >
    <br>
    <br>
    <label style="font-size: 22px;"><strong>Pick up address</strong></label>
    <br>
    <br>
    <label><strong>Unit number </strong></label>
    <br>
    <input type="text" name="unitnumberfield" >
    <br>
    <label><strong>Street number:</strong></label>
    <br>
     <input type="text" name="streetnumberfield" required>
     <br>
    <label><strong>Street name:</strong></label>
    <br>
     <input type="text" name="streetnamefield" required>
     <br>
    <label><strong>Suburb:</strong> </label>
    <br>
    <input type="text" name="suburbfield" required> 
    <br>

    <label><strong>Destination suburb: </strong></label>
    <br>
    <input type="text" name="destinationsuburbfield" required>
    <br>

  <br>
     <label  for="dateInput" required ><strong>Pickup date</strong></label>
     <input type="date" id="dateInput" name="pickupdatefield"  placeholder="0000-00-00" required>
     
     <label for="timeInput"><strong>Pickup time:</strong></label>
     <input type="time" id="timeInput" name="pickuptimefield" required >


<div class="btn">
    <input type="submit" name="submit" value="Book" class="center-button">
</div >
  </form>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        var nameInput = document.querySelector('input[name="passengernamefield"]');
        var passwordInput = document.querySelector('input[name="pwdfield"]');
        var confirmPasswordInput = document.querySelector('input[name="confmpwdfield"]');
        var emailInput = document.querySelector('input[name="emailfield"]');
        var phoneInput = document.querySelector('input[name="contactphonepassengerfield"]');

        nameInput.addEventListener("input", function () {
            if (!/^[A-Za-z][A-Za-z\s]*[A-Za-z]$/.test(nameInput.value)) {
                nameInput.setCustomValidity("Enter a valid name with only letters.");
            } else {
                nameInput.setCustomValidity("");
            }
        });

      

       

        phoneInput.addEventListener("input", function () {
            if (!/^\d{9}$/.test(phoneInput.value)) {
                phoneInput.setCustomValidity("Phone number must be 9 digits.");
            } else {
                phoneInput.setCustomValidity("");
            }
        });
    });
</script>
<?php
  if (isset($_POST['submit'])) 
{
  
    $pickupdate = $_POST['pickupdatefield'];
      $pickuptime = $_POST['pickuptimefield'];
      $pickupDateTime = $pickupdate . " " . $pickuptime;

     

      date_default_timezone_set('Australia/Sydney');
      $current_datetime = date("Y-m-d H:i");
      $currentTime = strtotime($current_datetime);
     

      $pickupDateTimeInSec = strtotime($pickupDateTime);
     

      $reqTime = $currentTime + 2400;
   

      if ($pickupDateTimeInSec >= $reqTime) 
      {
        
          $passengername = $_POST['passengernamefield'];
          $contactphonepassenger = $_POST['contactphonepassengerfield'];
          $unitnumber = $_POST['unitnumberfield'];
          $streetnumber = $_POST['streetnumberfield'];
          $streetname = $_POST['streetnamefield'];
          $suburb = $_POST['suburbfield'];
          $destinationsuburb = $_POST['destinationsuburbfield'];
          $pickupdate = $_POST['pickupdatefield'];
          $pickuptime = $_POST['pickuptimefield'];
          $pickupDateTime = $pickupdate . " " . $pickuptime;
          $status = "Unassigned";
          $pickupAddress = $unitnumber . " " . " " . $streetnumber . " " . $streetname . " " . $suburb;

          $prefix = "REF"; // Replace this with your desired prefix
          $numericPart = mt_rand(10000000, 99999999); // Generate an 8-digit number
          $prefixedUniqueNumber = $prefix . $numericPart;
          $bookingReferencenumber = $prefixedUniqueNumber;

          if (isset($_GET['Email'])) 
          {
            $email = $_GET['Email'];
            
          } else 
          
          {
            
            $email = '';
          }

            $conn = mysqli_connect("127.0.0.1", "root", "", "cabsOnline");

            if (!$conn) 
            {
              die("Connection failed: " . mysqli_connect_error());
            }
            $query = "INSERT INTO BookingTable (passengername, phoneNumber, email, pickupAddress, destination, pickupDateTime, bookingReferencenumber, status)
                      VALUES ('$passengername', '$contactphonepassenger', '$email', '$pickupAddress', '$destinationsuburb', '$pickupDateTime', '$bookingReferencenumber', '$status')";
            
            if (mysqli_query($conn, $query)) 
            {
              $to = "$email";
              $subject = "Your booking request with CabsOnline!";
              $message = "Dear $passengername, Thanks for booking with CabsOnline! Your booking reference number is $bookingReferencenumber. We will pick up the passengers in front of your provided address at $pickupDateTime.";
              $headers = "From: booking@cabsonline.com.au";

              $additional_headers = "-r 104341457@student.swin.edu.au";

              if (mail($to, $subject, $message, $headers, "-r 104341457@student.swin.edu.au")) 
              {
                
              
                echo '<script>

                
                        alert("Dear ' . $passengername . ', Thanks for booking with CabsOnline! Your booking reference number is ' . $bookingReferencenumber . '. We will pick up the passengers in front of your provided address at ' . $pickupDateTime . '.");
                        
                        </script>';
                     
                          // header("Location: login.php");
                          // exit;
              } 
              else
               {
                echo '<script>
                        alert("Email failed");
                        </script>';
                       
              }
            } 
              


            else
             {
             // echo "Error: " . mysqli_error($conn);
              echo '<script>
                        alert("Booking can not be made. As booking is already made with this account. Login with different email account");
                        </script>';
            }
            $conn->close();
         

    } 
    else
    {
       echo '<script>
      alert("the pick-up date/time must be at least 40 minutes after the current date/time");
      </script>';
    }



} 
?>


</body>
</html>
