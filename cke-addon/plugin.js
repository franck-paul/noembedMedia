/*global CKEDITOR, dotclear */
'use strict';

dotclear.ck_noembedmedia = dotclear.getData('ck_editor_noembedmedia');

(function () {
  CKEDITOR.plugins.add('noembedmedia', {
    requires: 'dialog',

    init: function (editor) {
      editor.addCommand('noembedMediaCommand', new CKEDITOR.dialogCommand('noembedMediaDialog'));

      CKEDITOR.dialog.add('noembedMediaDialog', this.path + 'dialogs/popup.js');

      editor.ui.addButton('noembedMedia', {
        label: dotclear.ck_noembedmedia.title,
        command: 'noembedMediaCommand',
        icon: this.path + 'icons/icon.png',
      });
    },
  });
})();
