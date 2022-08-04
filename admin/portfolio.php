<?php

 require_once __DIR__ .'/../config/access.php';
 require_once __DIR__ .'/../parts/header.php';

 $error_image = $error_type = $error_title = $error_url = null;

$image = $_POST["image"];
$type =  $_POST['type'];
$title =  $_POST['title'];
$url =  $_POST['url'];

$filename = $_FILES["image"]["name"];
$tempname = $_FILES["image"]["tmp_name"];

if(isset($_POST['send'])){
    $errors = 0;
    if(empty($filename)){
        $error_image = '<span>'.'The "Image" field is required'.'</span>';
        $errors++;
    }
    if(empty($type)){
        $error_type = '<span>'.'The "Type" field is required'.'</span>';
        $errors++;
    }
    if(empty($title)){
        $error_title = '<span>'.'The "Title" field is required'.'</span>';
        $errors++;
    }
    if(empty($url)){
        $error_url = '<span>'.'The "Href" field is required'.'</span>';
        $errors++;
    }
    if($errors === 0) {
        $thanks_message = '<span class="form_send_message">'."Thank you for your message".'</span>';

        $sql = "INSERT INTO portfolio (image, type, title, url) VALUES ('$filename', '$type', '$title', '$url' )";
        $conn -> query($sql);
        $image = $type = $title = $url = "";
    }

}

$target_dir = __DIR__."/../uploads/";
$folder =  $target_dir.basename($_FILES["image"]["name"]);
$is_uploaded = move_uploaded_file($tempname, $folder);


if (isset($_POST['update'])) {
    $id = $_POST['current'];
    $sql = "UPDATE portfolio SET image = '$filename', type = '$type', title = '$title', url = '$url' WHERE id = '$id'";
    $conn->query($sql);
    

}

if (isset($_POST['delete'])) {
    $delete = $_POST['current'];
    if ($conn->query("DELETE FROM portfolio WHERE id = '$delete'")) {
      //  echo "Deleted";
    };
}
?>

<main class="forms_main">
   <section class="row contact_form_row">
       <div class="wrapper form_wrap">
           <div class="intro_title">
               <h2 class="title">Portfolio Form</h2>
               <?php echo  $thanks_message ?>
           </div>
           <form action="" method="post" class="admin_form" id="contact" enctype="multipart/form-data">
               <fieldset>
                   <div>
                       <input class="tr3" type="file" name="image" id="image" value="<?php echo $image ?: '' ?>">
                       <label for="image"  class="<?php echo $error_image ? 'has_error' : '' ?>"><?php echo $error_image ?: "" ?></label>
                   </div>
                   <div>
                       <input class="tr3" type="text" name="type" placeholder="Type" id="type" value="<?php echo $type ?: '' ?>" autocomplete="off">
                       <label for="type"  class="<?php echo $error_type ? 'has_error' : '' ?>"><?php echo $error_type ?: "" ?></label>
                   </div>
                   <div>
                       <input class="tr3" type="text" name="title" placeholder="Title" id="title" value="<?php echo $title ?: '' ?>" autocomplete="off">
                       <label for="title"  class="<?php echo $error_title ? 'has_error' : '' ?>"><?php echo $error_title ?: "" ?></label>
                   </div>
                   <div>
                       <input class="tr3" type="text" name="url" placeholder="Href" id="url" value="<?php echo $url ?: '' ?>" autocomplete="off">
                       <label for="url"  class="<?php echo $error_url ? 'has_error' : '' ?>"><?php echo $error_url ?: "" ?></label>
                   </div>
               </fieldset>
               <fieldset>
                   <input type="submit" class="submit" value="Send" name="send">
               </fieldset>
           </form>
           <?php
           $sql_select = "SELECT * FROM portfolio";
           $result = $conn->query($sql_select);

           if ($result->num_rows > 0) {
               while ($row = $result->fetch_assoc()) {
                   $img_src = '/uploads/' . $row["image"];
                   ?>
                   <div class='flex justify_center admin_form_wrap'>
                       <div class='flex justify_center left_wrap'>
                         <div class='portfolio_item'>
                               <div class='inner'>
                                   <div>
                                       <a href='<?=$row["url"] ?>' target='_blank'>
                                           <img src='<?= $img_src ?>' alt='Personal Portfolio Images'>
                                       </a>
                                   </div>
                                   <div class='portfolio_content'>
                                       <h5><?= $row["type"]?></h5>
                                       <h3>
                                           <a href='<?= $row["url"] ?>' target='_blank' class='tr3'>
                                           <?= $row["title"] ?>
                                               <i class='arrow_up_right'></i>
                                           </a>
                                       </h3>
                                   </div>
                               </div>
                           </div>
                         <form action='' method='post' class='second_form flex align_center'>
                             <input type='hidden' name='current' value='<?= $row['id'] ?>'>
                             <input type='submit' name='delete' class='delete' value='Delete'>
                         </form>
                       </div>
                       <div class="update_form_wrap flex align_center justify_center">
                           <form action='' method='post' class='update_form' enctype="multipart/form-data">
                               <input type='hidden' name='current' value='<?= $row['id'] ?>'>
                               <label>
                                   <input type="file" name="image" value="<?= $row["image"] ?>">
                               </label>
                               <label>
                                   <input type="text" name="type" value="<?= $row["type"] ?>">
                               </label>
                               <label>
                                   <input type="text" name="title" value="<?= $row["title"] ?>">
                               </label>
                               <label>
                                   <input type="text" name="url" value="<?= $row["url"] ?>">
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
require_once __DIR__ .'/../parts/footer.php';
