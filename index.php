<?php
require_once './configs/bootstrap.php';
require './vendor/autoload.php';
require_once './src/toolkit.php';

ob_start();

if (isset($_GET["page"])) {
    if (!fromPage($_GET['page'])) {
        fromPage('404');
    }
}

$pageContent = [
    "html" => ob_get_clean(),
];

if (isset($_GET["layout"])) {
    if (file_exists("./templates/layouts/" . $_GET["layout"] . ".layout.php")) {
        include "./templates/layouts/" . $_GET["layout"] . ".layout.php";
    } else {
        include './templates/includes/page/404.page.php';
    }
} else {
    include './templates/layouts/html.layout.php';
}
?>