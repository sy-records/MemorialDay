<?php
/**
 * 「特殊节日使用」在国家公祭日、全国哀悼日时网站增加灰色滤镜。<a href="https://github.com/sy-records/MemorialDay" target="_blank">GitHub</a>
 *
 * @package MemorialDay
 * @author 沈唁
 * @version 1.1.0
 * @link https://qq52o.me
 */

namespace TypechoPlugin\MemorialDay;

use Typecho\Widget;
use Typecho\Plugin as TypechoPlugin;
use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

class Plugin implements PluginInterface
{
    public static function activate()
    {
        TypechoPlugin::factory('Widget_Archive')->header = array(__CLASS__, 'websiteSet');
        return _t('MemorialDay 插件已启用');
    }

    public static function deactivate()
    {
        return _t('MemorialDay 插件已禁用');
    }

    public static function config(Form $form)
    {
        $days = new Text(
            'days',
            null,
            "0404,0512,0918,1213",
            _t('日期：'),
            _t('日期使用英文逗号<code>,</code>分隔，可以自行增加删除日期；如果使用了CDN，请自行刷新缓存。')
        );
        $form->addInput($days->addRule('required', _t('日期为必填项')));
    }

    public static function personalConfig(Form $form)
    {
    }

    public static function websiteSet()
    {
        $days = Widget::widget('Widget_Options')->plugin('MemorialDay')->days;
        $dayArr = explode(',', $days);
        if (in_array(date('md'), $dayArr)) {
            echo "<style type='text/css'>html{ filter: grayscale(100%); -webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: url('data:image/svg+xml;utf8,#grayscale'); filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); -webkit-filter: grayscale(1);}</style>
";
        }
    }
}
