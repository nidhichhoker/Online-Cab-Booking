<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h1 {
      color: #fff;
    }

    form {
      max-width: 600px;
      margin: 0 auto;
      background-color: #ffffff;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-top: 10px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    
    input[type="submit"] {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width:100%;
      display: inline-block;
      
     
    }
    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px 0;
      border-radius: 10px;
    }

    input[type="submit"]:hover {
      background-color: #555;
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
    <h1>Register to CabsOnline</h1>
    <h2>Please fill out the fields below to complete your registration</h2>
  </header>

  <form method="post" action="">
  <label>Name: <input type="text" name="namefield" autocomplete="off" required pattern="[A-Za-z\s]+"> </label>

    <label>Password: <input type="password" name="pwdfield" autocomplete="off" required ></label>
    <label>Confirm password: <input type="password" name="confmpwdfield" autocomplete="off" required></label>
    <label>Email: <input type="email" name="emailfield" autocomplete="off" required ></label>
    <label>Phone: <input type="text" name="phonefield" autocomplete="off" required pattern="\d{9}"></label>
    <div class="btn">
    <input type="submit" name="submit" value="Register" >
  </div>
  </form>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var nameInput = document.querySelector('input[name="namefield"]');
        var passwordInput = document.querySelector('input[name="pwdfield"]');
        var confirmPasswordInput = document.querySelector('input[name="confmpwdfield"]');
        var emailInput = document.querySelector('input[name="emailfield"]');
        var phoneInput = document.querySelector('input[name="phonefield"]');

        nameInput.addEventListener("input", function () {
            if (!/^[A-Za-z][A-Za-z\s]*[A-Za-z]$/.test(nameInput.value)) {
                nameInput.setCustomValidity("Enter a valid name with only letters.");
            } else {
                nameInput.setCustomValidity("");
            }
        });

      

        confirmPasswordInput.addEventListener("input", function () {
            if (confirmPasswordInput.value !== passwordInput.value) {
                confirmPasswordInput.setCustomValidity("Passwords do not match.");
            } else {
                confirmPasswordInput.setCustomValidity("");
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

    $username = $_POST['namefield'];
    $password = $_POST['pwdfield'];
    $email = $_POST['emailfield'];
    $phone = $_POST['phonefield'];
    $confirmpassword= $_POST['confmpwdfield'];

 
    

if ($confirmpassword !=  $password )
{
 echo '<script>alert("Password and Confirm Password do not match!");</script>';
}

else
{



 $conn = mysqli_connect("127.0.0.1", "root", "", "cabsOnline");
   
 if (!$conn)
  {
   die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO Customer (username, email, password, phoneNumber) VALUES ('$username', '$email' ,'$password','$phone')";

if (mysqli_query($conn, $sql)) {
 
 header("Location: login.php");
 
} else 
{
  echo '<script>alert("Account is already created with ' . $email . '. Please try with another email");</script>';



}
mysqli_close($conn);
}


 



  }


?>
</body>
</html>
