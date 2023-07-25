<?php
if (isset($_POST['name']) && isset($_POST['email_address']) && isset($_POST['subject']) && isset($_POST['phone']) && isset($_POST['message'])) {
    $name = $_POST['name'];
    $email = $_POST['email_address'];
    $subject = $_POST['subject'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    if (!empty($name) && !empty($email) && !empty($subject) && !empty($phone) && !empty($message)) {
        $conn = new mysqli('localhost', 'root', '', 'comarke');
        if ($conn->connect_error) {
            die('Connection Failed : ' . $conn->connect_error);
        } else {
            $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, phone, message) VALUES (?,?,?,?,?)");
            $stmt->bind_param("sssis", $name, $email, $subject, $phone, $message);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            // Redirect to the necessary page after a delay
            echo "<div style='display: flex; flex-direction: column; align-items: center; justify-content: center; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(255, 255, 255, 0.5);'>
        <div style='padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; max-width: 400px; margin: 0 auto;'>
          <img src='./assets/images/icon/success.png' alt='Thank You Icon' width='100' height='100'>
          <p>Thank you for contacting us. You will be redirected to the contact page shortly.</p>
        </div>
      </div>";

    
    echo '<script>
            setTimeout(function() {
                window.location.href = "contact.php"; // Replace "contact.php" with the actual contact page URL
            }, 5000); // Redirect after 5 seconds (5000 milliseconds)
          </script>';
}
    } else {
        echo "Please fill in all the required fields.";
    }
} else {
    echo "Please submit the form with all the required fields.";
}
?>
