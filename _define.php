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
    '5.0.1',
    [
        'date'        => '2025-09-09T21:05:06+0200',
        'requires'    => [['core', '2.36']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'priority'    => 1010,  // Must be higher than dcLegacyEditor/dcCKEditor priority (ie 1000)
        'settings'    => [
            'self' => false,
        ],

        'details'    => 'https://open-time.net/?q=noembedMedia',
        'support'    => 'https://github.com/franck-paul/noembedMedia',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/noembedMedia/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
