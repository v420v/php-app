<?php

require_once('connection.php');
session_start();

function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function setToken() {
    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(16));
}

function checkToken($token) {
    if (empty($_SESSION['token']) || ($_SESSION['token'] !== $token)) {
        $_SESSION['err'] = '不正な操作です';
        redirectToPostedPage();
    }
}

function unsetError() {
    $_SESSION['err'] = '';
}

function redirectToPostedPage() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

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
    checkToken($post['token']);
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


