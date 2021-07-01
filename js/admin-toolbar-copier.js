jQuery(function ($) {
    let post_id_link = $('#wp-admin-bar-post-id .ab-item');
    let post_id = post_id_link.attr('title');
    console.log(post_id);

    let textArea = $('.admin-toolbar-copier textarea');
    textArea.text(post_id);

    post_id_link.on('click', function (e) {
        e.preventDefault();

        textArea.select();
        document.execCommand('copy');
        alert(post_id + ' copied');
    });
});