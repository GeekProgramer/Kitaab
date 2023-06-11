<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "userinfo";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bookName = "";
$bookCondition = "";
$desc="";
$successMessage = "";
$ownerName = "";
$ownerEmail = "";
$ownerContact = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $bookName = $_POST["book_name"];
    $bookCondition = $_POST["book_condition"];
    $desc =  $_POST["desc"];
    $ownerName = $_POST["owner_name"];
    $ownerEmail = $_POST["owner_email"];
    $ownerContact = $_POST["owner_contact"];

    $stmt = $conn->prepare("INSERT INTO book (book_name, cond, dpt, owner_name, owner_email, owner_number) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $bookName, $bookCondition, $desc, $ownerName, $ownerEmail, $ownerContact);

   
    if ($stmt->execute()) {
        $bookName = "";
        $bookCondition = "";
        $successMessage = "Book added successfully!";
        header("Location: thankyoupage.html");
    
    } else {
        echo "Error inserting book: " . $stmt->error;
    }

   
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>>
    <link rel="stylesheet" href="static/donate.css">
</head>

<body>
    <section>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="Owner_Name">Owner's Name</label>
            <input type="text" id="Owner_Name" placeholder="Your name" name="owner_name"
                value="<?php echo $ownerName; ?>" required><br>

            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Owner@gmail.com" name="owner_email"
                value="<?php echo $ownerEmail; ?>" required><br>

            <label for="phone">Phone No.</label>
            <input type="number" id="phone" placeholder="012-345-6789" name="owner_contact"
                value="<?php echo $ownerContact; ?>" required><br>

            <label for="Name">Book Name</label>
            <input type="text" id="Name" placeholder="Book Name" name="book_name" value="<?php echo $bookName; ?>"
                required><br>

            <div><label for="Book_Section" id="box1">Book Condition</label>
                <select id=Book_Section name="book_condition" required>
                    <option value="Mint" <?php if ($bookCondition === "Mint") { echo "selected"; } ?>>Mint</option>
                    <option value="Paper back" <?php if ($bookCondition === "Paper back") { echo "selected"; } ?>>Paper
                        back</option>
                    <option value="Hard cover" <?php if ($bookCondition === "Hard cover") { echo "selected"; } ?>>Hard
                        cover</option>
                    <option value="Page Stone" <?php if ($bookCondition === "Page Stone") { echo "selected"; } ?>>Page
                        Stone</option>
                    <option value="Torn" <?php if ($bookCondition === "Torn") { echo "selected"; } ?>>Torn</option>
                </select required><br>
            </div>

            <label for="checkbox" id="box2">Anything you like to share</label>
            <input type="checkbox" id="checkbox" onchange="showComment(this)">
            <textarea id="comment" rows="3" cols="50" name="desc" value="<?php echo $desc; ?>"></textarea><br>

            <label for="checkbox" id="box3">I agree to share my contact info</label>
            <input type="checkbox" id="checkbox" required>


            <button class="ui-btn">
                <span><a>Submit</a></span>
            </button>
        </form>


    </section>

</body>


</html>