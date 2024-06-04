## sailを使った環境構築について

### 前提
- Docker Desktopインストール済み

### 各バージョン
- PHP
    - 8.2
- Laravel Framework
    - 9.52.16
- MariaDB
    - 10.5.23

### 手順
1. `.env` の内容を書き換え
2. ターミナルで以下のコマンド実行
   
   ```
    # ビルド（Dockerイメージ作成）
    sail build --no-cache
    
    # sailコマンドが実行できなければターミナルで以下のコマンドを打つ
    alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
    
    # コンテナ起動
    sail up -d
    
    # Sail環境のPHPのバージョン確認
    sail php -v
    
    # DBマイグレーション
    sail artisan migrate

    ここまでやれば使える
    
    # コンテナ停止（作業終える時）
    sail down
    
    以下は参考程度のコマンド

    # mariadb接続
    sail exec mariadb mariadb -u user -p
    
    # DB操作コマンド
    show databases;
    use boocare;
    show tables;
    desc テーブル名;
   ```

### URL
- [http://localhost:8080](http://localhost:8080)
    - ローカルホスト接続
- [http://localhost:8888](http://localhost:888)
    - phpMyAdmin接続
