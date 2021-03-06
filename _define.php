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

if (!defined('DC_RC_PATH')) {return;}

$this->registerModule(
    "noembed Media",                                       // Name
    "Insert external media from Internet via noembed.com", // Description
    "Franck Paul and contributors",                        // Author
    '0.5',                                                 // Version
    [
        'requires'    => [['core', '2.16']],                            // Dependencies
        'permissions' => 'usage,contentadmin',                          // Permissions
        'type'        => 'plugin',                                      // Type
        'priority'    => 1002,                                          // Priority
        'support'     => 'https://github.com/franck-paul/noembedMedia' // Support URL
    ]
);
