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

if (!defined('DC_CONTEXT_ADMIN')) {return;}

$m_object = $m_title = $m_url = null;
$m_url    = !empty($_POST['m_url']) ? $_POST['m_url'] : null;

?>
<html>
<head>
  <title><?php echo __('External media selector (via noembed.com)') ?></title>
  <?php echo dcPage::jsLoad(urldecode(dcPage::getPF('noembedMedia/js/popup.js')), $core->getVersion('noembedMedia')); ?>

</head>

<body>
<?php
echo '<h2>' . __('External media selector (via noembed.com)') . '</h2>';

if (!$m_url) {
    echo
    '<form action="' . $p_url . '&amp;popup=1" method="post">' .
    '<p>' . __('See <a href="https://noembed.com/#supported-sites">this site</a> for supported services') . '</p>' .
    '<p>' . __('Please enter the URL of the page containing the media you want to include in your post.') . '</p>' .
    '<p><label for="m_url">' . __('Page URL:') . '</label> ' .
    form::field('m_url', 50, 250, html::escapeHTML($m_url)) . '</p>' .

    '<p><input type="submit" value="' . __('ok') . '" />' .
    $core->formNonce() . '</p>' .
        '</form>';
} else {
    echo
        '<div style="margin: 1em auto; text-align: center;">' . $m_object . '</div>' .
        '<form id="media-insert-form" action="" method="get">';

    $i_align = [
        'none'   => [__('None'), 0],
        'left'   => [__('Left'), 0],
        'right'  => [__('Right'), 0],
        'center' => [__('Center'), 1]
    ];

    echo '<h3>' . __('Media alignment') . '</h3>';
    echo '<p>';
    foreach ($i_align as $k => $v) {
        echo '<label class="classic" for"alignement">' .
        form::radio(['alignment'], $k, $v[1]) . ' ' . $v[0] . '</label><br /> ';
    }
    echo '</p>';

    echo
    '<h3>' . __('Media title') . '</h3>' .
    '<p><label for="m_title">' . __('Title:') . ' ' .
    form::field('m_title', 50, 250, html::escapeHTML($m_title)) . '</label></p>';

    echo
    '<p><a id="media-insert-cancel" class="button" href="#">' . __('Cancel') . '</a> - ' .
    '<a id="media-insert-ok" class="button" href="#">' . __('Insert') . '</a>' .
    form::hidden('m_url', html::escapeHTML($m_url)) .
        '</form>';
}

?>
</body>
</html>
