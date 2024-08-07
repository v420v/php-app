<?php

require_once('functions.php');

/*
    form (action="store.php" method="post") からきたリクエストを受け取り、
    keyがname, valueがcontent（今回の場合）の連想配列である$_POSTをcreateData関数に渡します。
    その後header関数を使い、index.phpへリダイレクトしています。
*/

createData($_POST);

header('Location: ./index.php');

