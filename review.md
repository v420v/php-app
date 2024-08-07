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

### `deleted_at`を現在時刻で更新すると一覧画面からToDoが非表示になる理由を説明してください。

### 今回のように実際のデータを削除せずに非表示にすることで削除されたように扱うことを〇〇削除というか。

### 実際にデータを削除することを〇〇削除というか。

### 前問のそれぞれの削除のメリット・デメリットについて説明してください。
