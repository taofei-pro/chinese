<?php

use TFPro\Chinese\Chinese;

$chs = '中国人';
$cht = '中國人';

// 简繁体获取拼音
var_dump(Chinese::pinyin($chs));
var_dump(Chinese::pinyin($cht));

// 简繁体转换
var_dump(Chinese::turn($chs));
var_dump(Chinese::turn($cht, true));

// 版本
var_dump(Chinese::VERSION);
