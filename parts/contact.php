<?php
include  __DIR__ . "/../config/connect.php";

$error_name = $error_email = $error_message = null;


$name = $_POST["user_name"];
$email = $_POST["user_email"];
$message = $_POST["user_message"];
$errors = 0;

if(isset($_POST['user_name'])){
    if(empty($name)){
        $error_name = 'The "Name" field is required';
        $errors++;
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $error_name = 'Only letters and white space allowed';
      }
    if(empty($email)){
        $error_email = 'The "Email" field is required';
        $errors++;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Invalid email format';
    }
    if(empty($message)){
        $error_message = 'The "Message" field is required';
        $errors++;
    }
    if($errors === 0) {

        echo json_encode([
            "message" => '<span class="form_send_message">'."Thank you for your message".'</span>',
        ]);

        $sql = "INSERT INTO users (name, email, message) VALUES ('$name', '$email', '$message')";
        $conn->query($sql);

        $name = $email = $message = "";
    } else {
        echo json_encode([
            "error_name" => $error_name,
            "error_email" => $error_email,
            "error_message" => $error_message
        ]);
    }

    exit;
}

?>

<p class="response"></p>
<form name="form" method="post" action="" id="contact_form">
    <fieldset>
        <div class="form_field">
            <input name="user_name" type="text" placeholder="Name" id="name" value="<?php echo $name ?: '' ?>" class="tr3" autocomplete="off">
            <label for="name" class="<?php echo $error_name ? 'has_error' : '' ?>">
            <span class="error_name"></span>
            </label>
        </div>
        <div class="form_field">
            <input name="user_email" type="email" placeholder="Email" id="email" value="<?php echo $email ?: '' ?>" class="tr3" autocomplete="off">
            <label for="email"  class="<?php echo $error_email ? 'has_error' : '' ?>">
            <span class="error_email"></span>
            </label>
        </div>
        <div class="form_field">
            <textarea name="user_message" placeholder="message" rows="50" cols="50" id="message" class="tr3"><?php echo $message ?: '' ?></textarea>
            <label for="message"  class="<?php echo $error_message ? 'has_error' : '' ?>">
            <span class="error_message"></span>
            </label>
        </div>
        <div class="form_field">
            <input type="submit" value="Submit" name="submit" class="submit tr3" id="contact_form_button">
        </div>
    </fieldset>
</form>

<?php
      $sql_select_contact = "SELECT name, email, message FROM users";
      $result_contact = $conn -> query( $sql_select_contact);

      if ($result_contact->num_rows > 0) {
        while($row = $result_contact->fetch_assoc()) {
        //   echo
        //    " Name: ". $row["name"]. "<br>"
        //   . " Email: ". $row["email"] . "<br>"
        //   . " Message: ". $row["message"] . "<br>";

          $to_email = 'vardumyan.tehmina@gmail.com';
          $subject = 'Mail from Mina site';
          $user_message = "Name: " . $row["name"] . "\r\n" . "Message: " . $row["message"];
          $headers = "From: " . $row["email"];
        }

        mail($to_email, $subject, $user_message, $headers);

      } else {
         echo "0 results";
      };

?>
