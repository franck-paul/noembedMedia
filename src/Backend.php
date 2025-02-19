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

use Dotclear\App;
use Dotclear\Core\Process;

class Backend extends Process
{
    public static function init(): bool
    {
        // dead but useful code, in order to have translations
        __('noembed Media');
        __('Insert external media from Internet via noembed.com');

        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            'adminPageHTTPHeaderCSP' => BackendBehaviors::adminPageHTTPHeaderCSP(...),
            'adminPostEditor'        => BackendBehaviors::adminPostEditor(...),
            'ckeditorExtraPlugins'   => BackendBehaviors::ckeditorExtraPlugins(...),
        ]);

        return true;
    }
}
