<?php
	session_start();

	// 関数とは、一定の処理をまとめて名前をつけて置いてるプログラムの塊
	// 何度も同じ処理を行う時に便利

	// ログインチェックの関数定義
	function login_check() {

		// 1時間ログインしていない場合、再度ログイン
		if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
		  // ログインしている
		  // ログイン時間の更新
		  $_SESSION['time'] = time();

		} else {
		  // ログインしていない、または時間切れの場合
		  header('Location: login.php');
		  exit;
		}
	}

	// 実行
	login_check();

	function delete_tweet() {

		// OKボタンが押された時
		if (true) {
			// DBの接続
		  	require('dbconnect.php');

			//削除したいtweet_id
			$delete_tweet_id = $_GET['tweet_id'];

			// 論理削除用のUPDATE文
			$sql = 'UPDATE `tweets` SET `delete_flag`=1 WHERE `tweet_id`=?';
			$data = array($delete_tweet_id);
			// SQL実行
			$stmt = $dbh->prepare($sql);
			$stmt->execute($data);

			// 一覧画面に戻る
			header("Location: index.php");
			exit();
		}
	}

?>
















