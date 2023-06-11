<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "userinfo";
$error = "";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password === $row["password"]) {
         
            header("Location: home.html");
            exit();
        } else {
            $error = "Incorrect password";
        }
    }else{

        
        $stmt = $conn->prepare("INSERT INTO user (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);

    
        if ($stmt->execute()) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }
        header("Location: UserInfo.php");
        $error = "";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="static/index.css">
    <title>KITAAB</title>

    <script>
    function clearForm() {
        document.getElementById("myform").reset();
    }
    window.onload = clearForm;
    </script>
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form id="myform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h2>Sign In</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" id="password" name="password" required>
                        <label for="">Password</label>
                        <span class="error"><?php echo $error; ?></span>
                    </div>
                    <!-- <div class="forget">
                        <label for=""><input type="checkbox">Remember Me </label>
                        <label> <a href="#">Forget Password</a></label>
                    </div> -->
                    <button type="submit">Sign In</button>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>