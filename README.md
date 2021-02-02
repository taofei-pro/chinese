Chinese
=====

获取汉字的拼音, 或者简繁体转换

# 安装方法
命令行下, 执行 composer 命令安装:
````
composer require tf-pro/chinese
````

# 使用示例
````
use TFPro\Chinese\Chinese;

$chs = '中国人';
$cht = '中國人';

// 简繁体获取拼音
var_dump(Chinese::pinyin($chs));
var_dump(Chinese::pinyin($cht));

// 简繁体转换
var_dump(Chinese::turn($chs));
var_dump(Chinese::turn($cht, true));
````

# 关于部分无法正确转换
> 可以自行补充 src/ 下 Dict.php 中的字典
