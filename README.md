# repo_public
Public repository

ある会社のコーディングテストで制作した簡易的なブログアプリです。
環境はDockerのredhat PHP ubiイメージと、postgresqlイメージを利用してdocker-composeで構築しました。

### 1. コンテナ作成
> docker-compose up -d --build

### 2. コンテナ内部に入り、以下のコマンドを実行
> docker exec -it cording-test-ap bash  
$ php artisan migrate:fresh  
$ php artisan key:generate  
$ php artisan ui bootstrap --auth -n  
$ npm install && npm run dev

### 3. Registerからユーザを作成して頂ければ、確認できます。