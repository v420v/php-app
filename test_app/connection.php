<?php
require_once('config.php');

/* 
    connectPdo 関数は try ブロックの中でPDOインスタンスを生成し、そのインスタンスを返します。
    生成時にPDOExceptionが発生した場合、catchブロックにjumpし、エラーメッセージを出力します。
*/
// PDOExceptionはデータベースに接続できないやクエリ文が実行できない時などに発生する。
function connectPdo() {
    try {
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        /*
        PDOException は RuntimeException を extend して、
        RuntimeException は Exception を extend しているため、getMessage() メソッドを使うことができます。
        */
        echo $e->getMessage();
        exit();
    }
}

// dbh はデータベースハンドルの略

/*
    createTodoData 関数は、最初にconnectPdo 関数からPDOインスタンスを受け取り変数$dbhに格納します、
    引数で受け取った文字列を insert 処理の SQL文に入れ、変数$sqlに格納します、
    変数$sqlを$dbh->queryに渡し、SQL文を実行します。
*/
function createTodoData($todoText) {
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES ("' . $todoText . '")';
    $dbh->query($sql);
}

/*
    getAllRecords 関数は、最初にconnectPdo 関数からPDOインスタンスを受け取り変数$dbhに格納します、
    変数 $sql に todosから deleted_at　カラムがNULLのレコードをSELECTするSQL文を格納します、
    変数 $sql を $dbh->query に渡し、SQL文を実行します、
    $dbh->query メソッドの戻り値であるPDOStatementのfetchAllメソッドを使い、
    配列型でtodosのレコードを取得し、戻り値としてreturnしています。
*/
function getAllRecords() {
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL';
    return $dbh->query($sql)->fetchAll();
}

function updateTodoData($post) {
    $dbh = connectPdo();
    $sql = 'UPDATE todos SET content = "' . $post['content'] . '" WHERE id = ' . $post['id'];
    $dbh->query($sql);
}

function getTodoTextById($id) {
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = ' . $id;
    $data = $dbh->query($sql)->fetch();
    return $data['content'];
}

