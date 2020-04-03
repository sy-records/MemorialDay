<?php
/*
Plugin Name: MemorialDay
Plugin URI: https://github.com/sy-records/MemorialDay/tree/wordpress
Description: 「特殊节日使用」在国家公祭日、全国哀悼日时网站增加灰色滤镜
Version: 1.0.0
Author: 沈唁
Author URI: https://qq52o.me
License: Apache 2.0
*/

define('MEMORIALDAY_BASEFOLDER', plugin_basename(dirname(__FILE__)));

register_activation_hook(__FILE__, 'memorial_day_set_options');
function memorial_day_set_options()
{
    $options = array(
        'days' => "0404,0512,0918,1213",
    );
    add_option('memorial_day_options', $options, '', 'yes');
}

function memorial_day_wp_head()
{
    $options = get_option('memorial_day_options');
    $day_arr = explode(",", $options['days']);
    if (in_array( date('md'), $day_arr)) {
        echo "<style type='text/css'>html{ filter: grayscale(100%); -webkit-filter: grayscale(100%); -moz-filter: grayscale(100%); -ms-filter: grayscale(100%); -o-filter: grayscale(100%); filter: url('data:image/svg+xml;utf8,#grayscale'); filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1); -webkit-filter: grayscale(1);}</style>
";
    }
}

add_action('wp_head', 'memorial_day_wp_head');

function memorial_day_add_setting_page()
{
    add_options_page('MemorialDay设置', 'MemorialDay设置', 'manage_options', __FILE__, 'memorial_day_setting_page');
}

add_action('admin_menu', 'memorial_day_add_setting_page');

function memorial_day_setting_page()
{
    if (!current_user_can('manage_options')) {
        wp_die('Insufficient privileges!');
    }
    $options = array();
    if (!empty($_POST) and $_POST['type'] == 'memorial_day_set') {
        $options['days'] = isset($_POST['days']) ? sanitize_text_field($_POST['days']) : '';
    }

    if ($options !== array()) {
        update_option('memorial_day_options', $options);
        echo '<div class="updated"><p><strong>设置已保存！</strong></p></div>';
    }

    $md_options = get_option('memorial_day_options', true);
    $md_day = $md_options['days'];

    ?>

    <div class="wrap" style="margin: 10px;">
        <h1>MemorialDay设置</h1>
        <p><b>国家公祭日</b>：国家公祭日的设立，是缅怀过去，更是抚慰民心、顺应民意的措施，同时国家公祭日的设立，也是中国与世界更好的在沟通，在向全世界传递中华民族对于人权和文明的态度，在向全世界表达我们热爱和平、维护和平的决心与责任。就如欧洲一年一度纪念奥斯威辛集中营死难者一样，南京大屠杀死难者国家公祭日，不仅是中国的，也是全世界的。反对战争，珍爱和平！是全球人民共同所需要的，任何战争为一己私欲，只会危害民众！</p>
        <p>以国家名义进行正式纪念与公祭，其世界意义在于，能促使人类历史记忆长久保持唤醒状态，而避免出现哪怕是片刻的忘却与麻木，共同以史为鉴、开创未来，一起维护世界和平及正义良知，促进共同发展和时代进步。</p>
        <hr/>
        <p><b>全国哀悼日</b>：设立全国哀悼日，全国下半旗志哀，这种中央政府以全体国民名义举行的哀悼仪式，不但能给遇难同胞的亲人以莫大的精神慰藉，更能让全体国民都真切感受到自己是祖国大家庭的一员，从而增强每个公民的国家认同感和民族认同感，激发人们的爱国情怀和整个民族的凝聚力。国旗为公民而下降时，就是尊严为生命而上升的时候。</p>
        <hr/>
        <form name="form" method="post" action="<?php echo wp_nonce_url('./options-general.php?page=' . MEMORIALDAY_BASEFOLDER . '/memorial-day.php'); ?>">
            <table class="form-table">
                <tr>
                    <th>
                        <legend>日期</legend>
                    </th>
                    <td>
                        <input type="text" name="days" value="<?php echo $md_day; ?>" size="50"/>

                        <p>日期使用英文逗号<code>,</code>分隔，可以自行增加删除日期；</p>
                        <p>如果使用了CDN，请自行刷新缓存。</p>
                    </td>
                </tr>
                <tr>
                    <th>
                        <legend>保存/更新选项</legend>
                    </th>
                    <td><input type="submit" name="submit" class="button button-primary" value="保存更改"/></td>
                </tr>
            </table>
            <input type="hidden" name="type" value="memorial_day_set">
        </form>
    </div>
<?php
}
?>