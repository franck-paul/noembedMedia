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

if (!defined('DC_CONTEXT_ADMIN')) { return; }

// dead but useful code, in order to have translations
__('noembed Media').__('Insert external media from Internet via noembed.com');

$core->addBehavior('adminPostEditor',array('noembedMediaBehaviors','adminPostEditor'));

class noembedMediaBehaviors
{
	public static function adminPostEditor($editor='',$context='')
	{
		if ($editor != 'dcLegacyEditor') return;

		$res = '<script type="text/javascript" src="index.php?pf=noembedMedia/js/post.js"></script>'.
			'<script type="text/javascript">'."\n"."//<![CDATA[\n".
			dcPage::jsVar('jsToolBar.prototype.elements.noembedmedia.title',__('External media (via noembed.com)')).
			"\n//]]>\n"."</script>\n";

		return $res;
	}
}
