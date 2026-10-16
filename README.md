# 手話単語学習アプリ

手話単語をクイズ形式で学習できるWebアプリケーションです。

## 主な機能

### 学習機能
- **4択クイズ**: イラストを見て、対応する手話単語を4択の中から選択します（ランダムに10問出題）
- **クイズの中断・再開**: 学習途中で中断しても、後から同じ問題の続きから再開できます
- **学習進捗**: これまでの学習状況（習得済み / 学習中 / 未学習）を確認できます
- **苦手単語一覧**: 直近で間違えた単語を一覧表示し、タップするとイラストを確認できます

### アカウント機能
- 新規登録・ログイン・ログアウト
- パスワード再設定（ログイン画面の「パスワードを忘れた方」から、メールで再設定リンクを送信）
- パスワード変更（現在のパスワード確認つき）
- 退会機能（パスワード再確認のうえアカウントとデータを削除）
- 一般ユーザー / 管理者の権限管理

### 管理者機能
- 単語（イラスト・意味・出典・クイズ選択肢）の登録、編集、削除
- 管理画面へのアクセスは管理者権限（role = admin）を持つユーザーのみ許可

### UI / アクセシビリティ
- ライトモード / ダークモードの切り替え（設定はブラウザに保存）
- ヘッダーは常にライトカラーで固定し、視認性を確保
- ボタンや見出しに色分け・太字化・境界線の強調を施し、可読性を向上
- バリデーションエラーメッセージの日本語化

## 技術構成

- **フレームワーク**: Laravel
- **フロントエンド**: Blade + Tailwind CSS（CDN版）
- **データベース**: MySQL 8.0
- **実行環境**: Docker（WSL2 + Docker Desktop）
- **Webサーバー**: nginx + PHP-FPM
- **DB管理**: phpMyAdmin
- **バージョン管理**: Git / GitHub

## テーブル構成（概要）

| テーブル | 内容 |
|---|---|
| `users` | ユーザー情報（role で一般/管理者を区別） |
| `signs` | 手話イラスト（画像パス・出典） |
| `sign_words` | イラストに対応する単語（意味） |
| `quiz_options` | クイズの選択肢 |
| `quiz_results` | クイズの回答結果 |
| `user_progress` | ユーザーごとの学習進捗 |
| `quiz_sessions` | 中断中のクイズの状態 |
| `password_reset_tokens` | パスワード再設定用トークン |

## 開発環境の構築

前提: Docker Desktop がインストールされ、起動していること（Windowsの場合は WSL2 上での利用を推奨）。

```bash
# 1. リポジトリを取得
git clone https://github.com/ivyc259005kaku/shuwa-tango-app.git
cd shuwa-tango-app

# 2. 環境設定ファイルを作成
cp .env.example .env

# 3. コンテナを起動
docker compose up -d

# 4. 依存パッケージのインストールとアプリケーションキーの生成
docker compose exec app composer install
docker compose exec app php artisan key:generate

# 5. テーブルの作成
docker compose exec app php artisan migrate

# 6. アップロード画像を表示するためのリンクを作成
docker compose exec app php artisan storage:link
```

`.env` のデータベース設定は、`docker-compose.yml` に合わせて次のようにします。

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=shuwa_tango
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

### アクセス先

| 用途 | URL |
|---|---|
| アプリ本体 | http://localhost:8000 |
| phpMyAdmin | http://localhost:8080 |

phpMyAdminのログイン情報（`root` / `root`）は、ローカル開発用の初期値です。公開環境では必ず変更してください。

### 管理者アカウント

管理者は新規登録画面からは作成できません。`users` テーブルの `role` を `admin` に設定したユーザーが管理者になります（phpMyAdmin や `php artisan tinker` で設定します）。

## 開発環境でのメール送信について

`.env` で `MAIL_MAILER=log` を設定しているため、パスワード再設定のメールは実際には送信されず、`storage/logs/laravel.log` に出力されます。再設定リンクは次のコマンドで取り出せます。

```bash
docker compose exec app grep -o "http://localhost:8000/reset-password[^ \"]*" storage/logs/laravel.log | tail -n 1
```

実際にメールを送信する場合は、`.env` の `MAIL_` で始まる設定を、利用するSMTPサービスの情報に変更してください。`.env` はGitHubにアップロードしないでください。

## データのバックアップ

```bash
docker compose exec db mysqldump -u root -proot shuwa_tango > backup.sql
```

`backup.sql` には個人情報が含まれるため、`.gitignore` に追加し、GitHubにはアップロードしないでください。

## 発表資料

成果発表で使用した資料は、リポジトリ直下の [手話単語学習アプリ_発表資料.pptx](./手話単語学習アプリ_発表資料.pptx) にあります。

## ライセンス

このプロジェクトはLaravelフレームワーク（[MITライセンス](https://opensource.org/licenses/MIT)）を利用しています。