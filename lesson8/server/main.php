<?php
session_start();

include 'config/link.php';
include 'config/function.php';
include 'config/config.php';

checkLogIn();

$_SESSION['variables']['quantity'] = empty($_SESSION['variables']['quantity']) ? 0 : $_SESSION['variables']['quantity'];
$page = !empty($_GET['p']) ? $_GET['p'] : 'index';
$function = !empty($_GET['f']) ? $_GET['f'] : 'index';

$dir = __DIR__ . '/';

if (!file_exists($dir . '/pages/' . $page . '.php' )) {
    $page = 'index';
}
include ($dir . '/pages/' . $page . '.php');
if (!function_exists($function)) {
    $function = 'index';
}

$msg = '<p class="msg">';
if (!empty($_SESSION['variables'][MSG])) {
    $msg .= $_SESSION['variables'][MSG];
    unset($_SESSION['variables'][MSG]);
}
$msg .= '</p>';

$content = $function();
$html = file_get_contents($dir . '/tmpl/main.tmpl');
$menu = file_get_contents($dir . '/tmpl/' . $_SESSION['variables'][TMPL_MENU]);
echo str_replace(['{MENU}','{CONTENT}', '{QUANTITY}', '{MSG}'], [$menu, $content, $_SESSION['variables']['quantity'], $msg] , $html);
var_dump($_SESSION);