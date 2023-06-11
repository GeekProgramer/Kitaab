<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $bookName = $_POST["book_name"];
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "userinfo";

  $conn = new mysqli($server, $username, $password, $database);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM book WHERE book_name = ?");
  $stmt->bind_param("s", $bookName);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

      $book_name = $row["book_name"];
      $cond = $row["cond"];
      $owner_name = $row["owner_name"];
      $owner_email = $row["owner_email"];
      $owner_contact= $row["owner_number"];
      $description = $row["dpt"];
    }

  } 
  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="static/TakeUser.css">
</head>

<body>
    <section>
        <div class="card">
            <div class="card-border-top">
            </div>
            <span><?php echo htmlspecialchars($owner_name); ?></span>
            <p class="job">This person has the book you requested</p>
            <p class="info">Book Name: <?php echo htmlspecialchars($book_name); ?></p>
            <p class="info">Book Condition: <?php echo htmlspecialchars($cond); ?></p>
            <p class="info">Contact: <?php echo htmlspecialchars($owner_contact); ?></p>
            <p class="info">Email: <?php echo htmlspecialchars($owner_email); ?></p>
            <button onclick="window.location.href='home.html'">Confirm</button>
        </div>
    </section>
</body>

</html>