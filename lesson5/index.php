<?php

if (!empty($_GET['open'])) {
    $link = mysqli_connect("localhost", "root", "root", "lesson5");
    mysqli_query($link, "UPDATE IMG SET IMG_views = IMG_views + 1 WHERE id_IMG = {$_GET['open']}");
    $result = mysqli_query($link, "SELECT IMG_url,IMG_name,IMG_views FROM IMG WHERE id_IMG = {$_GET['open']}");
    $epms = [];
    while($row = mysqli_fetch_assoc($result))
        $epms[] = $row;
    $content = "<img src='{$epms[0]['IMG_url']}' alt='{$epms[0]['IMG_name']}'><br><h3> Число просмотров - {$epms[0]['IMG_views']}</h3>";
    echo $content;
    mysqli_close($link);
    exit;
}

//Задание 1-4
$link = mysqli_connect("localhost", "root", "root", "lesson5");
$result = mysqli_query($link, "SELECT id_IMG,IMG_url,IMG_name,IMG_views FROM IMG");
$epms = [];
while($row = mysqli_fetch_assoc($result))
    $epms[] = $row;
mysqli_close($link);

function buildThubnails(array $arr) {
    //сортировка
    $count_elements = count($arr);
    $iterations = $count_elements - 1;
    for ($i=0; $i < $count_elements; $i++) {
        $changes = false;
        for ($j=0; $j < $iterations; $j++) {
            if ($arr[$j]['IMG_views'] > $arr[($j + 1)]['IMG_views']) {
                $changes = true;
                list($arr[$j], $arr[($j + 1)]) = array($arr[($j + 1)], $arr[$j]);
            }
        }
        $iterations--;
        if (!$changes) {
            break;
        }
    }

    $content = "<div class='gallery' id='gallery'>";
    for ($i = count($arr) - 1; $i >= 0; $i--) {
        $content .= "<a href='?open={$arr[$i]['id_IMG']}'><img src='{$arr[$i]['IMG_url']}' alt='{$arr[$i]['IMG_name']}' 
            class='gallery_img'><h3> Число просмотров - {$arr[$i]['IMG_views']}</h3></a>";
    }
    $content .= "</div>";
    return $content;
}

$html = file_get_contents("templates/index.html");
$gallery = buildThubnails($epms);
$html = str_replace("{gallery}", $gallery, $html);
echo $html;





