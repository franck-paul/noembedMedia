<?php
/**
 * @brief noembedMedia, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul and contributors
 *
 * @copyright Franck Paul carnet.franck.paul@gmail.com
 * @copyright GPL-2.0 https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('DC_CONTEXT_ADMIN')) {return;}

// dead but useful code, in order to have translations
__('noembed Media') . __('Insert external media from Internet via noembed.com');

$core->addBehavior('adminPageHTTPHeaderCSP', ['noembedMediaBehaviors', 'adminPageHTTPHeaderCSP']);
$core->addBehavior('adminPostEditor', ['noembedMediaBehaviors', 'adminPostEditor']);
$core->addBehavior('ckeditorExtraPlugins', ['noembedMediaBehaviors', 'ckeditorExtraPlugins']);

class noembedMediaBehaviors
{
    public static function adminPageHTTPHeaderCSP($csp)
    {
        if (!isset($csp['script-src'])) {
            $csp['script-src'] = '';
        }
        $csp['script-src'] .= ' ' . 'https://noembed.com';
    }

    public static function adminPostEditor($editor = '', $context = '', array $tags = [], $syntax = '')
    {
        global $core;

        $res = '';
        if ($editor == 'dcLegacyEditor') {

            $res =
            $res =
            dcPage::jsJson('dc_editor_noembedmedia', ['title' => __('External media')]) .
            dcPage::jsLoad(urldecode(dcPage::getPF('noembedMedia/js/post.js')), $core->getVersion('noembedMedia'));

        } elseif ($editor == 'dcCKEditor') {

            $res =
            dcPage::jsJson('ck_editor_noembedmedia', [
                'title'        => __('External media'),
                'tab_url'      => __('URL'),
                'url'          => __('Page URL:'),
                'url_empty'    => __('URL cannot be empty.'),
                'tab_align'    => __('Alignment'),
                'align'        => __('Media alignment:'),
                'align_none'   => __('None'),
                'align_left'   => __('Left'),
                'align_right'  => __('Right'),
                'align_center' => __('Center')
            ]);

        }
        return $res;
    }

    public static function ckeditorExtraPlugins(ArrayObject $extraPlugins, $context = '')
    {
        $extraPlugins[] = [
            'name'   => 'noembedmedia',
            'button' => 'noembedMedia',
            'url'    => DC_ADMIN_URL . 'index.php?pf=noembedMedia/cke-addon/'
        ];
    }
}
