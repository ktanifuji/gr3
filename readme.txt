○URLの設定
・「.htaccess」ファイルの "RewriteBase /event/anotherbjc1" を適切に設定して下さい
・「index.php」ファイル11行目のURLを適切に設定して下さい

○パーミッションの設定（環境によるけど…）
・dbフォルダは777
・views/cache、views/templetes_cフォルダは770
・その他のphpファイルは基本755
・htmlや画像とかは604

○見た目変更
・views/templetes内のファイルを弄って下さい
	・detail.tpl : 作品詳細、インプレページ
	・error.tpl : エラーページ
	・index.tpl : 作品一覧ページ
	・registration.tpl : 作品登録ページ
	・revise.tpl : 作品情報修正ページ
	・thanks.tpl : 何かしらの処理を完了した時の表示ページ
	・adminフォルダ内 : 管理ページ群
・基本HTMLです
・見慣れない部分はプログラムの心得があれば大体察せると思います

○データベースの初期化
・dbフォルダ内のbms_info.sqlite3とimpressionX.splite3の全てを消せばOKです
・一覧ページにアクセスすれば初期状態に戻ります

