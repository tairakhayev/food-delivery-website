<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Registration</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php include_once "php/conn.php"; 
                include_once "utils/session.php";
                
                if(isset($_POST['submit'])){
                    $name = $_POST['name'];
                    $surname = $_POST['surname'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $is_admin = 0;

                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<script>alert('Invalid email format');</script>";
                    } else if (empty($name) || empty($surname) || empty($password)) {
                        echo "<script>alert('Please fill in all fields');</script>";
                    } else if (strlen($password) < 8) {
                        echo "<script>alert('Password should be at least 8 characters long');</script>";
                    } else {
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($result);
                        if ($num_rows > 0) {
                            echo "<script>alert('Email already exists');</script>";
                        } else {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO users (name, surname, email, password, is_admin) VALUES ('$name', '$surname', '$email', '$password', '$is_admin')";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                echo "<script>alert('Registration successful'); window.location.href = 'index.php';</script>";
                            } else {
                                echo "<script>alert('Registration failed');</script>";
                            }
                        }
                    }   
                }
                ?>
            
            <form method="POST">
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>