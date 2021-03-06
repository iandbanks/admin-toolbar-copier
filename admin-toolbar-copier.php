<?php
/**
 * Plugin Name: Admin Toolbar Copier
 * Description: Sometimes you need to quickly copy things straight from the WordPress Admin bar. This plugin lets you do that. Things include, Post Ids, Post Type, URL...
 * Author: Ian Banks
 * Version: 1.0.2
 */

$atc_meta = get_plugin_data(__FILE__);

define('ATC_PATH', plugin_dir_path(__FILE__));
define('ATC_URL', plugin_dir_url(__FILE__));
define('ATC_VERSION', $atc_meta['Version']);

if (!is_admin()) {
    add_action('admin_bar_menu', 'add_toolbar_post_id', 100000);
    add_action('wp_footer', 'secret_copier_text_field', 100000);
    add_action('wp_enqueue_scripts', 'admin_toolbar_copier_enqueue', 100);
}

/**
 * @since 1.0
 */
function admin_toolbar_copier_enqueue()
{
    wp_enqueue_script('admin-toolbar-copier', ATC_URL . 'js/admin-toolbar-copier.js', [], ATC_VERSION, true);
    wp_enqueue_style('admin-toolbar-copier', ATC_URL . 'css/admin-toolbar-copier.css', [], ATC_VERSION);
}

/**
 * @param $admin_bar
 * @since 1.0
 */
function add_toolbar_post_id($admin_bar)
{
    $admin_bar->add_menu([
        'id' => 'post-id',
        'title' => 'Copy ID: #' . get_the_ID(),
        'href' => '#',
        'meta' => [
            'title' => get_the_ID(),
            'data-id' => get_the_ID(),
            'onclick' => ''
        ]
    ]);
}

/**
 * @since 1.0
 */
function secret_copier_text_field()
{
    ?>
    <div class="admin-toolbar-copier hidden-text-area">
        <textarea name="" id="admin-toolbar-copier" cols="30" rows="10"></textarea>
    </div>
    <?php
}