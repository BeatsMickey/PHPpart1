<?php
define(HOST, 'localhost');
define(USER, 'root');
define(PASS, 'root');
define(DB, 'lesson5teach');

$link = mysqli_connect(HOST, USER, PASS, DB);
$id = (int)$_GET['id'];
$html = "";
if (!empty($_POST)) {
    $select_sql = "SELECT reviw FROM images WHERE id = $id";
    $res = mysqli_query($link, $select_sql);
    $row = mysqli_fetch_assoc($res);
    $temp = $row['reviw'] . "<br>" . $_POST['reviw'];
    $sql = "UPDATE images SET reviw = '$temp' WHERE id = $id";
    mysqli_query($link, $sql);
}
if(empty($id))
{
    $sql = "SELECT id,name,path_thumb FROM images ORDER BY views DESC";
    $res = mysqli_query($link, $sql);
    $html .= '<div class="gallery">';
    while ($row = mysqli_fetch_assoc($res))
    {
        $thumb_name = explode('.', $row['name']);
        $html .= '<a href="?id=' . $row['id'] . '" class="img_link">';
        $html .= '<img src="' . $row['path_thumb'] . '/' . $thumb_name[0] . '_thumb.' . $thumb_name[1] . '" class="image" alt=""/>';
        $html .= '</a>';
    }
    $html .= '</div>';
}
else
{
    $select_sql = "SELECT id,name,path_full,views,reviw FROM images WHERE id=$id";
    $res = mysqli_query($link, $select_sql);
    $row = mysqli_fetch_assoc($res);
    $views = (!empty($row['views'])) ? ++$row['views'] : 1;
    $html .= '<img src="' . $row['path_full'] . '/' . $row['name'] . '" class="full__image" alt=""/>';
    $html .= '<div class="counter">Просмотры: ' . $views . '</div>';
    $html .= "<div>
        <p>Отзывы:</p>
        {$row['reviw']}
        </div>";
    $html .= "
    <p>Оставить отзыв:</p>
    <form method='post' action='?id=$id'>
        <textarea name='reviw' cols='30' rows='10'></textarea>
        <input type='submit'>
    </form>
    ";
    $update_sql =  "UPDATE images SET views = $views WHERE id = $id";
    $result = mysqli_query($link, $update_sql) or die(mysqli_error($link));
}
$template = file_get_contents('gallery.tpl');
$template = str_replace('{gallery}', $html, $template);
echo $template;