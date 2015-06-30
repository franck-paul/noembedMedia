<?php
# -- BEGIN LICENSE BLOCK ----------------------------------
# This file is part of noembedMedia, a plugin for Dotclear 2.
#
# Copyright (c) Franck Paul and contributors
#
# Licensed under the GPL version 2.0 license.
# A copy of this license is available in LICENSE file or at
# http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
# -- END LICENSE BLOCK ------------------------------------

if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"noembed Media",
	/* Description*/		"Insert external media from Internet via noembed.com",
	/* Author */			"Franck Paul and contributors",
	/* Version */			'0.3',
	array(
		/* Permissions */	'permissions' =>	'usage,contentadmin',
		/* Type */			'type' =>			'plugin',
		/* Priority */		'priority' => 		1002
	)
);
