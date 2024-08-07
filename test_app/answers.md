

## require_once()は何のために記述しているか説明してください。
 - ファイルを一度だけインポートするために書かれています。

## connectPdo() の返り値は何か、またこの記述は何をするための記述か説明してください。
 - connectPdo()の戻り値はPDOのインスタンスまたはnullです。
 - DSN, DB_USER, DB_PASSWORDを使いPDOインスタンスを生成し、戻り値として返す。PDOExceptionが起こった場合はエラーメッセージが表示されexitされる。

## try catchとは何か説明してください。
 - 例外処理をするための構文。try ブロック内で起こったExceptionをcatchでキャッチ例外処理を走らせる。

## PDOクラスをインスタンス化する際にtry catchが必要な理由を説明してください。
 - PDO がインスタンスを生成する際にデータベースとの接続に失敗した場合、PDOExceptionが起こるからです。


# 復習問題

## データの受け取り・受け渡しの処理を記述するのはどのファイルでしたか？
① functions.php     ② connection.php     ③ config.php     ④ store.php

 - ①

## DB操作処理を記述するのはどのファイルでしたか？
① functions.php     ② connection.php     ③ config.php     ④ store.php

 - ②

## アプリケーションの設定を記述するのはどのファイルでしたか？
① functions.php     ② connection.php     ③ config.php     ④ store.php

 - ③

## 以下のフォームの送信ボタンを押下した際にstore.phpの$_POSTにどんな値が格納されますか？
 - keyがname, valueがcontentの連想配列が格納されてる。

## header('location: ./index.html')は何をしているか説明してください。
 - ./index.htmlへリダイレクトする処理。


## ------------------------------------------------

connection.phpで定義した変数$dbhの中には何を格納したでしょうか？
① PDO文字列     ② PDOクラス     ③ PDO配列     ④ PDOインスタンス

 - ④

## <?= $var; ?>は以下の選択肢のうち、どの処理の省略形ですか？
① <php>$var</php>     ② <?php echo $var; ?>     ③ <?php var_dump($var) ?>     ④ <?php $var; ?>

 - ②

## 一覧ページにTODOを表示するために今回行ったこととして間違っている選択肢はどれですか？
① 一覧取得の関数が使えるように、index.phpでrequire_onceを使ってfunctions.phpを読み込んだ。
② indexページでPHPが使えるようにファイルの拡張子を変更した。
③ SELECT文でDBからデータを取得した。
④ echoはPHPとHTMLが混在しているときは使えないので短縮表現を使った。

 - ④

## queryメソッドの返り値のデータ型は以下の選択肢のうちどれでしょうか？
① PDOインスタンス     ② 連想配列     ③ PDOStatementインスタンス     ④ 文字列

 - ③

## getTodoList()の返り値について説明してください。
 - getTodoList()はgetAllRecords()をreturnしているので、getAllRecords()の戻り値であるtodoが入った配列を返しています。



# PHP APP Update Page

## parse_url関数の返り値のデータ型は以下の選択肢のうちどれでしょうか？
① 連想配列     ② 文字列     ③ Urlオブジェクト     ④ PDOインスタンス
 - ①

## 遷移先にGETでデータを送るときにURLに付与する?以下をなんと言いますか？
① クエリビルダ     ② クエリパラメータ     ③ クエリアンカー     ④ クエリゲット
 - ②

## $_GETや$_SERVERのように、$_で始まる特殊な変数のことをなんと呼びますか？
① インスタンス変数     ② ハイパーテキスト変数     ③ スーパーグローバル変数     ④ スタンダードPHP変数
 - ③

## 以下のaタグのリンクを押下した際にedit.phpの$_GETにどんな値が格納されるか説明してください。

```<a href="edit.php?todo_id=123&todo_content=焼肉">更新</a>```

 - todo_id => 123, todo_content => "焼肉" の連想配列が格納されます。

## savePostedData($post)は何をしているか説明してください。
 - $_POSTされたデータを受け取り、getRefererPath()から返されたパスを元に条件分岐し、connection層(DB層)へpostされたデータを渡しています。

## getRefererPath()は何をしているか説明してください。
-  スーパーグローバル変数である $_SERVER の key 'HTTP_REFERER' の valueを parse_urlに引数として渡します。parse_urlからreturnされた「URLの様々な構成要素のうち特定できるものが入った連想配列」のkeyが'path' の value を return しています。

