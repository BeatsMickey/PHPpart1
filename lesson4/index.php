<?php


//Задание 1-3
function buildThubnails(string $path) {
    $filesArr = scandir($path);
    $content = "<div class='gallery' id='gallery'>";
    for ($i = 2; $i < count($filesArr); $i++) {
        $content .= "<img src='$path/$filesArr[$i]' alt='img' class='gallery_img'>";
    }
    $content .= "</div>";
    return $content;
}
$html = file_get_contents("templates/index.html");
$gallery = buildThubnails("public_html/img");
$html = str_replace("{gallery}", $gallery, $html);
echo $html;


//Задание 4
if (sizeof(file("data/logs/log.txt")) < 10) {
    file_put_contents("data/logs/log.txt", date("Y:M:h:i:s") . PHP_EOL, FILE_APPEND);

} else {
    $filesCount = count(scandir("data/logs")) - 3;
    file_put_contents("data/logs/log" . "$filesCount" . ".txt", file_get_contents("data/logs/log.txt"));
    file_put_contents("data/logs/log.txt", date("Y:M:h:i:s") . PHP_EOL);
}


