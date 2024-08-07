<?php

require_once('connection.php');

/*
    createData 関数は引数で受け取った連想型配列のcontent keyのvalueをcreateTodoData関数に渡してます。
*/
function createData($post) {
    createTodoData($post['content']);
}

/*
    getTodoList 関数は、getAllRecords 関数を呼び出し、その戻り値である配列型のtodosレコードを返しています。
*/
function getTodoList() {
    return getAllRecords();
}


