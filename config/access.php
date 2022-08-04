<?php

session_start();
class Login
{
    function __construct($email, $pass)
    {
        $this->user_email = $email;
        $this->user_pass = $pass;


        $is_login = $_SESSION['logged'];
        if (!$is_login) {

            if ($this->user_email === $this->admin_email && $this->user_pass === $this->admin_pass) {
                $_SESSION['logged'] = 'true';
            }
            else {
                $_SESSION = [];
                header('Location: /admin/login.php');
            }
        }
    }
    private $user_email;
    private $user_pass;

    private $admin_email = 'mina@gmail.com';
    private $admin_pass = '123';

    private function validate(){

    }
}


new Login($_POST['email'], $_POST['password']);
