<?php
session_start();

if(!isset($_SESSION['form'])) {
    header('Location: contact.php');
    exit();
} else {
    $_POST = $_SESSION['form'];
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Location: complete.php');
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
			<form action="" method="post">
                <!-- <h3>下記の項目をご記入の上送信ボタンを押してください</h3> -->
                <p>下記の内容をご確認の上送信ボタンを押してください</p>
                <p>内容を訂正する場合は戻るを押してください。</p>
                <dl>
                    <dt><label for="name">氏名</label><span class="required"></span></dt>
                    <!-- <dd class="error">氏名は必須入力です。10文字以内でご入力ください。</dd> -->
                    <dd><?php echo htmlspecialchars($_POST["name"]); ?></dd>
                    <dt><label for="kana">フリガナ</label><span class="required"></span></dt>
                    <!-- <dd class="error">フリナガは必須入力です。10文字以内でご入力ください。</dd> -->
                    <dd><?php echo htmlspecialchars($_POST["kana"]); ?></dd>
                    <dt><label for="tel">電話番号</label></dt>
                    <!-- <dd class="error">電話番号は0-9の数字のみでご入力ください。</dd> -->
                    <dd><?php echo htmlspecialchars($_POST["tel"]); ?></dd>
                    <dt><label for="email">メールアドレス</label><span class="required"></span></dt>
                    <!-- <dd class="error">メールアドレスは正しくご入力ください。</dd> -->
                    <dd><?php echo htmlspecialchars($_POST["email"]); ?></dd>
                </dl>
                <!-- <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3> -->
                <dl class="body">
                    <dt><label for="body">お問い合せ内容</label><span class="required"></span></dt>
                    <!-- <dd class="error">お問い合わせ内容は必須入力です。</dd> -->
                    <dd><?php echo nl2br(htmlspecialchars($_POST["body"])); ?></dd>
                    <dd class="confirm_btn">
                        <button type="submit">送　信</button>
                        <a href="contact.php">戻　る</button>
                    </dd>
                </dl>
			</form>
        </div>
    </section>

    <?php
    include('./footer.php');
    ?>
    <script type="text/javascript" src="js/contact.js"></script>
    
</body>
</html>