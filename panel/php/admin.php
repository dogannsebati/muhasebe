<?php 
require_once(realpath(__DIR__ . '/../') . '/' . 'inc/function.php');
isset($_POST['islem_turu']) ? $action = $FNC->filter($_POST['islem_turu']) : exit();

if ($action == 'admin-giris') {
    $kulad = $FNC->filter($_POST['kulad']);
    $sifre = $FNC->filter($_POST['sifre']);
    if ($kulad == null || $kulad == "") {
        $FNC->sendResult(false, 'Kullanıcı adı boş olamaz !', 'kulad');
    } else if ($sifre == null || $sifre == "") {
        $FNC->sendResult(false, 'Şifre boş olamaz !', 'sifre');
    } else if (strlen($sifre) < 6) {
        $FNC->sendResult(false, 'Şifre 6 haneden kısa olamaz !', 'sifre');
    } else {
        $sql = ('SELECT * FROM uyeler WHERE kulad = :kulad AND sifre = :sifre LIMIT 1');
        $sqlValues = ['kulad' => $kulad, 'sifre' => $FNC->sifreleme($sifre)];
        $kontrol = $db->query($sql, $sqlValues);
        if (count($kontrol) > 0) {
            $SH->setAdminSession($kontrol[0]);
            $FNC->sendResult(true, 'Giriş başarılı. Yönlendiriliyorsunuz.');
        } else {
            $FNC->sendResult(false, 'Kullanıcı adınız ya da şifre yanlış kontrol ediniz !');
        }
    }
}


?>