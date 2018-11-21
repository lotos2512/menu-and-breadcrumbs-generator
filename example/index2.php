<?php

/**
 * use your autoloader
 */
require(__DIR__ . '/../vendor/autoload.php');

use lotos2512\menuAndBreadcrumbsGenerator\BreadcrumbsGenerator;
use lotos2512\menuAndBreadcrumbsGenerator\MenuGenerator;
use lotos2512\menuAndBreadcrumbsGenerator\RecursiveBreadcrumbsStrategy;
use lotos2512\menuAndBreadcrumbsGenerator\LineRenderStrategy;

$tree = require_once "menu.php";
$menu = (new MenuGenerator(new LineRenderStrategy(), '/admin/update_transaction.php', $tree))->getMenu();
$breadcrumbs1 = (new BreadcrumbsGenerator(new RecursiveBreadcrumbsStrategy(), '/admin/update_transaction.php', $tree))->getBreadcrumbs();
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>

<style>
    BODY, P, TD, TH, INPUT, SELECT, TEXTAREA, LI, UL, OL, DT, DD {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        font-size: 11px;
    }

    a:link {
        color: #aa5500;
    }

    a:visited {
        color: #666666;
    }

    a:hover {
        color: #F5733F;
        text-decoration: underline;
    }

    a:active {
        color: #F26A3C;
        text-decoration: underline;
    }

    #menu {
        width: 210px;
        margin: 37px 0px 0px 0px;
        padding: 0px;
        border-collapse: collapse;
    }

    #menu a:link, #menu a:visited {
        color: #0095d7;
    }

    #menu TD, #menu TH {
        margin: 0px;
        padding: 0px;
    }

    #menu .select {
        background: #f0f0f0;
    }

    .menu0 {
        font-size: 11px;
        padding-left: 10px;
        text-transform: uppercase;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu1 {
        font-size: 11px;
        font-weight: normal;
        padding-left: 15px;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu2 {
        font-size: 11px;
        padding-left: 32px;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu3 {
        font-size: 10px;
        padding-left: 47px;
        font-weight: bold;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu4 {
        font-size: 10px;
        padding-left: 53px;
        color: #9C2D0C;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu5 {
        font-size: 10px;
        padding-left: 60px;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    .menu6 {
        font-size: 10px;
        padding-left: 65px;
        padding-top: 1px;
        padding-bottom: 2px;
    }

    #content TABLE {
        border: 1px #3ac7f4 solid;
        border-collapse: collapse;
    }

    #content TH {
        color: #ffffff;
        background-color: #0095d7;
        border: 1px #3ac7f4 solid;
        padding: 7px 2px;
    }

    #content TD {
        border: 1px #3ac7f4 solid;
        padding: 2px;
    }

    H1 {
        font: bold 11px Verdana, Arial, Helvetica, sans-serif;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    H2 {
        font: bold 10px Verdana, Arial, Helvetica, sans-serif;
        color: #D7431E;
        text-transform: uppercase;
    }

    LI {
        line-height: 20px;
    }
</style>
<div>
    <?= $breadcrumbs1 ?>
</div>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td valign="top">
            <table id="menu">
                <?= $menu ?>
            </table>

        </td>
    </tr>
</table>
</body>
</html>
