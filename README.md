# 模試日程メーカー

![PHP](https://img.shields.io/badge/PHP-8.x-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![License](https://img.shields.io/badge/License-MIT-green)

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

* 河合塾・駿台・代ゼミの模試に対応
* 試験種別ごとの絞り込み表示
* Google カレンダー登録用の ICS ファイルを自動生成
* 試験日だけでなく申込開始日・申込締切日・スコア発表日も登録可能
* スマートフォン対応
* シンプルで分かりやすい UI
* PHP のみで動作し、データベース不要

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
| `README.md`         | プロジェクト説明     |

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
