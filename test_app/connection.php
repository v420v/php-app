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
    $todoTextをsql文に埋め込むためにプレースホルダーを含むsql文を変数$sqlに格納します。
    変数$sqlをPDOインスタンスのメソッドであるprepare()に渡し、sql文を実行する準備を行います。
    prepare から返されたPDOStatementのメソッドであるbindValueを実行し値をSQL文のパラメータにバインドします。
    最後にPDOstatementのメソッドであるexecuteを実行しSQL文を実行します。
*/
function createTodoData($todoText) {
    $dbh = connectPdo();
    $sql = 'INSERT INTO todos (content) VALUES (:todoText)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':todoText', $todoText, PDO::PARAM_STR);
    $stmt->execute();
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
    $sql = 'UPDATE todos SET content = :todoText WHERE id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':todoText', $post['content'], PDO::PARAM_STR);
    $stmt->bindValue(':id', (int) $post['id'], PDO::PARAM_INT);
    $stmt->execute();
}

function getTodoTextById($id) {
    $dbh = connectPdo();
    $sql = 'SELECT * FROM todos WHERE deleted_at IS NULL AND id = :id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetch();
    return $data['content'];
}

function deleteTodoData($id)
{
    $dbh = connectPdo();
    date_default_timezone_set ('Asia/Tokyo');
    $now = date('Y-m-d H:i:s');
    $sql = 'UPDATE todos SET deleted_at = :now where id = :id;';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':now', $now, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

