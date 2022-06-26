<?php
//1. POSTデータ取得
$book   = $_POST["book"];
$url  = $_POST["url"];
$comment = $_POST["comment"];
//追加されています

//*** 外部ファイルを読み込む ***
include("funcs.php");
$pdo = db_conn();

//2. DB接続します
//*** function化を使う！  ***
// try {
//     $db_name = "gs_db3";    //データベース名
//     $db_id   = "root";      //アカウント名
//     $db_pw   = "";      //パスワード：XAMPPはパスワード無しに修正してください。
//     $db_host = "localhost"; //DBホスト
//     $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
// } catch (PDOException $e) {
//     exit('DB Connection Error:'.$e->getMessage());
// }


//３．データ登録SQL作成
$stmt = $pdo->prepare("insert into gs_bm_table(book, url, comment, datetime ) VALUES (:book, :url, :comment, sysdate())");
$stmt->bindValue(':book', $book, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)　文字の場合はSTR 数字の場合はINT
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    //*** function化を使う！*****************
    sql_error($stml);

}else{
    redirect("index.php");
    //*** function化を使う！*****************
    // header("Location: index.php");
    // exit();
    //redirect先としてIndex.phpに飛ばして下さい
}

?>
