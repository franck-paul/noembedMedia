/*global $ */
'use strict';

window.addEventListener('load', () => {
  $('#media-insert-cancel').on('click', () => {
    window.close();
  });

  $('#media-insert-ok').on('click', () => {
    function sendClose(object) {
      const insert_form = $('#media-insert-form').get(0);
      if (insert_form == undefined) {
        return;
      }

      const tb = window.opener.the_toolbar;
      const { data } = tb.elements.noembedmedia;

      data.alignment = $('input[name="alignment"]:checked', insert_form).val();
      data.title = insert_form.m_title.value;
      data.url = insert_form.m_url.value;
      data.m_object = object;

      tb.elements.noembedmedia.fncall[tb.mode].call(tb);
      window.close();
    }

    const url = $('#media-insert-form').get(0).m_url.value;
    $.getJSON(`https://noembed.com/embed?url=${url}&callback=?`, (data) => {
      sendClose(data.html);
    }).fail((xhr) => {
      window.alert(`${dotclear.external_media.request_error + xhr.status} ${xhr.statusText}`);
    });
  });
});
