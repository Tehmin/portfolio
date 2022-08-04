<?php
require_once __DIR__ . '/../config/connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mina</title>
    <link rel="icon" type="image/png" href="/images/favicon.png">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<header class="header tr3">
    <div class="row">
        <div class="wrapper header_wrapper flex align_center justify_between">
            <div class="header_logo_wrap flex align_center">
                <a href="#intro">
                    <img src="/images/logo_white.png" alt="logo">
                </a>
            </div>
            <div class="flex menu_block">
                <nav>
                    <ul class="primary_menu flex flex_wrap">
                        <li>
                            <div class="header_logo_wrap flex align_center">
                                <a href="#">
                                    <img src="/images/logo_white.png" alt="logo">
                                </a>
                            </div>
                        </li>
                        <?php
                            if (isset($_SESSION['logged'])) {
                                $host = $_SERVER['HTTP_HOST'];
                                $request = $_SERVER['REQUEST_SCHEME'];
                                $sql_select_menu = "SELECT title, link FROM admin_menu";
                                $result = $conn->query($sql_select_menu);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo
                                            "<li class='admin_menu_item'><a href='" . $request . '://' . $host . '/' . $row["link"] . "' data-hover='" . $row['title'] . "' >" . $row["title"] . "</a></li>";
                                    }
                                }
                                else {
                                    echo "0 results";
                                }
                            }
                            else {
                                $sql_select_menu = "SELECT title, link FROM menu";
                                $result = $conn->query($sql_select_menu);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo
                                            "<li><a href='#" . $row["link"] . "' data-hover='" . $row['title'] . "' >" . $row["title"] . "</a></li>";
                                    }
                                }
                                else {
                                    echo "0 results";
                                }
                            }
                        ?>
                    </ul>
                </nav>
            </div>
            <div class="hamburger flex_content_between">
                <div class="dash_1"></div>
                <div class="dash_2"></div>
                <div class="dash_3"></div>
            </div>
        </div>
    </div>
</header>
