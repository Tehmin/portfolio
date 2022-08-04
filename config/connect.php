<?php

$conn = mysqli_connect("localhost", "root", "", "mina");

if ($conn === false) {
    die("ERROR: Could not connect. "
        . mysqli_connect_error());

}