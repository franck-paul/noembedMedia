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
            $data = [
                'title'    => __('External media'),
                'icon'     => urldecode(dcPage::getPF(My::id() . '/icon.svg')),
                'open_url' => dcCore::app()->adminurl->get('admin.plugin.' . My::id(), [
                    'popup' => 1,
                ], '&'),
            ];
            if (version_compare(preg_replace('/\-dev.*$/', '', DC_VERSION), '2.27', '<')) {
                $data['style'] = [  // List of styles used
                    'class'  => false,
                    'left'   => 'float: left; margin: 0 1em 1em 0;',
                    'center' => 'margin: 0 auto; display: table;',
                    'right'  => 'float: right; margin: 0 0 1em 1em;',
                ];
            } else {
                $data['style'] = [  // List of classes used
                    'class'  => true,
                    'left'   => 'media-left',
                    'center' => 'media-center',
                    'right'  => 'media-right',
                ];
            }
            $res = $res = dcPage::jsJson('dc_editor_noembedmedia', $data) .
            dcPage::jsModuleLoad(My::id() . '/js/post.js', dcCore::app()->getVersion(My::id()));
        } elseif ($editor == 'dcCKEditor') {
            $data = [
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
            ];
            if (version_compare(preg_replace('/\-dev.*$/', '', DC_VERSION), '2.27', '<')) {
                $data['style'] = [  // List of styles used
                    'class'  => false,
                    'left'   => 'float: left; margin: 0 1em 1em 0;',
                    'center' => 'margin: 0 auto; display: table;',
                    'right'  => 'float: right; margin: 0 0 1em 1em;',
                ];
            } else {
                $data['style'] = [  // List of classes used
                    'class'  => true,
                    'left'   => 'media-left',
                    'center' => 'media-center',
                    'right'  => 'media-right',
                ];
            }
            $res = dcPage::jsJson('ck_editor_noembedmedia', $data);
        }

        return $res;
    }

    public static function ckeditorExtraPlugins(ArrayObject $extraPlugins)
    {
        $extraPlugins[] = [
            'name'   => 'noembedmedia',
            'button' => 'noembedMedia',
            'url'    => urldecode(DC_ADMIN_URL . dcPage::getPF(My::id() . '/cke-addon/')),
        ];
    }
}
