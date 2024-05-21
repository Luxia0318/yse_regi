<?php
// データベースに接続
require_once "db.php";

// POSTデータを受け取る
$posts = $_POST;
// var_dump($posts);
$price = $posts['price'];

// TODO: 合計金額「sales.price」を保存するSQLを作成
$sql = "INSERT INTO sales (price) VALUES (:price)";
// プリペアドステートメントを作成
$stmt = $pdo->prepare($sql);
// パラメータをバインド
$stmt->bindParam(':price', $price, PDO::PARAM_INT);
// SQLを実行
$stmt->execute();

// レジ画面に戻る
header('Location: ./');