<?php

//Домашняя 2, задание 7
// написал свою функцию преобразования строки в массив чисто для тренировки
function getArrayFromString(string $str, string $symbol, string $typeOut = 'string'): array {
    $count = 0;
    $arr = [];
    for ($i = 0; $i < strlen($str); $i++) {
        if ($str[$i] === $symbol) {
            $count++;
            continue;
        }
        $arr[$count] .= $str[$i];
    }
    if ($typeOut === 'int') {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i] = (int)$arr[$i];
        }
        return $arr;
    } else if ($typeOut === 'float') {
        for ($i = 0; $i < count($arr); $i++) {
            $arr[$i] = (float)$arr[$i];
        }
        return $arr;
    }
    return $arr;
}

function getName(int $val, string $a1 = 'час', string $a2 = 'часа', string $a3 = 'часов') {

    if ($val > 20) {
        $val %= 10;
    }
    if ($val === 1) {
        return $a1;
    }
    if ($val > 1 && $val < 5) {
        return $a2;
    }
    if ($val <= 20) {
        return $a3;
    }
}

function getCorrectTime(string $format = 'h:i:s'): string {
    $time = date($format);
    $timeArr = getArrayFromString($time, ':', 'int');
    $correctTime = '';
    if (count($timeArr) == 3) {
        $correctTime = implode(' ', [(string)$timeArr[0], getName($timeArr[0]),
            (string)$timeArr[1], getName($timeArr[1], 'минута', 'минуты', 'минут'),
            (string)$timeArr[2], getName($timeArr[2], 'секунда', 'секунды', 'секунд')]);
    }
    if (count($timeArr) == 2) {
        $correctTime = implode(' ', [(string)$timeArr[0], getName($timeArr[0]),
            (string)$timeArr[1], getName($timeArr[1], 'минута', 'минуты', 'минут')]);
    }
    if (count($timeArr) == 1) {
        $correctTime = implode(' ', [(string)$timeArr[0], getName($timeArr[0])]);
    }
    return $correctTime;
}

echo '<br>' . getCorrectTime('h:i:s');
echo '<hr>';


// Задание 1
$count = 0;
while ($count <= 100) {
    if ($count % 3 === 0) {
        echo $count . ' ';
    }
    $count++;
}
echo '<hr>';

//Задание2
$count = 0;
do {
    if ($count === 0) {
        echo $count . ' - ноль ';
        $count++;
        continue;
    }
    if ($count % 2 === 0) {
        echo $count . ' - четное число ';
    } else {
        echo $count . ' - не четное число ';
    }
    $count++;
} while ($count <= 10);

echo '<hr>';

//Задание3
$array = [
    'Хабаровский край' => ['Хабаровск', 'Комсомольск-на-Амуре', 'Владивосток'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск'],
    'Московская область' => ['Москва', 'Зелиноград', 'Клин']
];

foreach ($array as $region => $cities) {
    echo '<br>' . $region . ' - входят города: ';
    foreach ($cities as $city) {
        if ($cities[count($cities) - 1] === $city) {
            echo $city . '. ';
            continue;
        }
        echo $city . ', ';

    }
}

echo '<hr>';


//Задание4
$array = ['а' => 'a','б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'je', 'з' => 'z', 'и' => 'i',
    'й' =>'yi', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
    'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ce', 'ч' => 'che', 'ш' => 'sh', 'щ' => "sh'", 'ъ' => "''",
    'ы', 'ь' => "'", 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'];

function translition(string $str, array $arr): string {
    $newStr = '';
    for ($i = 0; $i <= strlen($str); $i++) {
        if(!is_null($arr[$str[$i]])) {
            $newStr .= $arr[$str[$i]];
        } else {
            $newStr .= $str[$i];
        }
    }
    return $newStr;
}

$str = 'привет!';
echo translition($str, $array);
echo '<hr>';


//Задание5
function spaceReplace(string $str) {
    for ($i = 0; $i <= strlen($str); $i++) {
        if ($str[$i] === ' ') {
            $str[$i] = '_';
        }
    }
    return $str;
}

echo spaceReplace("I'am terminator !!!");
echo '<hr>';


//Задание6
function getNavMenu($menu): string {
    $menuHTML = '<nav>';
    foreach ($menu as $elMenu => $arrSubmenu) {
        $menuHTML .= '<div><a><span>' . $elMenu . '</span></a>';
        if (count($arrSubmenu) !== 0) {
            $menuHTML .= '<div>';
            foreach ($arrSubmenu as $elSubmenu) {
                $menuHTML .= "<a>$elSubmenu</a>";
            }
            $menuHTML .= '</div>';
        }
        $menuHTML .= '</div>';
    }
    $menuHTML .= '</nav>';
    return $menuHTML;
}
$navArr = ['Главная' => [], 'Новости' => ['Новости о спорте', 'Новости о политеке', 'Новости о мире'], 'Контакты' => [], 'Справка' => []];
$html = file_get_contents('index.html');
$html = str_replace('{navigation}', getNavMenu($navArr), $html);
echo $html;
echo '<hr>';


//Задание7
for ($i = 0; $i < 10; $i++, var_dump($i)) {
}

//Задание8
$array = [
    'Хабаровский край' => ['Хабаровск', 'Комсомольск-на-Амуре', 'Владивосток'],
    'Ленинградская область' => ['Санкт-Петербург', 'Всеволожск', 'Павловск'],
    'Московская область' => ['Москва', 'Зелиноград', 'Клин']
];
foreach ($array as $region => $cities) {
    echo '<br>' . $region . ' - входят города: ';
    foreach ($cities as $city) {
        if ($city[0] === 'К') {
            echo $city . ' ';
        }
    }
}

echo '<hr>';

//Задание9
$array = ['а' => 'a','б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ж' => 'je', 'з' => 'z', 'и' => 'i',
    'й' =>'yi', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
    'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ce', 'ч' => 'che', 'ш' => 'sh', 'щ' => "sh'", 'ъ' => "''",
    'ы', 'ь' => "'", 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'];

function transformation(string $str, array $arr): string {
    $newStr = '';
    for ($i = 0; $i <= strlen($str); $i++) {
        if(!is_null($arr[$str[$i]])) {
            $newStr .= $arr[$str[$i]];
        } else if ($str[$i] === ' ') {
            $newStr .= '_';
        } else {
            $newStr .= $str[$i];
        }
    }
    return $newStr;
}

$str = 'привет! hello!';
echo transformation($str, $array);
echo '<hr>';


//Задание10
$table = "<table>";
for ($i = 0; $i < 10; $i++) {
    $table .= "<tr>";
    for ($j = 0; $j < 10; $j++) {
        if ($i === 0 && $j === 0) {
            $tmp = 0;
            $table .= "<td style='border: 1px solid black; width: 30px; height: 30px; text-align: center'>0</td>";
            continue;
        } else if ($i === 0 && $j !== 0) {
            $tmp = ($i + 1) * $j;
            $table .= "<td style='border: 1px solid black; width: 30px; height: 30px; text-align: center'>$tmp</td>";
            continue;
        } else if ($i !== 0 && $j === 0) {
            $tmp = $i * ($j + 1);
            $table .= "<td style='border: 1px solid black; width: 30px; height: 30px; text-align: center'>$tmp</td>";
            continue;
        } else {
            $tmp = $i * $j;
            $table .= "<td style='border: 1px solid black; width: 30px; height: 30px; text-align: center'>$tmp</td>";
            continue;
        }
    }
    $table .= "</tr>";
}

echo $table;