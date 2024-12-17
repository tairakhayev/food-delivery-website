<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <link rel="stylesheet" href="styles/style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
                include_once "utils/session.php";
                include_once "php/conn.php"; 
                if(isset($_POST['submit'])){
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "<script>alert('Invalid email format');</script>";
                    } else if (empty($password)) {
                        echo "<script>alert('Please fill in all fields');</script>";
                    } else {
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($result);
                        if ($num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            if (password_verify($password, $row['password'])) {
                                session_start();
                                $_SESSION['id'] = $row['id'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['surname'] = $row['surname'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['is_admin'] = $row['is_admin'];
                                setcookie("id", $row['id'], time() + (86400 * 30), "/");
                                echo "<script>alert('Login successful'); window.location.href = 'index.php';</script>";
                            } else {
                                echo "<script>alert('Incorrect password');</script>";
                            }
                        } else {
                            echo "<script>alert('Email does not exist');</script>";
                        }
                    }   
                }
            ?>
            <form action="" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="registration.php">Sign Up Now</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>