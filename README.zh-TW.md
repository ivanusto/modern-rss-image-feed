# Modern RSS Image Feed (現代 RSS 圖片訂閱源)

[English Version README](README.md)

透過 Media RSS (`<media:content>`) 標籤為 WordPress RSS 訂閱源提供現代圖片格式（WebP、AVIF）支援，並自動包裝於標準的 `<media:group>` 標籤中，以確保相容性並防止 RSS 閱讀器顯示重複的圖片。

![Version](https://img.shields.io/badge/version-1.1.0-blue) ![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b) ![PHP](https://img.shields.io/badge/PHP-7.0%2B-777bb4) ![License](https://img.shields.io/badge/license-Apache--2.0-green)

---

## 主要功能

- **Media RSS 圖片分組**：將原始圖片和現代格式版本（WebP、AVIF）包裝在 `<media:group>` 元素中，避免多數 RSS 閱讀器因為多種圖片格式而顯示重複的圖片。
- **自動現代格式偵測**：當伺服器上已存在對應的 WebP 或 AVIF 檔案時，自動產出對應的圖片標籤。
- **協定與跨平台相容**：自動化標準化傳輸協定（HTTP/HTTPS）與作業系統路徑分隔符（`/` 與 `\`），避免本機檔案偵測失敗。
- **iTunes 播客支援**：包含播客（Podcast）訂閱源適用的 `<itunes:image>` 標籤。
- **零配置**：只需啟用外掛，無需進行任何額外設定。

---

## 整合與相關專案

本外掛是 **Omni Webmaster & SEO Suite** 生態系統中的獨立組件。

如果您需要更完整的網站效能與 SEO 站長工具，推薦使用：
- **[Omni Webmaster & SEO Suite](https://github.com/ivanusto/omni-webmaster-seo-suite)** — 整合了進階 RSS 控制、HTML head 清理、Robots Meta 客製化、全面停用留言、選擇性縮圖停用與清理、Google 翻譯中文標題轉英文網址以及 Meta Pixel 追蹤的完整整合外掛。

生態系統中的其他獨立外掛：
- **[smart-file-renamer](https://github.com/ivanusto/smart-file-renamer)** — 圖片與檔案上傳時自動將變音符號及特殊字元轉換為乾淨的 SEO 友善檔名。

---

## 系統需求

- WordPress 5.0 或更高版本
- PHP 7.0 或更高版本

---

## 安裝步驟

1. 下載外掛檔案。
2. 將外掛資料夾上傳至 `/wp-content/plugins/modern-rss-image-feed` 目錄。
3. 在 WordPress 後台的 **外掛** 頁面啟用本外掛。
4. 前往 `您的網址/feed/` 檢查 RSS 輸出。

---

## 授權條款

本專案採用 Apache License 2.0 授權。詳細資訊請參閱 [LICENSE](LICENSE) 檔案或程式碼頂部說明。
