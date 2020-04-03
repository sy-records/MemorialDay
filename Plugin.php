<?php
/**
 * 「特殊节日使用」在国家公祭日、全国哀悼日时网站增加灰色滤镜。<a href="https://github.com/sy-records/MemorialDay/tree/typecho" target="_blank">Github</a>
 *
 * @package MemorialDay
 * @author 沈唁
 * @version 1.0.0
 * @link https://qq52o.me
 */

/* 激活插件方法 */

class MemorialDay_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'website_set');
        return _t('MemorialDay 插件已启用');
    }

    public static function deactivate()
    {
        return _t('MemorialDay 插件已禁用');
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $days = new Typecho_Widget_Helper_Form_Element_Text(
            'days',
            null,
            "0404,0512,0918,1213",
            _t('日期：'),
            _t('日期使用英文逗号<code>,</code>分隔，可以自行增加删除日期；如果使用了CDN，请自行刷新缓存。')
        );
        $form->addInput($days->addRule('required', _t('日期为必填项')));
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function website_set()
    {
        $days = Typecho_Widget::widget('Widget_Options')->plugin('MemorialDay')->days;
        $day_arr = explode(",", $days);
        if (in_array( date('md'), $day_arr)) {
            echo "<style type='text/css'>html{ filter: grayscale(100%); -webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: url('data:image/svg+xml;utf8,#grayscale'); filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); -webkit-filter: grayscale(1);}</style>
";
        }
    }
}