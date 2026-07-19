=== Modern RSS Image Feed ===
Contributors: ivanlin
Tags: rss, feed, webp, avif, images
Requires at least: 5.0
Tested up to: 6.7.1
Stable tag: 1.2.0
Requires PHP: 7.0
License: Apache-2.0
License URI: http://www.apache.org/licenses/LICENSE-2.0

Add modern image formats support to WordPress RSS feeds with media:content tags.

== Description ==
Modern RSS Image Feed enhances your WordPress RSS feeds by adding support for modern image formats and proper media tags. 
It automatically includes media:content tags for your featured images and supports multiple formats including WebP and AVIF.

Key Features:
* Adds media:content tags to RSS feeds
* Supports modern image formats (WebP, AVIF)
* Includes iTunes podcast support
* Proper image sizing information
* Clean and lightweight implementation

This plugin is one of the origin projects of Omni Webmaster & SEO Suite, an all-in-one webmaster toolkit by the same author that consolidates and optimizes these standalone plugins: https://github.com/ivanusto/omni-webmaster-seo-suite

== Installation ==
1. Upload the plugin files to the `/wp-content/plugins/modern-rss-image-feed` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Your RSS feeds will automatically include enhanced image support

== Frequently Asked Questions ==
= Does this plugin modify my images? =
No, it only adds proper tags to your RSS feed for existing images.

= Will this work with my existing RSS feeds? =
Yes, it seamlessly integrates with existing WordPress RSS feeds.

= Does it support podcast feeds? =
Yes, it includes iTunes image tag support for podcast feeds.

== Changelog ==
= 1.2.0 =
* Code optimization: wrapped RSS image formats in media:group tags to prevent duplicate display in feed readers.
* Robust URL resolution: normalized HTTP/HTTPS protocols and cross-platform directory separators.
* Added default English and Traditional Chinese README files.

= 1.1.0 =
* Code optimization: removed redundant thumbnail checks
* Refactored WebP/AVIF output into a single loop (DRY)
* Improved modern format URL resolution using str_replace
* Added no-match guard in modern_rss_get_modern_image_url

= 1.0.0 =
* Initial release
* Support for WebP and AVIF formats
* Media namespace support
* iTunes tag support

== Upgrade Notice ==
= 1.0.0 =
Initial release with modern image format support.

== Usage ==
The plugin works automatically after activation. No configuration is needed.
To verify it's working, check your site's RSS feed (usually at yoursite.com/feed/).

== Support ==
For support questions or feature requests, please use the WordPress.org plugin support forums.

== Credits ==
Developed by Ivan Lin

= 繁體中文 =
Modern RSS Image Feed 透過添加現代圖片格式支援和適當的媒體標籤來增強您的 WordPress RSS feed。它會自動為您的特色圖片添加 media:content 標籤，並支援包括 WebP 和 AVIF 在內的多種格式。

主要功能：
* 在 RSS feed 中添加 media:content 標籤
* 支援現代圖片格式（WebP、AVIF）
* 包含 iTunes 播客支援
* 正確的圖片尺寸資訊
* 簡潔輕量的實作方式

= 繁體中文 =
1. 將外掛檔案上傳至 `/wp-content/plugins/modern-rss-image-feed` 目錄
2. 在 WordPress 的「外掛」選單中啟用本外掛
3. 您的 RSS feed 將自動包含增強的圖片支援

* 首次發布
* 支援 WebP 和 AVIF 格式
* 支援媒體命名空間
* 支援 iTunes 標籤

外掛啟用後會自動運作，無需額外設定。
要驗證是否正常運作，請查看您網站的 RSS feed（通常位於 yoursite.com/feed/）。

== Credits ==
開發者：Ivan Lin
