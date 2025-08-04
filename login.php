<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  


 
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 30px 0;
      border-radius: 10px;
    }

    h1 {
      margin: 0;
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

    
    main {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 250px; 
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
      align: center;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    h3 {
      text-align: center;
    }

    
  </style>
</head>
<body>
  <header>
    <h1>Login to CabsOnline</h1>
  </header>

  <main>
    <div class="form-group">
      <form method="post" action="">
        <label>Email:   </label>
        <input type="text" name="emailfield">
        <br>
        <label>Password: </label>
        <input type="password" name="pwdfield">
        <br>
        <h3>New Member? <a href="register.php">Register now</a></h3>
        <br>

        <input type="submit" name="submit" value="Log In">
      </form>
    </div>
  </main>

  

  <?php
  if (isset($_POST['submit']))
   {
    $email = $_POST['emailfield'];
    $password = $_POST['pwdfield'];

    

    $conn = mysqli_connect("127.0.0.1", "root", "", "cabsOnline");
    
    if (!$conn)
     {
      die("Connection failed: " . mysqli_connect_error());
  }
  $query = "SELECT password FROM Customer WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($hashedPassword);
  $stmt->fetch();
  $stmt->close();
 
  // Verify password
  if (($password==$hashedPassword)) 
  {
      echo "Login successful!";
      // session_start();
      // $_SESSION['email'] = $email;
      header("Location: booking.php?Email=" . urlencode($email));
        exit;
      
     
  } else {
    echo '<script>alert("Incorrect login password!");</script>';
  }

  $conn->close();
}



?>

  
  
</body>
</html>
