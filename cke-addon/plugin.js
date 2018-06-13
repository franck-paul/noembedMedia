/*global CKEDITOR, noembedmedia_title */
'use strict';
CKEDITOR.plugins.add('noembedmedia', {
	requires:"dialog",

	init: function(editor) {
		editor.addCommand('noembedMediaCommand', new CKEDITOR.dialogCommand('noembedMediaDialog'));

		CKEDITOR.dialog.add('noembedMediaDialog', this.path+'dialogs/popup.js');

		editor.ui.addButton("noembedMedia", {
			label: noembedmedia_title,
			command: 'noembedMediaCommand',
			icon: this.path+'icons/icon.png'
		});
	}
});
