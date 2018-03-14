<?php
/**
 * Created by PhpStorm.
 * User: zhangyupeng
 * Date: 18/3/13
 * Time: 10:41
 */
function gen(){
    $ret = (yield '1-yield');
    var_dump($ret);
    $ret = (yield '2-yield');
//    var_dump($ret);
    return $ret;
    $ret = (yield '3-yield');
    return $ret;
}
$gen = gen();
var_dump($gen->current());
echo "<br/>";
var_dump($gen->send('ret11')); //
echo "<br/>";
var_dump($gen->send('ret22'));
var_dump($gen->send('ret22'));

