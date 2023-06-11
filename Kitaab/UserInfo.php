<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = $_POST["full_name"];
    $contactNumber = $_POST["contact_number"];
    $email= $_POST["email"];

    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "userinfo";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE user SET full_name = ?, contact = ? WHERE email = ?");
    $stmt->bind_param("sss", $fullName, $contactNumber, $email);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
        header("Location: home.html");
    } else {
        echo "Error inserting data: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="static/Userinfo.css">
</head>

<body>
    <section>
        <div class="form">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="subtitle">Let's create your account!</div>
                <div class="input-container ic1">
                    <input id="firstname" class="input" type="text" placeholder="" name="full_name" required>
                    <div class="cut"></div>
                    <label for="firstname" class="placeholder">Full Name</label>
                </div>
                <div class="input-container ic2">
                    <input id="lastname" class="input" type="number" placeholder="" name="contact_number" required>
                    <div class="cut"></div>
                    <label for="lastname" class="placeholder">Contact</label>
                </div>
                <div class="input-container ic2">
                    <input id="email" class="input" type="email" placeholder="" name="email" required>
                    <div class="cut cut-short"></div>
                    <label for="email" class="placeholder">Email
                    </label>
                </div>

                <button type="text" class="submit">SUBMIT</button>
            </form>
        </div>
    </section>
</body>

</html>