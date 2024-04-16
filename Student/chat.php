<?php
// Database connection details (replace with yours)
session_start();
include("../Database/registerDB.php");

if (isset($_GET['id'])) {
  $id= htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
  $query = "SELECT username FROM students WHERE id = ?";
  $stmt = mysqli_prepare($connect, $query);
  mysqli_stmt_bind_param($stmt, 's', $id);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $user = mysqli_fetch_assoc($result);
  $_SESSION['chatuser'] = $user['username']; 
}
// Handle message submission (if form is submitted)
if (isset($_POST["message"])) {
  include("../Database/registerDB.php");
  $sender_id = $_SESSION["username"]; // Replace with logic to get actual sender ID
  // $receiver_id = isset($_POST["receiver_id"]) ? $_POST["receiver_id"] : null;
  $receiver_id = $_SESSION['chatuser'] ;
  $message = htmlspecialchars($_POST["message"]); // Sanitize input

  // Validate message and insert into database
  $sql = "INSERT INTO messages (sender_id, receiver_id, message, timestamp)
          VALUES ('$sender_id', '$receiver_id', '$message', NOW())";
  if (mysqli_query($connect, $sql)) {
    echo "Message sent successfully!";
  } else {
    echo "Error sending message: " . mysqli_error($connect);
  }
}
// Function to retrieve messages
function getMessages($sender_id, $receiver_id) {
  include("../Database/registerDB.php");
  $sql = "SELECT * FROM messages";
  if ($sender_id !== null && $receiver_id !== null) {
    $sql .= " WHERE (sender_id = '$sender_id' AND receiver_id = '$receiver_id') OR 
    (sender_id = '$receiver_id' AND receiver_id = '$sender_id')";
  }
  $sql .= " ORDER BY timestamp ASC";
  $result = mysqli_query($connect, $sql);
  $messages = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
  }
  return $messages;
}
// Retrieve messages (modify filter parameters if needed)
$messages = getMessages($_SESSION["username"], $_SESSION['chatuser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Chat Application</title>
  <style>
    /* Basic styling for chat window */
  </style>
</head>
<body>

  <h1>Chat</h1>
  <button><a href="../home.php">Home</a></button>	
  <button onclick="history.back()">Back</button>
  <div id="chat-window">
    <?php foreach ($messages as $message): ?>
      <p>
        <b>User <?php echo $message['sender_id']; ?></b>: <?php echo $message['message']; ?>
        (<?php echo $message['timestamp']; ?>)
      </p>
    <?php endforeach; ?>
  </div>

  <form action="chat.php" method="post">
    
    <textarea name="message" required></textarea><br>
    <button type="submit">Send</button>
  </form>

</body>
</html>

<?php
mysqli_close($connect);
?>
