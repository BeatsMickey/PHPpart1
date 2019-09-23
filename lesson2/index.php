<?php
// Задание 1
$a = rand();
$b = rand();

function choise($a, $b) {
    if ($a >= 0 && $b >= 0) {
        echo $a - $b;
    } else if ($a < 0 && $b < 0) {
        echo $a * $b;
    } else {
        echo $a + $b;
    }
}

choise($a, $b);


//Задание 2
$a = rand(0,15);
switch ($a) {
    case 0:
        echo "<br>0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 1:
        echo "<br>1,2,3,4,5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 2:
        echo "<br>2,3,4,5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 3:
        echo "<br>3,4,5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 4:
        echo "<br>4,5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 5:
        echo "<br>5,6,7,8,9,10,11,12,13,14,15";
        break;
    case 6:
        echo "<br>6,7,8,9,10,11,12,13,14,15";
        break;
    case 7:
        echo "<br>7,8,9,10,11,12,13,14,15";
        break;
    case 8:
        echo "<br>8,9,10,11,12,13,14,15";
        break;
    case 9:
        echo "<br>9,10,11,12,13,14,15";
        break;
    case 10:
        echo "<br>10,11,12,13,14,15";
        break;
    case 11:
        echo "<br>11,12,13,14,15";
        break;
    case 12:
        echo "<br>12,13,14,15";
        break;
    case 13:
        echo "<br>13,14,15";
        break;
    case 14:
        echo "<br>14,15";
        break;
    case 15:
        echo "<br>15";
        break;
}


//Задание 3
function difference($a, $b) {
    return $a - $b;
}
function sum($a, $b) {
    return $a + $b;
}
function div($a, $b) {
    return $a / $b;
}
function mult($a, $b) {
    return $a * $b;
}
echo "<br>" . difference(1,2);
echo "<br>" . sum(1,2);
echo "<br>" . div(1,2);
echo "<br>" . mult(1,2);


//Задание 4
function calc($a, $b, $operand) {
    switch ($operand) {
        case "+":
            return $a + $b;
            break;
        case "-":
            return $a - $b;
            break;
        case "/":
            return $a / $b;
            break;
        case "*":
            return $a * $b;
            break;
        default:
            return "unsupported operand";
    }
}
$result = calc(1,2,"+");
echo "<br>$result";


//Задание 5
$today = date("d.m.Y");
$footer = <<<php
    <p>{$today}</p>
php;

$html = file_get_contents('main.html');
$html = str_replace('{Footer}', $footer, $html);
echo $html;

//Задание 6
function power($val, $pow) {
    if ($pow > 0) {
        if ($pow == 1) {
            return $val;
        }
        return $val * power($val, $pow - 1);
    } else if ($pow < 0) {
        if ($pow == -1) {
            return 1 / $val;
        }
        return 1 / $val * power($val, $pow + 1);
    } else {
        return 1;
    }
}
echo "<br>" . power(2,4);
echo "<br>" . power(-2,-3);





