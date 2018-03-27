<?php
	session_start();

	// 関数とは、一定の処理をまとめて名前をつけて置いてるプログラムの塊
	// 何度も同じ処理を行う時に便利

	// ログインチェックの関数定義
	function login_check() {
		// require('dbconnect.php');

		// 1時間ログインしていない場合、再度ログイン
		if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
		  // ログインしている
		  // ログイン時間の更新
		  $_SESSION['time'] = time();

		  // ログインユーザー情報取得
		  // $login_sql = 'SELECT * FROM `members` WHERE `member_id`=?';
		  // $login_data = array($_SESSION['id']);
		  // $login_stmt = $dbh->prepare($login_sql);
		  // $login_stmt->execute($login_data);
		  // global $login_member;
		  // $login_member = $login_stmt->fetch(PDO::FETCH_ASSOC);

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

	function like() {
		require('dbconnect.php');

		if (isset($_GET['like_tweet_id'])) {

			// いいねのデータを作成するsql文
			$like_sql = 'INSERT INTO `likes` SET `member_id`=?, `tweet_id`=?';
			$like_data = array($_SESSION['id'], $_GET['like_tweet_id']);
			$like_stmt = $dbh->prepare($like_sql);
			$like_stmt->execute($like_data);

			header('Location: index.php?page='.$_GET['page']);
			exit();
		}
	}

	function unlike() {
		require('dbconnect.php');

		if (isset($_GET['unlike_tweet_id'])) {

			// いいねのデータを削除するsql文
			$unlike_sql = 'DELETE FROM `likes` WHERE `member_id`=? AND `tweet_id`=?';
			$unlike_data = array($_SESSION['id'], $_GET['unlike_tweet_id']);
			$unlike_stmt = $dbh->prepare($unlike_sql);
			$unlike_stmt->execute($unlike_data);

			header('Location: index.php?page='.$_GET['page']);
			exit();
		}
	}

?>



































