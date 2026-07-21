<?php
/*
Plugin Name: Modern RSS Image Feed
Description: Add modern image formats (WebP, AVIF) support to RSS feeds with fallbacks
Version: 1.2.1
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

    // Prefer the mime type derived from the actual file URL; the attachment
    // record may still say image/jpeg after an on-disk conversion to WebP/AVIF.
    $filetype  = wp_check_filetype($url);
    $mime_type = !empty($filetype['type']) ? $filetype['type'] : get_post_mime_type($thumbnail_id);

    $alternates = [];
    foreach (['webp', 'avif'] as $format) {
        $modern_url = modern_rss_get_modern_image_url($url, $format);
        if ($modern_url) {
            $alternates[$format] = $modern_url;
        }
    }

    // Only wrap in media:group when alternate formats exist. A group is what
    // prevents duplicate display of multiple formats, but it also hides the
    // image from consumers that only read direct children of <item>.
    $use_group = !empty($alternates);
    $indent    = $use_group ? "\t" : '';

    if ($use_group) {
        echo "<media:group>\n";
    }

    printf(
        "%s<media:content url='%s' type='%s' width='%s' height='%s' medium='image'>\n",
        $indent,
        esc_url($url),
        esc_attr($mime_type),
        esc_attr($width),
        esc_attr($height)
    );

    $alt_text = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
    if ($alt_text) {
        printf("%s\t<media:title type='plain'>%s</media:title>\n", $indent, esc_html($alt_text));
    }

    $attachment = get_post($thumbnail_id);
    if ($attachment && !empty($attachment->post_content)) {
        printf("%s\t<media:description type='plain'>%s</media:description>\n", $indent, esc_html($attachment->post_content));
    }

    printf("%s</media:content>\n", $indent);

    foreach ($alternates as $format => $modern_url) {
        printf(
            "%s<media:content url='%s' type='image/%s' width='%s' height='%s' medium='image' />\n",
            $indent,
            esc_url($modern_url),
            $format,
            esc_attr($width),
            esc_attr($height)
        );
    }

    if ($use_group) {
        echo "</media:group>\n";
    }
    echo "\n";

    printf(
        "<media:thumbnail url='%s' width='%s' height='%s' />\n\n",
        esc_url($url),
        esc_attr($width),
        esc_attr($height)
    );

    printf("<itunes:image href='%s' />\n\n", esc_url($url));
}

function modern_rss_get_modern_image_url($original_url, $format) {
    $upload_dir = wp_upload_dir();
    if (empty($upload_dir['basedir']) || empty($upload_dir['baseurl'])) {
        return false;
    }

    // Normalize protocols (http/https) to avoid mismatch lookup issues
    $baseurl_normalized = preg_replace('/^https?:/', '', $upload_dir['baseurl']);
    $url_normalized     = preg_replace('/^https?:/', '', $original_url);

    // Normalize directory separators for local filesystem lookup
    $basedir_normalized = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $upload_dir['basedir']);
    
    // Replace URL base path with local absolute directory path
    $file_path = str_replace($baseurl_normalized, $basedir_normalized, $url_normalized);
    $file_path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $file_path);

    // Replace extension
    $modern_path = preg_replace('/\.(jpg|jpeg|png)$/i', ".$format", $file_path);

    if ($modern_path === $file_path || !file_exists($modern_path)) {
        return false;
    }

    // Map local path back to base URL
    $relative_path = str_replace($basedir_normalized, '', $modern_path);
    $relative_path = str_replace('\\', '/', $relative_path); // ensure URL format uses forward slashes
    
    return rtrim($upload_dir['baseurl'], '/') . '/' . ltrim($relative_path, '/');
}

