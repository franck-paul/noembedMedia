/*global jsToolBar */
'use strict';

jsToolBar.prototype.elements.noembedmedia = {
  type: 'button',
  title: 'External Media (via noembed.com)',
  icon: 'index.php?pf=noembedMedia/bt_video.png',
  fn: {},
  fncall: {},
  open_url: 'plugin.php?p=noembedMedia&popup=1',
  data: {},
  popup: function() {
    window.the_toolbar = this;
    this.elements.noembedmedia.data = {};

    window.open(this.elements.noembedmedia.open_url, 'dc_popup',
      'alwaysRaised=yes,dependent=yes,toolbar=yes,height=500,width=760,' +
      'menubar=no,resizable=yes,scrollbars=yes,status=no');
  },
  gethtml: function() {
    var d = this.data;

    if (d.m_object == '') {
      return false;
    }

    var res = '<div class="external-media"';

    if (d.alignment == 'left') {
      res += ' style="float: left; margin: 0 1em 1em 0;"';
    } else if (d.alignment == 'right') {
      res += ' style="float: right; margin: 0 0 1em 1em;"';
    } else if (d.alignment == 'center') {
      res += ' style="margin: 1em auto; text-align: center;"';
    }

    res += '>\n' + d.m_object;

    if (d.title) {
      if (d.url) {
        d.title = '<a href="' + d.url + '">' + d.title + '</a>';
      }
      res += '\n<br />' + d.title;
    }

    res += '\n</div>';
    return res;
  }
};

jsToolBar.prototype.elements.noembedmedia.fn.wiki = function() {
  this.elements.noembedmedia.popup.call(this);
};
jsToolBar.prototype.elements.noembedmedia.fn.xhtml = function() {
  this.elements.noembedmedia.popup.call(this);
};
jsToolBar.prototype.elements.noembedmedia.fn.markdown = function() {
  this.elements.noembedmedia.popup.call(this);
};

jsToolBar.prototype.elements.noembedmedia.fncall.wiki = function() {
  var html = this.elements.noembedmedia.gethtml();

  this.encloseSelection('', '', function() {
    return '\n///html\n' + html + '\n///\n';
  });
};
jsToolBar.prototype.elements.noembedmedia.fncall.xhtml = function() {
  var html = this.elements.noembedmedia.gethtml();

  this.encloseSelection('', '', function() {
    return html;
  });
};
jsToolBar.prototype.elements.noembedmedia.fncall.markdown = function() {
  var html = this.elements.noembedmedia.gethtml();

  this.encloseSelection('', '', function() {
    return html;
  });
};
