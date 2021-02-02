<?php

namespace TFPro\Chinese;

/**
 * 获取汉字的拼音, 或者简繁体转换.
 */
class Chinese
{
    /**
     * 版本
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * 拼音字典
     *
     * @var array
     */
    static $pinyinDict;

    /**
     * 简繁体字典
     *
     * @var array
     */
    static $chineseDict;

    /**
     * 简繁体汉字转拼音
     *
     * @param string $chinese
     *
     * @return array
     */
    static public function pinyin($chinese)
    {
        $chinese = trim($chinese);
        $len = strlen($chinese);
        $return = array('py' => '', 'pinyin' => '');

        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($chinese, $i, 1)) > 127) {
                $tmp = self::query(substr($chinese, $i, 3), 1);
                $return['py'] .= substr($tmp, 0, 1);
                $return['pinyin'] .= $tmp;
                $i += 2;
            } else {
                $return['py'] .= substr($chinese, $i, 1);
                $return['pinyin'] .= substr($chinese, $i, 1);
            }
        }

        return $return;
    }

    /**
     * 简繁体转换
     *
     * @param string $chinese
     * @param bool $reverse
     *
     * @return string
     */
    static public function turn($chinese, $reverse = false)
    {
        $chinese = trim($chinese);
        $reverse = (bool)$reverse;

        $len = strlen($chinese);
        $return = '';
        for ($i = 0; $i < $len; $i++) {
            if (ord(substr($chinese, $i, 1)) > 127) {
                $return .= self::query(substr($chinese, $i, 3), $reverse ? 3 : 2);
                $i += 2;
            } else {
                $return .= substr($chinese, $i, 1);
            }
        }

        return $return;
    }

    /**
     * 执行字典查询
     *
     * @param  string $string
     * @param int $type
     *
     * @return string
     */
    static protected function query($string, $type)
    {
        switch ($type) {
                // 简繁体转拼音
            case 1:
                $dict = self::initDict('pinyin');
                return isset($dict[$string]) ? $dict[$string] : $string;
                break;

                // 简体转繁体
            case 2:
                $dict = array_flip(self::initDict('chinese'));
                return isset($dict[$string]) ? $dict[$string] : $string;
                break;

                // 繁体转简体
            case 3:
                $dict = self::initDict('chinese');
                return isset($dict[$string]) ? $dict[$string] : $string;
                break;
        }

        return '';
    }

    /**
     * 初始化字典
     *
     * @param $dictName
     *
     * @return mixed
     */
    static protected function initDict($dictName)
    {
        $dictName .= 'Dict';
        if (self::$$dictName == null) {
            self::$$dictName = require ucfirst($dictName) . '.php';
        }

        return self::$$dictName;
    }
}
