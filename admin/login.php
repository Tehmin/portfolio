<?php
require_once __DIR__ .'/../parts/header.php';

session_start();

if ($_SESSION['logged']) {
    header('Location: /admin/index.php');
    exit;
}

?>
<main class="forms_main">
    <section class="row contact_form_row">
        <div class="wrapper form_wrap">
            <div class="intro_title">
                <h2 class="title">Admin Login Form</h2>
            </div>
            <form action="/admin/index.php" method="post" class="admin_form" id="contact">
                <fieldset>
                    <input type="email" required name="email" placeholder="Email" autocomplete="off">
                    <input type="password" required name="password" placeholder="Password" autocomplete="off">
                </fieldset>
                <fieldset>
                    <input type="submit" name="login" value="Login" class="submit">
                </fieldset>
            </form>
        </div>
    </section>
</main>

<?php

require_once __DIR__ .'/../parts/footer.php';
