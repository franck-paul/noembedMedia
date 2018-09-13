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
            dcPage::jsLoad(urldecode(dcPage::getPF('noembedMedia/js/post.js')), $core->getVersion('noembedMedia')) .
            '<script type="text/javascript">' . "\n" .
            dcPage::jsVar('jsToolBar.prototype.elements.noembedmedia.title', __('External media (via noembed.com)')) .
                "</script>\n";

        } elseif ($editor == 'dcCKEditor') {

            $res =
            '<script type="text/javascript">' . "\n" .
            dcPage::jsVar('noembedmedia_title', __('External media (via noembed.com)')) .
            dcPage::jsVar('noembedmedia_tab_url', __('URL')) .
            dcPage::jsVar('noembedmedia_url', __('Page URL:')) .
            dcPage::jsVar('noembedmedia_url_empty', __('URL cannot be empty.')) .
            dcPage::jsVar('noembedmedia_tab_align', __('Alignment')) .
            dcPage::jsVar('noembedmedia_align', __('Media alignment:')) .
            dcPage::jsVar('noembedmedia_align_none', __('None')) .
            dcPage::jsVar('noembedmedia_align_left', __('Left')) .
            dcPage::jsVar('noembedmedia_align_right', __('Right')) .
            dcPage::jsVar('noembedmedia_align_center', __('Center')) .
                "</script>\n";

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
