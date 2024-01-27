<?php
session_start();

if(!isset($_SESSION['form'])) {
    header('Location: contact.php');
    exit();
} else {
    $_POST = $_SESSION['form'];
}
session_destroy();

// データベース登録
try {
    $dbh = new PDO ('mysql:host=localhost;dbname=cafe;charset=utf8', 'root', 'root',[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    $abc = "name";
    $name = $_POST['name'];
    $kana = $_POST['kana'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $body = $_POST['body'];
    BEGIN;
    $stmt = $dbh -> prepare("INSERT INTO contacts(name, kana, tel, email, body) VALUES('$name', '$kana', '$tel', '$email', '$body')");
    $stmt -> execute();
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
            <h2>お問い合わせ</h2>
            <div class="complete_msg">
                <p>お問い合わせ頂きありがとうございます。</p>
                <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                <a href="index.php">トップへ戻る</a>
            </div>
        </div>
    </section>
    
    <?php
    include('./footer.php');
    ?>
    
    <script type="text/javascript" src="js/contact.js"></script>
</body>
</html>