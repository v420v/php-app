# PHP App ① レビュー

## 全般

### 以下のaタグのリンクを押下した際にedit.phpの$_GETにどんな値が格納されるか説明してください。
 - todo_id => 123, todo_content => "焼肉" の連想配列。
```html
<a href="edit.php?todo_id=123&todo_content=焼肉">更新</a>
```

### 以下のフォームの送信ボタンを押下した際にstore.phpの$_POSTにどんな値が格納されるか説明してください。
 -  id => 123, content => "焼肉" の連想配列。
```html
<form action="store.php" method="post">
    <input type="text" name="id" value="123">
		<textarea　name="content">焼肉</textarea>
    <button type="submit">送信</button>
</form>
```

### `require_once()` は何のために記述しているか説明してください。
 - 一度だけファイルをインポートするために記述されている。　

### `savePostedData($post)`は何をしているか説明してください。
 - savePostedDataが見つかりませんでした。

### `header('location: ./index.php')`は何をしているか説明してください。
 - ./index.phpへリダイレクトされます。

### `getRefererPath()`は何をしているか説明してください。
 -  スーパーグローバル変数である $_SERVER の key 'HTTP_REFERER' の valueを parse_urlに引数として渡します。parse_urlからreturnされた「URLの様々な構成要素のうち特定できるものが入った連想配列」のkeyが'path' の value を return しています。


### `connectPdo()` の返り値は何か、またこの記述は何をするための記述か説明してください。
 - connectPdo()関数の戻り値はPDOのインスタンスです。PHPとデータベースサーバーの接続し、connectPdo()関数の戻り値であるPDOのインスタンスを取得するためのコードです。

### `try catch`とは何か説明してください。
 - エラーハンドリングの一つで try ブロック内でthrowされたExceptionをcatchでキャッチしエラーハンドリングができます。

### Pdoクラスをインスタンス化する際に`try catch`が必要な理由を説明してください。
 - PDOインスタンス生成時にデータベースサーバーの接続に失敗した場合PDOExceptionがthrowされるからです。

## 新規作成

### `createTodoData($post)`は何をしているか説明してください。
 - todo の content を引数で受け取り、connectPdoでデータベースに接続し、文字列結合で引数で受け取ったcontentをsqlに埋め込み、PDOインスタンスのメソッドであるquery()に引数としてsql文を渡してメソッドを走らせてます。
 

## 一覧

### `getTodoList()`の返り値について説明してください。
 - getTodoList()はgetAllRecords()の戻り値であるtodoが入った配列を返しています。

### `<?= ?>`は何の省略形か説明してください。
 - `<?php echo ?>` の省略形です。

## 更新

### `getSelectedTodo($_GET['id'])`の返り値は何か、またなぜ`$_GET['id']` を引数に渡すのか説明してください。
 - getSelectedTodo()の戻り値は、引数で渡したidに紐付いてるtodoのcontentです。
 - connection層でselect文を使う際にidを絞ってtodoを取得しているので`getSelectedTodo($_GET['id'])`でgetメソッドで送られた連想配列のkeyがidのvalueを渡します。

### `updateTodoData($post)`は何をしているか説明してください。
 -　updateするのに必要なtodoのidとcontentが入った連想配列を引数で受け取ります。
    connectPdo() でDBに接続し、PDOインスタンスをdbh変数に格納します。
    引数で受け取ったデータをsql文に埋め込み、変数sqlに格納します。
    最後にPDOインスタンスのメソッドであるqueryでsqlを実行しています。

## 削除

### `deleteTodoData($id)`は何をしているか説明してください。
 - 論理削除するtodoの$idを引数で受け取り、
　　connectPdo()を実行し、PDOインスタンスをdbh変数に格納します。
　　変数 $now にdate関数を用いて現在の日付と時刻をフォーマットしたものを格納します。
　　UPDATE文で渡されたIDをもとにdeleted_atカラムを現在の時刻にupdateするSQLに現在時刻が格納されている$now変数とidが格納されている$id変数を結合し、変数sqlに格納します。
   最後に$dbh変数を使い、PDOインスタンスのメソッドであるqueryにsqlを渡し、sqlを実行しています。


### `deleted_at`を現在時刻で更新すると一覧画面からToDoが非表示になる理由を説明してください。
 - todoをselect文で取得取得する際にWHEREを使い deleted_at is NULL で取得しているので論理削除が実現されています。

### 今回のように実際のデータを削除せずに非表示にすることで削除されたように扱うことを〇〇削除というか。
 - 論理削除

### 実際にデータを削除することを〇〇削除というか。
 - 物理削除

### 前問のそれぞれの削除のメリット・デメリットについて説明してください。
 - 論理削除のメリットはいつ何が削除されたのかを後から確認することができることです。
 - 論理削除のデメリットはレコードが増え続けることで、それに合わせてテーブルを設計しないといけない点です。

 - 物理削除のメリットはsqlのwhereの検索が少し軽くなる点です。deleted_at IS NULL がなくなるので少し取得が早くなるかもしれません。
 - 物理削除のデメリットは削除されたらそれ以降そのレコードを確認できないことです。　



# PHP セクリティアプリのレビューチェックリスト

## なぜXSS対策しないといけないのでしょう？しなかった場合どういう攻撃を受けてしまうのか。
 - XSSの対策を行わないとユーザーが送信したcontentなどをそのまま表示することになるので、<スクリプト>などがある場合実行されてしまいます。

## htmlspecialchars関数 は具体的に何をどのような形に変換して返すのでしょうか？
 - `<` や `>`... などの特殊文字を HTML エンティティに変換して返す関数です。

## SESSIONとcookieの違いを説明できますか？
 - sessionはサーバー側管理する一時的な情報でcookieはブラウザで管理で管理する情報です。

## setToken関数 の処理内容を説明できますか？
 - スーパーグローバル変数である`_SESSION`のキー'token'にbin2hexから返されたopenssl_random_pseudo_bytesを引数で使ったtokenを格納しています。

## checkToken関数 の引数で渡される$tokenと、$_SESSION['token']の違いを説明できますか？
 - `$_SESSION['token']`はサーバー側で生成したトークンで`$token`はユーザーのリクエスト（フォーム）から受け取ったcsrf tokenです。

## unsetError関数 を使用しないとどうなりますか？
 - new.php の `unsetError();` を実行しなかった場合、一度バリデーションエラーに引っかかった後に入力に成功してもindex.phpへ遷移された後もエラーメッセージが表示されます。

## :todoText は何をしているのでしょうか？
 - あとでバインドする値が入るためのパラメータです。

## 対策してない時の挙動と、対策済みの挙動の違いを説明できますか？
 - プレースホルダを使ってバインドすると、値がクエリとして解釈されないのでSQLインジェクションを防ぐことができます。対策せずに、文字列結合でSQL文を組み立て、値にクエリが含まれてるとそのSQLが実行時に実行されてしまいます。


