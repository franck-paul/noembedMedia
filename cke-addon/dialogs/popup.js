/*global $, CKEDITOR, dotclear */
'use strict';
CKEDITOR.dialog.add('noembedMediaDialog', (editor) => ({
  title: dotclear.ck_noembedmedia.title,
  minWidth: 400,
  minHeight: 150,
  contents: [
    {
      id: 'tab-url',
      label: dotclear.ck_noembedmedia.tab_url,
      elements: [
        {
          id: 'url',
          type: 'text',
          label: dotclear.ck_noembedmedia.url,
          validate: CKEDITOR.dialog.validate.notEmpty(dotclear.ck_noembedmedia.url_empty),
        },
      ],
    },
    {
      id: 'tab-alignment',
      label: dotclear.ck_noembedmedia.tab_align,
      elements: [
        {
          type: 'radio',
          id: 'alignment',
          label: dotclear.ck_noembedmedia.align,
          items: [
            [dotclear.ck_noembedmedia.align_none, 'none'],
            [dotclear.ck_noembedmedia.align_left, 'left'],
            [dotclear.ck_noembedmedia.align_right, 'right'],
            [dotclear.ck_noembedmedia.align_center, 'center'],
          ],
          default: 'none',
        },
      ],
    },
  ],
  onOk() {
    const url = this.getValueOf('tab-url', 'url');
    const alignment = this.getValueOf('tab-alignment', 'alignment');

    $.getJSON(`https://noembed.com/embed?url=${url}&callback=?`, (data) => {
      const div = editor.document.createElement('div');
      let style = '';
      let classes = 'external_media';
      if (dotclear.ck_noembedmedia.style.class) {
        if (alignment == 'left') {
          classes += ` ${dotclear.ck_noembedmedia.style.left}`;
        } else if (alignment == 'right') {
          classes += ` ${dotclear.ck_noembedmedia.style.right}`;
        } else if (alignment == 'center') {
          classes += ` ${dotclear.ck_noembedmedia.style.center}`;
        }
      } else if (alignment == 'left') {
        style = 'float: left; margin: 0 1em 1em 0;';
      } else if (alignment == 'right') {
        style = 'float: right; margin: 0 0 1em 1em;';
      } else if (alignment == 'center') {
        style = 'margin: 1em auto; text-align: center;';
      }
      div.setAttribute('class', classes);
      if (style != '') {
        div.setAttribute('style', style);
      }

      div.appendHtml(data.html);
      editor.insertElement(div);
    });
  },
}));
