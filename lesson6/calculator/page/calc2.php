<?php
if (!empty($_POST['symbol'])) {
    $temp = $_POST['str'] . $_POST['symbol'];
    $html = render('calc2', ['str' => $temp]);
    $html_t = file_get_contents('main.tmpl');
    echo str_replace(['{CONTENT}', '{MSG}'],
        [$html, ''],
        $html_t);
    exit;
} else if (!empty($_POST['str']) && !empty($_POST['result'])) {
    var_dump(4444);
    $msg = calc2($_POST['str']);
    header('Location: /?p=6&msg=' . $msg);
    exit;
}

$html = render('calc2');