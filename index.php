<?php
require_once 'panel/inc/function.php';
if ($SH->getAdminSession()) {
    $goto_url = 'panel/index.php';
}else{
    $goto_url = 'login.php';
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="refresh" content="0;url=<?= $goto_url ?>">
    <title>Admin Panel</title>
    <script language="javascript">
        window.location.href =  <?= $goto_url ?>
    </script>
</head>

<body>
    <a href="panel/index.php">Anasayfa'ya git</a>
</body>

</html>