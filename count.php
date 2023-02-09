<?php

static $numArr = [
// 格式: 工资(包括餐补)-五险一金, 年终奖不写
    10000 - 472.52,//1
    10000 - 472.52,//2
    10000 - 472.52,//3
    10000 - 472.52,//4
    10000 - 472.52,//5
    10000 - 472.52,//6
    10000 - 472.52,//7
    10000 - 496.84,//8
    10000 - 496.84,//9
    10000 - 496.84,//10
    10000 - 496.84,//11
    10000 - 496.84,//12

];
$res = [

];
foreach ($numArr as $key => $value) {
    $res[$key] = [
        'sum' => $value,// 扣除五险一金后的工资
        'res' => 0,//本月应缴纳的税
        'resSum' => 0,//累计应缴纳的税
    ];
    $res[$key]['resSum'] = getCount(getSum($key, $numArr));
    $res[$key]['res'] = $res[$key]['resSum'] - (isset($res[$key - 1]['resSum']) ? $res[$key - 1]['resSum'] : 0);
    echo sprintf("[sum]%s [res]%s [resSum]%s\n", $res[$key]['sum'], $res[$key]['res'], $res[$key]['resSum']);
}

// 累加应计算税的钱
function getSum($key, $numArr)
{
    $all = 0;
    while ($key >= 0) {
        $all += $numArr[$key] - (5000); //有几项专项扣除扣几项
        $key--;
    }

    return $all;
}

//
function getCount($num)
{
    if ($num < 36000) {
        return $num * 0.03 - 0;
    }
    if ($num < 144000) {
        return $num * 0.1 - 2520;
    }
    if ($num < 300000) {
        return $num * 0.2 - 16920;
    }
    if ($num < 420000) {
        return $num * 0.25 - 31920;
    }
    if ($num < 660000) {
        return $num * 0.3 - 52920;
    }
    if ($num < 960000) {
        return $num * 0.35 - 85920;
    }

    return $num * 0.45 - 181920;
}

