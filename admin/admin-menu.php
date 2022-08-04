<?php

require_once  __DIR__ .'/../config/access.php';
require_once  __DIR__ .'/../parts/header.php';

$error_menu_item = $error_menu_link = null;

$m_item = $_POST["menu-item"];
$m_link =  $_POST['menu-link'];
$errors = 0;

if(isset($_POST['send'])){
    if(empty($m_item)){
        $error_menu_item = '<span>'.'The "Menu item" field is required'.'</span>';
        $errors++;
    }
    if(empty($m_link)){
        $error_menu_link = '<span>'.'The "Menu link" field is required'.'</span>';
        $errors++;
    }
    if($errors === 0) {
        $thanks_message = '<span class="form_send_message">'."Thank you for your message".'</span>';

        $sql = "INSERT INTO admin_menu (title, link) VALUES ('$m_item', '$m_link')";
        $conn -> query($sql);

        $m_item = $m_link = "";
    }

}

if (isset($_POST['update'])) {
    $id = $_POST['current'];
    $sql = "UPDATE admin_menu SET title = '$m_item', link = '$m_link' WHERE id = '$id'";
    $conn->query($sql);
}

if (isset($_POST['delete'])) {
    $delete = $_POST['current'];
    if ($conn->query("DELETE FROM admin_menu WHERE id = '$delete'")) {
      //  echo "Deleted";
    };
}

?>

<main class="forms_main">
    <section class="row contact_form_row">
        <div class="wrapper form_wrap">
            <div class="intro_title">
                <h2 class="title">Admin Menu Form</h2>
                <?php echo  $thanks_message ?>
            </div>
            <form action="" method="post" class="admin_form" id="contact">
                <fieldset>
                    <div>
                        <input class="tr3" type="text" name="menu-item" placeholder="Menu item" id="m_item" value="<?php echo $m_item ?: '' ?>" autocomplete="off">
                        <label for="m_item"  class="<?php echo $error_menu_item ? 'has_error' : '' ?>"><?php echo $error_menu_item ?: "" ?></label>
                    </div>
                    <div>
                        <input class="tr3" type="text" name="menu-link" placeholder="Menu link" id="m_link" value="<?php echo $m_link ?: '' ?>" autocomplete="off">
                        <label for="m_item"  class="<?php echo $error_menu_link ? 'has_error' : '' ?>"><?php echo $error_menu_link ?: "" ?></label>
                    </div>
                </fieldset>
                <fieldset>
                    <input type="submit" class="submit" value="Send" name="send">
                </fieldset>
            </form>
            <?php
            $sql_select_menu = "SELECT * FROM admin_menu";
            $result = $conn->query($sql_select_menu);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class='flex justify_center admin_form_wrap'>
                        <div class='flex justify_center left_wrap'>
                          <ul class='primary_menu flex align_center justify_center flex_wrap'>
                              <li><a href='#<?= $row["link"] ?>'><?= $row["title"] ?></a></li>
                          </ul>
                          <form action='' method='post' class='second_form flex align_center'>
                              <input type='hidden' name='current' value='<?= $row['id'] ?>'>
                              <input type='submit' name='delete' class='delete' value='Delete'>
                          </form>
                        </div>
                        <div class="update_form_wrap flex align_center justify_center">
                            <form action='' method='post' class='update_form'>
                                <input type='hidden' name='current' value='<?= $row['id'] ?>'>
                                <label>
                                    <input type="text" name="menu-item" value="<?= $row["title"] ?>">
                                </label>
                                <label>
                                    <input type="text" name="menu-link" value="<?= $row["link"] ?>">
                                </label>
                                <input type='submit' name='update' class='update' value='Update'>
                            </form>
                            <button class="edit">Edit</button>
                        </div>
                    </div>
                <?php }
            } else {
                echo "0 results";
            };
            ?>
        </div>
    </section>
</main>

<?php 
require_once  __DIR__ .'/../parts/footer.php';