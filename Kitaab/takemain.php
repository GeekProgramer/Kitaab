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
    <title>TAKE</title>
    <link rel="stylesheet" href="static/takemain.css">
</head>

<body>
    <div class="banner">
        <form method="POST" action="ownerInfo.php">
            <div class="header">
                <h1>Available Books</h1>
                <button class="request-button">Request</button>
            </div>
            <div class="content">
                <h2> There is no friend as loyal as a book </h2>
                <label for="Book_Section"></label>
                <select id=Book_Section name="book_name" required>
                    <option value="" disabled selected>Select a book</option>
                    <?php foreach ($bookData as $book) { ?>
                    <option value="<?php echo htmlspecialchars($book['book_name']); ?>">
                        <?php echo htmlspecialchars($book['book_name'] . ' (' . $book['cond'] . ')'); ?></option>
                    <?php } ?>

                </select required><br>

                <div class="book-container">
                    <div class="book-card fiction">
                        <img src="static/fic-3.webp" alt="">

                    </div>
                    <div class="book-card fiction">
                        <img src="static/fic-4.webp" alt="">

                    </div>

                    <div class="book-card mystery">
                        <img src="static/myst-1.png" alt="">

                    </div>
                    <div class="book-card mystery">
                        <img src="static/myst-2.jpg" alt="">

                    </div>

                    <div class="book-card science-fiction">
                        <img src="static/sci-4.webp" alt="">

                    </div>

                    <div class="book-card romance">
                        <img src="static/rom-1.webp" alt="">

                    </div>
                    <div class="book-card romance">
                        <img src="static/rom-2.webp" alt="">

                    </div>
                </div>
            </div>
            <script>
            function filterBooks(genre) {
                const bookCards = document.querySelectorAll('.book-card');

                bookCards.forEach(card => {
                    card.style.display = 'none';

                    if (genre === 'all' || card.classList.contains(genre)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                const genreButtons = document.querySelectorAll('.genre-filter button');
                genreButtons.forEach(button => {
                    if (button.textContent.toLowerCase() === genre) {
                        button.classList.add('active');
                    } else {
                        button.classList.remove('active');
                    }
                });
            }
            </script>
    </div>
    </form>
    </div>
</body>

</html>
