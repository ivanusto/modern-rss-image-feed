# Modern RSS Image Feed

[繁體中文說明](README.zh-TW.md)

Add modern image formats (WebP, AVIF) support to WordPress RSS feeds using Media RSS (`<media:content>`) tags, automatically wrapped in standard `<media:group>` tags to ensure compatibility and prevent duplicate image display in feed readers.

![Version](https://img.shields.io/badge/version-1.1.0-blue) ![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b) ![PHP](https://img.shields.io/badge/PHP-7.0%2B-777bb4) ![License](https://img.shields.io/badge/license-Apache--2.0-green)

---

## Key Features

- **Media RSS Grouping**: Wraps original and modern image versions inside a `<media:group>` element to comply with the Media RSS specification.
- **Modern Format Detection**: Scans and adds WebP and AVIF image formats automatically if they exist on the server.
- **Protocol & OS Resilient**: Normalizes protocols (HTTP/HTTPS) and cross-platform directory paths (`/` vs `\`) for reliable file lookup.
- **iTunes Podcast Support**: Includes podcast feed compatibility using the `<itunes:image>` tag.
- **Zero Configuration**: Simply activate the plugin, and it works out of the box.

---

## Ecosystem & Related Projects

This plugin is a standalone companion in the **Omni Webmaster & SEO Suite** ecosystem. 

If you are looking for an all-in-one performance and SEO toolkit, consider using:
- **[Omni Webmaster & SEO Suite](https://github.com/ivanusto/omni-webmaster-seo-suite)** — A comprehensive suite that consolidates advanced RSS controls, HTML head cleanup, robots customization, comment disabling, selective thumbnail pruning, Google Translate URL slug conversion, and Meta Pixel tracking into a single unified settings panel.

Other standalone modules in the ecosystem:
- **[smart-file-renamer](https://github.com/ivanusto/smart-file-renamer)** — Automatically rename uploaded files containing accents and special characters into clean, SEO-friendly names.

---

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher

---

## Installation

1. Download the plugin files.
2. Upload the plugin folder to the `/wp-content/plugins/modern-rss-image-feed` directory.
3. Activate the plugin through the **Plugins** menu in WordPress.
4. Verify your RSS feed output at `yoursite.com/feed/`.

---

## License

This project is licensed under the Apache License 2.0. See the [LICENSE](LICENSE) file or the header comments for details.
