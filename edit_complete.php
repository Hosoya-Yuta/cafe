<?php

// データベース更新

try {
    $dbh = new PDO ('mysql:host=localhost;dbname=cafe;charset=utf8', 'root', 'root',[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    BEGIN;
    $stmt = $dbh->prepare('UPDATE contacts SET name= :name, kana = :kana, tel = :tel, tel = :tel, email = :email, body = :body WHERE id = :id');
    $stmt->execute(array(':name' => $_POST['name'], ':kana' => $_POST['kana'], ':tel' => $_POST['tel'], ':email' => $_POST['email'], ':body' => $_POST['body'], ':id' => $_POST['id']));
    COMMIT;
    $dbh = null;
} catch(PDOException $e) {
    echo "接続失敗". $e->getMessage();
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Lesson Sample Site</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/sp.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/jquery-3.6.0.min.js"></script>
</head>
<body id="app" v-on="click: closeMenu">
    <?php
    include('./header.php');
    ?>
    <open-modal v-show="showContent" v-on="click: closeModal"></open-modal>

    <section>
        <div class="contact_box">
            <h2>編集完了</h2>
            <div class="complete_msg">
                <p>編集が完了しました。</p>
                <a href="contact.php">一覧へ戻る</a>
            </div>
        </div>
    </section>
    
    <?php
    include('./footer.php');
    ?>
    
    <script type="text/javascript" src="js/contact.js"></script>
</body>
</html>