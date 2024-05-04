<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <div class="container">
        <h1>Register</h1>
        <?php
if(isset($_POST["submit"])){
    $fullname = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rePassword = $_POST["repeat_password"];

    $errors = array();

    if(empty($fullname) || empty($email) || empty($password) || empty($rePassword)){
        array_push($errors,"<p class='alert'>All fields required</p>");
    }
    if(strlen($password) < 8){
        array_push($errors,"<p>Minimum length 8</p>");
    }
    if($password !== $rePassword){
        array_push($errors,"<div class='alert'>Passwords do not match</div>"); 
    }
    if(count($errors) > 0){
        foreach($errors as $error){
            echo "<div class='alert'>$error</div>";
        }
    }else{
        $passwordHash = md5($password);
        
        $servername = "localhost";
        $username = "root"; 
        $password = "root"; 
        $dbname = "logintest"; 
        
        
        $conn = new mysqli($servername, $username, $password, $dbname);
         
        $sql = "SELECT * FROM users WHERE email = '$email'";
        
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0){
            array_push( $errors,"Email alredy exists");
        }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$passwordHash')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert'>New record created successfully</div>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
?>

        <form action="register.php" method="POST"> 
            <div style="font-size: 40px; color:red;" class="form-group">
                <input placeholder="Name" type="text" name="name"> 
            </div>

            <div class="form-group">
                <input placeholder="Email" type="email" name="email"> 
            </div>

            <div class="form-group">
                <input placeholder="Password" type="password" name="password"> 
            </div>

            <div class="form-group">
                <input placeholder="Repeat your Password" type="password" name="repeat_password"> 
            </div>
            <button type="submit" name="submit">Submit</button> 
        </form>
    </div>
</body>
</html>
