<?php

declare(strict_types=1);
require_once('connection.php');

/*
    getTodoList 関数は、getAllRecords 関数を呼び出し、その戻り値である配列型のtodosレコードを返しています。
*/
function getTodoList(): array {
    return getAllRecords();
}

function getSelectedTodo($id) {
    return getTodoTextById($id);
}

function savePostedData($post) {
    $path = getRefererPath();
    switch ($path) {
        case '/new.php':
            createTodoData($post['content']);
            break;
        case '/edit.php':
            updateTodoData($post);
            break;
        case '/index.php':
            deleteTodoData($post['id']);
            break;
        default:
            break;
    }
}

function getRefererPath()
{
    $urlArray = parse_url($_SERVER['HTTP_REFERER']);
    return $urlArray['path'];
}


