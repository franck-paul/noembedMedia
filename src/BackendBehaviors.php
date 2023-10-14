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
use Dotclear\Core\Backend\Page;

class BackendBehaviors
{
    /**
     * @param      ArrayObject<string, string>   $csp    The content security policies
     *
     * @return     string
     */
    public static function adminPageHTTPHeaderCSP(ArrayObject $csp): string
    {
        if (!isset($csp['script-src'])) {
            $csp['script-src'] = '';
        }
        $csp['script-src'] .= ' ' . 'https://noembed.com';

        return '';
    }

    public static function adminPostEditor(string $editor = ''): string
    {
        $res = '';
        if ($editor == 'dcLegacyEditor') {
            $data = [
                'title'    => __('External media'),
                'icon'     => urldecode(Page::getPF(My::id() . '/icon.svg')),
                'open_url' => dcCore::app()->adminurl->get('admin.plugin.' . My::id(), [
                    'popup' => 1,
                ], '&'),
                'style' => [  // List of classes used
                    'class'  => true,
                    'left'   => 'media-left',
                    'center' => 'media-center',
                    'right'  => 'media-right',
                ],
            ];
            $res = $res = Page::jsJson('dc_editor_noembedmedia', $data) .
            My::jsLoad('post.js');
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
                'style'        => [  // List of classes used
                    'class'  => true,
                    'left'   => 'media-left',
                    'center' => 'media-center',
                    'right'  => 'media-right',
                ],
            ];
            $res = Page::jsJson('ck_editor_noembedmedia', $data);
        }

        return $res;
    }

    /**
     * @param      ArrayObject<int, array<string, string>>  $extraPlugins  The extra plugins
     *
     * @return     string
     */
    public static function ckeditorExtraPlugins(ArrayObject $extraPlugins): string
    {
        $extraPlugins->append([
            'name'   => 'noembedmedia',
            'button' => 'noembedMedia',
            'url'    => urldecode(DC_ADMIN_URL . Page::getPF(My::id() . '/cke-addon/')),
        ]);

        return '';
    }
}
