<?php

// データ抽出
try {
    $dbh = new PDO('mysql:host=localhost;dbname=cafe;charset=utf8', 'root', 'root');
    BEGIN;
    $stmt = $dbh -> prepare("DELETE FROM contacts WHERE id = :id");
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    COMMIT;
    $dbh = null;
} catch(PDOException $e) {
    echo "接続失敗". $e->getMessage();
    exit();
}

header('Location: contact.php');
exit();

?>