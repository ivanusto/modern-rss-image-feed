<?php
/*
Plugin Name: Modern RSS Image Feed
Description: Add modern image formats (WebP, AVIF) support to RSS feeds with fallbacks
Version: 1.1.0
Author: Ivan Lin
License: Apache-2.0
*/

defined('ABSPATH') || exit;

add_action('rss2_ns', 'modern_rss_add_namespaces');
function modern_rss_add_namespaces() {
    echo 'xmlns:media="http://search.yahoo.com/mrss/" ';
    echo 'xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" ';
}

add_action('rss_item', 'modern_rss_add_image_meta', 5);
add_action('rss2_item', 'modern_rss_add_image_meta', 5);

function modern_rss_add_image_meta() {
    global $post;

    $thumbnail_id = get_post_thumbnail_id($post->ID);
    if (!$thumbnail_id) {
        return;
    }

    $image_full = wp_get_attachment_image_src($thumbnail_id, 'full');
    if (!$image_full) {
        return;
    }

    [$url, $width, $height] = $image_full;

    printf(
        "<media:content url='%s' type='%s' width='%s' height='%s' medium='image'>\n",
        esc_url($url),
        esc_attr(get_post_mime_type($thumbnail_id)),
        esc_attr($width),
        esc_attr($height)
    );

    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    if ($alt_text) {
        printf("<media:title type='plain'>%s</media:title>\n", esc_html($alt_text));
    }

    $attachment = get_post($thumbnail_id);
    if ($attachment && !empty($attachment->post_content)) {
        printf("<media:description type='plain'>%s</media:description>\n", esc_html($attachment->post_content));
    }

    echo "</media:content>\n\n";

    printf("<itunes:image href='%s' />\n\n", esc_url($url));

    foreach (['webp', 'avif'] as $format) {
        $modern_url = modern_rss_get_modern_image_url($url, $format);
        if ($modern_url) {
            printf(
                "<media:content url='%s' type='image/%s' width='%s' height='%s' medium='image' />\n\n",
                esc_url($modern_url),
                $format,
                esc_attr($width),
                esc_attr($height)
            );
        }
    }
}

function modern_rss_get_modern_image_url($original_url, $format) {
    $upload_dir = wp_upload_dir();
    $file_path  = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $original_url);
    $modern_path = preg_replace('/\.(jpg|jpeg|png)$/i', ".$format", $file_path);

    if ($modern_path === $file_path || !file_exists($modern_path)) {
        return false;
    }

    return str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $modern_path);
}
