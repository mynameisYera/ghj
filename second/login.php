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
        <?php 
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            require_once("db.php");
            
            // SQL query to fetch user by email
            $sql = "SELECT * FROM users WHERE email = '$email'";
            echo "SQL Query: $sql<br>"; // Output SQL query for debugging
            
            // Execute the SQL query
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error: " . mysqli_error($conn)); // Output any MySQL errors and stop execution
            }
            
            // Fetch the user data
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            print_r($user); // Output fetched user data for debugging
            
            // Check if user exists and password is correct
            if ($user) {
                // Verify the password
                if (password_verify($password, $user["password"])) {
                    // Redirect to index.php if password is correct
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert'>Password is not correct</div>";
                }
            } else {
                echo "<div class='alert'>Email is not correct</div>";
            }
        }
        ?>
        <form action="login.php" method="POST"> 
            <div class="form-group">
                <input placeholder="Email" type="email" name="email"> 
            </div>

            <div class="form-group">
                <input placeholder="Password" type="password" name="password"> 
            </div>
            <div class="btn">
                <button type="submit" name="login">Login</button> 
            </div>
        </form>
    </div>
</body>
</html>
