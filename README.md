# 模試日程メーカー

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

[![Live Demo](https://img.shields.io/badge/Live-Demo-00C853?style=for-the-badge)](https://tsukuba42195.sakura.ne.jp/moshi/)


[![OGP](ogp.png)](https://tsukuba42195.sakura.ne.jp/moshi/)

河合塾・駿台・代々木ゼミナールなどの模試日程を、Googleカレンダー用のICSファイルとして一括出力できるWebツールです。

受験予定の回を選択するだけで、Google カレンダーに登録可能な `.ics` ファイルを自動生成します。

---

## 🌐 Demo

https://tsukuba42195.sakura.ne.jp/moshi/

---

## 📷 Screenshot

![Demo](demo.png)

---

## ✨ Features

- 河合塾・駿台・代ゼミの模試日程をまとめて管理
- 受験回を選ぶだけで `.ics` ファイルを自動生成
- Google カレンダーへワンクリックで登録可能
- 試験日だけでなく申込期間や成績公開日も登録可能
- スマートフォンでも快適に操作できるレスポンシブデザイン
- データベース不要、PHPのみで動作

---

## 📚 Supported Exams

### 河合塾
- 全統共通テスト模試
- 全統記述模試
- 東大入試オープン
- 京大入試オープン
- 名大入試オープン
...

### 駿台
- 駿台全国模試
- 駿台・ベネッセ共通テスト模試
...

### 代々木ゼミナール
- 東大入試プレ
- 京大入試プレ
...

---

## 🚀 How to Use

1. 試験種別を選択します。
2. 「受験回を選択してください」から希望する回を選択します。
3. 「Googleカレンダーへ追加」をクリックします。
4. ダウンロードされた `.ics` ファイルを開きます。
5. Google カレンダーへ予定を追加します。

---

## 🛠 Built With

* PHP
* Bootstrap 5
* Font Awesome
* iCalendar (.ics)

---

## 📂 Project Structure

| File                | Description  |
| ------------------- | ------------ |
| `index.php`         | メイン画面        |
| `generate.php`      | ICS ファイル生成処理 |
| `moshi_data.php` | 模試日程データ  |
| `demo.png`          | デモ画像         |
| `ogp.png`          | OGP画像         |
| `README.md`         | プロジェクト説明     |

---

## 💡 Motivation

模試の日程や申込期間を手動でGoogleカレンダーへ登録するのが面倒だったため、
ワンクリックで登録できるツールとして開発しました。

---

## 📄 License

MIT License

---

## 👨‍💻 Author

**向井 聡 (Akira Mukai)**

Blog
https://s0323861.github.io/

GitHub
https://github.com/s0323861

---

## ❤️ Support

If this project helped you, consider supporting its development.

☕ Buy me a coffee:
https://ko-fi.com/akiramukai

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/F1F3RMTFK)


