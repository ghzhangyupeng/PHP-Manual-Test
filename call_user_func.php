<?php
/**
 * Created by PhpStorm.
 * User: zhangyupeng
 * Date: 18/2/24
 * Time: 12:03
 */

function demo($var, $var2){
    echo $var;
    return ++$var2;
}

class demo{

    public function __construct()
    {

    }

    public function test($var, $var2)
    {
        var_dump($var);
        return ++$var2;
    }
}

echo call_user_func('demo', 11, 22);
var_dump(call_user_func_array([new demo(), 'test'], [33, 44]));

