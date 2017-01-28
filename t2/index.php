<?php

function dectobin($dec){
    $res = '';
    $res2 = '';
    //целая часть
    $int = floor($dec);
    while($int > 0){
        if($int%2 > 0){
            $res = '1' . $res;
        } else {
            $res = '0' . $res;
        }
        $int = floor($int / 2);
    }
    
    //дробная часть
    $float = $dec - floor($dec);
    if($float != 0){
        $res2 = '.';
        while($float > 0 && strlen($res2) < 1000){
            $float = $float*2;
            if($float >= 1){
                $res2 .= '1';
            } else {
                $res2 .= '0';
            }
            $float = $float - floor($float);
        }
    }
    return $res . $res2;
}


function bintodec($bin){
    $parts = explode('.', $bin);
    $str = $parts[0];
    $start = 1;
    $res = 0;
    while (strlen($str) > 0){
        $res += substr($str, -1) * $start;
        $str = substr($str, 0, -1);
        $start = $start * 2;
    }
    if(isset($parts[1])){
        $str = $parts[1];
        $start = 0.5;
        while (strlen($str) > 0){
            $res += substr($str, 0, 1) * $start;
            $str = substr($str, 1);
            $start = $start / 2;
        }
    }
    return $res;
}

$res = '';
$res_bin = '';
$dec = isset($_POST['dec'])?$_POST['dec']:'';
$bin = isset($_POST['bin'])?$_POST['bin']:'';
if($dec && is_numeric($dec)){
    $res = dectobin($dec);
} else {
    $res = $dec?'error':'';
    $dec ='';
}
if($bin && preg_match('~^([01]*.?[01]*)$~', $bin)){
    $res_bin = bintodec($bin);
} else {
    $res_bin = $bin?'error':'';
    $bin = '';
}
?>
<!DOCTYPE Html >
<html>
    <head>
        <title>Тестовое задание 2</title>
    </head>
    <body>
        <form method="post" action="">
            <label for="dec">Десятичное число</label>
            <input type="text" id="dec" name="dec" value="<?php echo $dec; ?>"/>
            <input type="submit" value="перевести" />
        </form>
        Результат: <?php echo $res; ?>
        <br />
        <br />
        <form method="post" action="">
            <label for="bin">Двоичное число</label>
            <input type="text" id="bin" name="bin" value="<?php echo $bin; ?>"/>
            <input type="submit" value="перевести" />
        </form>
        Результат: <?php echo $res_bin; ?>
        <br />
        <br />
    </body>
</html>

