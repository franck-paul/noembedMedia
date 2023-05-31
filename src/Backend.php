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

use dcCore;
use dcNsProcess;

class Backend extends dcNsProcess
{
    public static function init(): bool
    {
        static::$init = My::checkContext(My::BACKEND);

        // dead but useful code, in order to have translations
        __('noembed Media') . __('Insert external media from Internet via noembed.com');

        return static::$init;
    }

    public static function process(): bool
    {
        if (!static::$init) {
            return false;
        }

        dcCore::app()->addBehaviors([
            'adminPageHTTPHeaderCSP' => [BackendBehaviors::class, 'adminPageHTTPHeaderCSP'],
            'adminPostEditor'        => [BackendBehaviors::class, 'adminPostEditor'],
            'ckeditorExtraPlugins'   => [BackendBehaviors::class, 'ckeditorExtraPlugins'],
        ]);

        return true;
    }
}
