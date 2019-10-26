<?php
function connect() {
    static $link;
    if (empty($link)) {
        $link = mysqli_connect('localhost', 'root', 'root', 'lesson7');
    }
    return $link;
}


