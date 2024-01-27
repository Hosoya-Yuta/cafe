<?php
session_start();
$error = [];

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_POST['name']) || mb_strlen($_POST['name']) > 10) {
        $error['name'] = 'blank';
    }
    if(empty($_POST['kana']) || mb_strlen($_POST['kana']) > 10) { 
        $error['kana'] = 'blank';
    }
    if(!preg_match('/^[0-9]+$/', $_POST['tel']) == 1 && !empty($_POST['tel'])) { 
        $error['tel'] = 'blank';
    }
    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
        $error['email'] = 'blank';
    }
    if(empty($_POST['body'])) { 
        $error['body'] = 'blank';
    }
    if(count($error) == 0) {
        $_SESSION['form'] = $_POST;
        header('Location: confirm.php');
        exit();
    }
} else {
    if(isset($_SESSION['form'])) {
        $_POST = $_SESSION['form'];
    }
}

// データ抽出
try {
    $dbh = new PDO('mysql:host=localhost;dbname=cafe;charset=utf8', 'root', 'root',[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    BEGIN;
    $sql = 'SELECT * FROM contacts';
    $stmt = $dbh -> query($sql);

    foreach($stmt as $row) {
        $rows[] = $row;
    }
    COMMIT;
    // echo "接続成功";
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
            <h2>お問い合わせ</h2>
			<form action="" method="post" id="contact_form">
                <input type="hidden" name="reload" value="true">
                <h3>下記の項目をご記入の上送信ボタンを押してください</h3>
                <p>送信頂いた件につきましては、当社より折り返しご連絡を差し上げます。</p>
                <p>なお、ご連絡までに、お時間を頂く場合もございますので予めご了承ください。</p>
                <p><span class="required">*</span>は必須項目となります。</p>
                <dl>
                    <dt><label for="name">氏名</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['name']) || mb_strlen($_POST['name']) > 10) { ?>
                        <dd class="error">氏名は必須入力です。10文字以内でご入力ください。</dd>
                    <?php }} ?>
                        <dd><input type="text" name="name" id="name" value="<?php if((isset($_SESSION['form']) && !empty($_POST['name'])) || $_SERVER['REQUEST_METHOD'] == 'POST') {echo htmlspecialchars($_POST['name']);}?>" placeholder="山田太郎"></dd>
                    <dt><label for="kana">フリガナ</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['kana']) || mb_strlen($_POST['kana']) > 10) { ?>
                    <dd class="error">フリナガは必須入力です。10文字以内でご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="kana" id="kana" value="<?php if((isset($_SESSION['form']) && !empty($_POST['kana'])) || $_SERVER['REQUEST_METHOD'] == 'POST') {echo htmlspecialchars($_POST['kana']);} ?>" placeholder="ヤマダタロウ"></dd>
                    <dt><label for="tel">電話番号</label></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(!preg_match('/^[0-9]+$/', $_POST['tel']) == 1 && !empty($_POST['tel'])) { ?>
                    <dd class="error">電話番号は0-9の数字のみでご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="tel" id="tel" value="<?php if((isset($_SESSION['form']) && !empty($_POST['tel'])) || $_SERVER['REQUEST_METHOD'] == 'POST') {echo htmlspecialchars($_POST['tel']);} ?>" placeholder="09012345678"></dd>
                    <dt><label for="email">メールアドレス</label><span class="required">*</span></dt>
                    <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { ?>
                    <dd class="error">メールアドレスは正しくご入力ください。</dd>
                    <?php }} ?>
                    <dd><input type="text" name="email" id="email" value="<?php if((isset($_SESSION['form']) && !empty($_POST['email'])) || $_SERVER['REQUEST_METHOD'] == 'POST') {echo htmlspecialchars($_POST['email']);} ?>" placeholder="test@test.co.jp"></dd>
                </dl>
                <h3><label for="body">お問い合わせ内容をご記入ください<span class="required">*</span></label></h3>
                <dl class="body">
                <?php if($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if(empty($_POST['body'])) { ?>
                    <dd class="error">お問い合わせ内容は必須入力です。</dd>
                    <?php }} ?>
                    <dd><textarea name="body" id="body"><?php if((isset($_SESSION['form']) && !empty($_POST['body'])) || $_SERVER['REQUEST_METHOD'] == 'POST') {echo htmlspecialchars($_POST['body']);} ?></textarea></dd>
                    <dd><button type="submit">送　信</button></dd>
                </dl>
			</form>
        </div>
    </section>
    
    <!-- <table>
        <tr>
            <th>id</th>
            <th>氏名</th>
            <th>フリガナ</th>
            <th>電話番号</th>
            <th>メールアドレス</th>
            <th>お問い合せ内容</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        // テーブル表示
        foreach($rows as $row) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['kana']); ?></td>
            <td><?php echo htmlspecialchars($row['tel']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['body']); ?></td>
            <td><?php echo "<a href=update_form.php?id=" . $row['id'] . ">編集</a>"?></td>
            <td><a id="delete<?php echo $row['id'] ?>">削除</a></td>
        </tr>
        <script>
         $('#delete<?php echo $row['id']?>').on('click',function() {
            if(confirm('本当に削除しますか？')) {
                window.location.href='<?php echo "delete.php?id=" . $row['id']?>';
            }
         })
        </script>
        <?php
    }
    ?>
    </table> -->
    <?php
    // ヘッダー表示
    include('./footer.php');
    ?>

    <script src="js/contact.js">
        alert("氏名は必須入力です。10文字以内でご入力ください。\nフリガナは必須入力です。10文字以内でご入力ください。\n電話番号は0-9の数字のみでご入力ください。\nメールアドレスは正しくご入力ください。\nお問い合わせ内容は必須入力です。");   
    </script>
</body>
</html>