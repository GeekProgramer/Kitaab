<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "userinfo";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$query = "SELECT book_name, cond FROM book";
$result = $conn->query($query);

$bookData = array();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $bookData[] = array(
            'book_name' => $row['book_name'],
            'cond' => $row['cond']
        );
    }
} else {
    echo "Error retrieving book data: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form</title>>
    <link rel="stylesheet" href="static/Donation.css">
</head>

<body>
    <section>
        <form method="POST" action="ownerInfo.php">



            <label for="Book_Section">Available Books</label>
            <select id=Book_Section name="book_name" required>
                <option value="" disabled selected>Select a book</option>
                <?php foreach ($bookData as $book) { ?>
                <option value="<?php echo htmlspecialchars($book['book_name']); ?>">
                    <?php echo htmlspecialchars($book['book_name'] . ' (' . $book['cond'] . ')'); ?></option>
                <?php } ?>
            </select required><br>

            <button class="ui-btn">
                <span>Request</span>
            </button>
        </form>


    </section>

</body>


</html>