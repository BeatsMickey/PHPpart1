<?php
    include 'config/functions.php';
    $pages = include 'config/pages.php';
    $p = (int)isset($_GET['p']) ? $_GET['p'] : 1;
    $page = isset($pages[$p]) ? $pages[$p] : $pages[1];
    $html = '';


    include 'page/' . $page;

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    $html_t = file_get_contents('main.tmpl');
    echo str_replace(['{CONTENT}', '{MSG}'],
                    [$html, $msg],
                    $html_t);