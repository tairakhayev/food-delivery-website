
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= stylesheet href="styles/account.css">
    <title>Account Page</title>
    
</head>
<body>
        <?php include_once "utils/session.php"; 
            if (!isset($_SESSION['id'])) {
                header("Location: index.php");
            }
            include_once "php/conn.php";
            // get current user's info
            $user_id = $_SESSION['id'];
            $sql = "SELECT * FROM users WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $surname = $row['surname'];
            $email = $row['email'];
            $password = $row['password'];
            $is_admin = $row['is_admin'];

            // update user's info with logic
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $surname = $_POST['surname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
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
                        $row = mysqli_fetch_assoc($result);
                        if ($row['id'] != $user_id) {
                            echo "<script>alert('Email already exists');</script>";
                        } else {
                            if ($password != $row['password']) {
                                $password = password_hash($password, PASSWORD_DEFAULT);
                            }
                            $sql = "UPDATE users SET name = '$name', surname = '$surname', email = '$email', password = '$password' WHERE id = '$user_id'";
                            $result = mysqli_query($conn, $sql);
                            if ($result) {
                                echo "<script>alert('Changes saved'); window.location.href = 'index.php';</script>";
                            } else {
                                echo "<script>alert('Changes failed');</script>";
                            }
                        }
                    } else {
                        if ($password != $row['password']) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                        }
                        $sql = "UPDATE users SET name = '$name', surname = '$surname', email = '$email', password = '$password' WHERE id = '$user_id'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "<script>alert('Changes saved'); window.location.href = 'index.php';</script>";
                        } else {
                            echo "<script>alert('Changes failed');</script>";
                        }
                    }
                }   
            }
        ?>
        <div class="container-account">
        <div class="box form-box-account">
            <header> 
                <?php echo "<h3>Welcome, $name!</h3>"; ?>
            </header>
            <text>
                <p>Here you can change your personal information</p>
            </text>
            <form action="" method="post">
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" value="<?php echo $name; ?>">
                </div>

                <div class="field input">
                    <label for="surname">Surname</label>
                    <input type="text" name="surname" id="surname" autocomplete="off" value="<?php echo $surname; ?>">
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" value="<?php echo $email; ?>">
                </div>
                
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" value="password">
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Save Changes" required>
                </div>

                <a href="index.php" class="btn">Return to home page</a>
            </form>
        </div>
    </div>
</body>
</html>
