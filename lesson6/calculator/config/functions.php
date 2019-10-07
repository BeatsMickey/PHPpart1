<?php
function getId()
{
    return (int)isset($_GET['id']) ? $_GET['id'] : 0;
}

function clrString($str)
{
    global $link;
    return mysqli_real_escape_string($link, trim($str));
}

function render($tmpl, $params = [])//['name' => 'Rox', 'log'=>'rt']
{
    extract($params);
    ob_start();
    include dirname(__DIR__) . '/tmpl/' . $tmpl . '.php';
    return ob_get_clean();
}
function calc1($a, $b, $operand) {
    switch ($operand) {
        case "sum":
            return $a + $b;
        case "dif":
            return $a - $b;
        case "div":
            if ((int)$b === 0) {
                return "division by zero is not supported";
            }
            return $a / $b;
        case "mult":
            return $a * $b;
        default:
            return "unsupported operand";
    }
}


function calc2($statement) {
    if (!is_string($statement)) {
        return 'Wrong type';
    }
    $calcQueue = array();
    $operStack = array();
    $operPriority = array(
        '(' => 0,
        ')' => 0,
        '+' => 1,
        '-' => 1,
        '*' => 2,
        '/' => 2,
    );
    $token = '';
    foreach (str_split($statement) as $char) {
        if ($char >= '0' && $char <= '9') {
            $token .= $char;
        } else {
            if (strlen($token)) {
                array_push($calcQueue, $token);
                $token = '';
            }
            if (isset($operPriority[$char])) {
                if (')' == $char) {
                    while (!empty($operStack)) {
                        $oper = array_pop($operStack);
                        if ('(' == $oper) {
                            break;
                        }
                        array_push($calcQueue, $oper);
                    }
                    if ('(' != $oper) {
                        return 'Unexpected ")"';
                    }
                } else {
                    while (!empty($operStack) && '(' != $char) {
                        $oper = array_pop($operStack);
                        if ($operPriority[$char] > $operPriority[$oper]) {
                            array_push($operStack, $oper);
                            break;
                        }
                        if ('(' != $oper) {
                            array_push($calcQueue, $oper);
                        }
                    }
                    array_push($operStack, $char);
                }
            } elseif (strpos(' ', $char) !== FALSE) {
            } else {
                return 'Unexpected symbol "' . $char . '"';
            }
        }

    }
    if (strlen($token)) {
        array_push($calcQueue, $token);
        $token = '';
    }
    if (!empty($operStack)) {
        while ($oper = array_pop($operStack)) {
            if ('(' == $oper) {
                return 'Unexpected "("';
            }
            array_push($calcQueue, $oper);
        }
    }
    $calcStack = array();
    foreach ($calcQueue as $token) {
        switch ($token) {
            case '+':
                $arg2 = array_pop($calcStack);
                $arg1 = array_pop($calcStack);
                array_push($calcStack, $arg1 + $arg2);
                break;
            case '-':
                $arg2 = array_pop($calcStack);
                $arg1 = array_pop($calcStack);
                array_push($calcStack, $arg1 - $arg2);
                break;
            case '*':
                $arg2 = array_pop($calcStack);
                $arg1 = array_pop($calcStack);
                array_push($calcStack, $arg1 * $arg2);
                break;
            case '/':
                $arg2 = array_pop($calcStack);
                $arg1 = array_pop($calcStack);
                array_push($calcStack, $arg1 / $arg2);
                break;
            default:
                array_push($calcStack, $token);
        }
    }
    return array_pop($calcStack);
}
