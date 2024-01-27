<?php

// データ抽出
try {
    $dbh = new PDO('mysql:host=localhost;dbname=cafe;charset=utf8', 'root', 'root');
    BEGIN;
    $stmt = $dbh -> prepare("SELECT * FROM contacts WHERE id = :id");
    $stmt->execute(array(':id' => $_GET['id']));

    $result = 0;
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach($stmt as $row) {
        $rows[] = $row;
    }
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
<script src="js/jquery.validate.min.js"></script>
</head>
<body id="app" v-on="click: closeMenu">
    <?php
    include('./header.php');
    ?>
    <open-modal v-show="showContent" v-on="click: closeModal"></open-modal>
    <section>
        <div class="contact_box">
            <h2>編集画面</h2>
			<form action="edit_complete.php" method="post" id="contact_form">
                <input type="hidden" name="id" value="<?php if(!empty($result['id'])) {echo htmlspecialchars($result['id']); }?>">
                <h3>下記の項目を変更の上、編集ボタンを押してください</h3>
                <p><span class="required">*</span>は必須項目となります。</p>
                <dl>
                    <dt><label for="name">氏名</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['name']) || mb_strlen($_POST['name']) > 10) { ?>
                        <dd class="error">氏名は必須入力です。10文字以内でご入力ください。</dd>
                    <?php }} ?>
                        <dd><input type="text" name="name" id="name" value="<?php if(!empty($result['name'])) {echo htmlspecialchars($result['name']); }?>" placeholder="山田太郎"></dd>
                    <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['kana']) || mb_strlen($_POST['kana']) > 10) { ?>
                    <dd class="error">フリナガは必須入力です。10文字以内でご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="kana" id="kana" value="<?php if(!empty($result['kana'])) {echo htmlspecialchars($result['kana']); } ?>" placeholder="ヤマダタロウ"></dd>
                    <dt><label for="tel">電話番号</label></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(!preg_match('/^[0-9]+$/', $_POST['tel']) == 1 && !empty($_POST['tel'])) { ?>
                    <dd class="error">電話番号は0-9の数字のみでご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="tel" id="tel" value="<?php if(!empty($result['tel'])) {echo htmlspecialchars($result['tel']); } ?>" placeholder="09012345678"></dd>
                    <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { ?>
                    <dd class="error">メールアドレスは正しくご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="email" id="email" value="<?php if(!empty($result['email'])) {echo htmlspecialchars($result['email']); } ?>" placeholder="test@test.co.jp"></dd>
                </dl>
                <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
                <dl class="body">
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['body'])) { ?>
                    <dd class="error">お問い合わせ内容は必須入力です。</dd>
                    <?php }} ?>
                    <dd><textarea name="body" id="body"><?php if(!empty($result['body'])) {echo nl2br(htmlspecialchars($result['body'])); } ?></textarea></dd>
                    <dd><button type="submit">編集する</button></dd>
                </dl>
			</form>
        </div>
    </section>
    <?php
    // ヘッダー表示
    include('./footer.php');
    ?>

    <script src="js/contact.js">
        alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");   
    </script>
</body>
</html>