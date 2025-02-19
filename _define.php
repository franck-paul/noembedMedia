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
$this->registerModule(
    'noembed Media',
    'Insert external media from Internet via noembed.com',
    'Franck Paul and contributors',
    '4.3.1',
    [
        'requires'    => [['core', '2.28']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'priority'    => 1002,
        'settings'    => [
            'self' => false,
        ],

        'details'    => 'https://open-time.net/?q=noembedMedia',
        'support'    => 'https://github.com/franck-paul/noembedMedia',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/noembedMedia/main/dcstore.xml',
    ]
);
