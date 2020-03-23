/*global $ */
'use strict';

$(function() {
  $('#media-insert-cancel').on('click', function() {
    window.close();
  });

  $('#media-insert-ok').on('click', function() {
    const url = $('#media-insert-form').get(0).m_url.value;
    $.getJSON(`https://noembed.com/embed?url=${url}&callback=?`,
      function(data) {
        sendClose(data.html);
      });
  });
});

function sendClose(object) {

  const insert_form = $('#media-insert-form').get(0);
  if (insert_form == undefined) {
    return;
  }

  const tb = window.opener.the_toolbar;
  const data = tb.elements.noembedmedia.data;

  data.alignment = $('input[name="alignment"]:checked', insert_form).val();
  data.title = insert_form.m_title.value;
  data.url = insert_form.m_url.value;
  data.m_object = object;

  tb.elements.noembedmedia.fncall[tb.mode].call(tb);
  window.close();
}
