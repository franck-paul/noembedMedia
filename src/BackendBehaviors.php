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
declare(strict_types=1);

namespace Dotclear\Plugin\noembedMedia;

use ArrayObject;
use dcCore;
use dcPage;

class BackendBehaviors
{
    public static function adminPageHTTPHeaderCSP($csp)
    {
        if (!isset($csp['script-src'])) {
            $csp['script-src'] = '';
        }
        $csp['script-src'] .= ' ' . 'https://noembed.com';
    }

    public static function adminPostEditor($editor = '')
    {
        $res = '';
        if ($editor == 'dcLegacyEditor') {
            $res = $res = dcPage::jsJson('dc_editor_noembedmedia', ['title' => __('External media')]) .
            dcPage::jsModuleLoad(My::id() . '/js/post.js', dcCore::app()->getVersion(My::id()));
        } elseif ($editor == 'dcCKEditor') {
            $res = dcPage::jsJson('ck_editor_noembedmedia', [
                'title'        => __('External media'),
                'tab_url'      => __('URL'),
                'url'          => __('Page URL:'),
                'url_empty'    => __('URL cannot be empty.'),
                'tab_align'    => __('Alignment'),
                'align'        => __('Media alignment:'),
                'align_none'   => __('None'),
                'align_left'   => __('Left'),
                'align_right'  => __('Right'),
                'align_center' => __('Center'),
            ]);
        }

        return $res;
    }

    public static function ckeditorExtraPlugins(ArrayObject $extraPlugins)
    {
        $extraPlugins[] = [
            'name'   => 'noembedmedia',
            'button' => 'noembedMedia',
            'url'    => dcPage::getPF(My::id() . '/cke-addon/'), // DC_ADMIN_URL . 'index.php?pf=noembedMedia/cke-addon/',
        ];
    }
}
