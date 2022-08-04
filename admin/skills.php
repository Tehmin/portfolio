<?php

require_once  __DIR__ .'/../config/access.php';
require_once  __DIR__ .'/../parts/header.php';

$error_skill = $error_percent = null;

$skill = $_POST["skill"];
$percent = $_POST['percent'];

if (isset($_POST['send'])) {
    $errors = 0;
    if (empty($skill)) {
        $error_skill = '<span>' . 'The "Skill" field is required' . '</span>';
        $errors++;
    }
    if (empty($percent)) {
        $error_percent = '<span>' . 'The "Percent" field is required' . '</span>';
        $errors++;
    }
    if ($errors === 0) {
        $thanks_message = '<span class="form_send_message">' . "Thank you for your message" . '</span>';

        $sql = "INSERT INTO skills (skill, percent) VALUES ('$skill', '$percent')";
        $conn->query($sql);

        $skill = $percent = "";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['current'];
    $sql = "UPDATE skills SET skill = '$skill', percent = '$percent' WHERE id = '$id'";
    $conn->query($sql);
}

if (isset($_POST['delete'])) {
    $delete = $_POST['current'];
    if ($conn->query("DELETE FROM skills WHERE id = '$delete'")) {
      //  echo "Deleted";
    };
}
?>

    <main class="forms_main">
        <section class="row contact_form_row">
            <div class="wrapper form_wrap">
                <div class="intro_title">
                    <h2 class="title">Skills Form</h2>
                    <?php echo $thanks_message ?>
                </div>
                <form action="" method="post" class="admin_form" id="contact">
                    <fieldset>
                        <div>
                            <input class="tr3" type="text" name="skill" placeholder="Skill" id="skill"
                                   value="<?php echo $skill ?: '' ?>" autocomplete="off">
                            <label for="skill"
                                   class="<?php echo $error_skill ? 'has_error' : '' ?>"><?php echo $error_skill ?: "" ?></label>
                        </div>
                        <div>
                            <input class="tr3" type="number" name="percent" placeholder="Percent" id="percent"
                                   value="<?php echo $percent ?: '' ?>" autocomplete="off">
                            <label for="percent"
                                   class="<?php echo $error_percent ? 'has_error' : '' ?>"><?php echo $error_percent ?: "" ?></label>
                        </div>
                    </fieldset>
                    <fieldset>
                        <input type="submit" class="submit" value="Send" name="send">
                    </fieldset>
                </form>
                <?php
                $sql_select_skills = "SELECT * FROM skills";
                $result = $conn->query($sql_select_skills);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class='flex justify_center admin_form_wrap'>
                            <div class='flex justify_center left_wrap'>
                              <ul class='skill_bars flex align_center justify_center flex_wrap'>
                                  <li>
                                      <div class='progress percent<?= $row["percent"] ?>'>
                                          <span><?= $row["percent"] ?> %</span>
                                      </div>
                                      <strong><?= $row["skill"] ?></strong>
                                  </li>
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
                                        <input type="text" name="percent" value="<?= $row["percent"] ?>">
                                    </label>
                                    <label>
                                        <input type="text" name="skill" value="<?= $row["skill"] ?>">
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
