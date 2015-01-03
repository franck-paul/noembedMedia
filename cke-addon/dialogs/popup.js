CKEDITOR.dialog.add('noembedMediaDialog', function(editor) {
	return {
		title: noembedmedia_title,
		minWidth: 400,
		minHeight: 150,
		contents: [
			{
				id: 'tab-url',
				label: noembedmedia_tab_url,
				elements: [{
					id: 'url',
					type: 'text',
					label: noembedmedia_url,
					validate: CKEDITOR.dialog.validate.notEmpty(noembedmedia_url_empty)
				}]
			},
			{
				id: 'tab-alignment',
				label: noembedmedia_tab_align,
				elements: [{
					type: 'radio',
					id: 'alignment',
					label: noembedmedia_align,
					items: [
						[ noembedmedia_align_none, 'none' ],
						[ noembedmedia_align_left, 'left' ],
						[ noembedmedia_align_right, 'right'],
						[ noembedmedia_align_center, 'center'] ],
					'default': 'none'
				}]
			}
		],
		onOk: function() {
			var dialog = this;
			var url = dialog.getValueOf('tab-url', 'url');
			var alignment = dialog.getValueOf('tab-alignment', 'alignment');

			$.getJSON('https://noembed.com/embed?url='+url+'&callback=?',
				  function(data) {
					  var div = editor.document.createElement('div');
					  var style = '';
					  div.setAttribute('class', 'external-media');
					  if (alignment == 'left') {
						  style = 'float: left; margin: 0 1em 1em 0;';
					  } else if (alignment == 'right') {
						  style = 'float: right; margin: 0 0 1em 1em;';
					  } else if (alignment == 'center') {
						  style = 'margin: 1em auto; text-align: center;';
					  }
					  if (style!='') {
						  div.setAttribute('style', style);
					  }

					  div.appendHtml(data.html);
					  editor.insertElement(div);
				  });
		}
	};
});
