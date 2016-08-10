<?php 
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
      <title>ユーザー情報詳細画面</title>
</head>
  <body>
    <?php
    if(isset($_GET['id'])){
     $_SESSION['userID'] = $_GET['id'];
    }
    //SESSIONを利用してuserIDから対象の全データを入手
    $result = profile_detail($_SESSION['userID']);
    
    //エラーが発生しなければ表示を行う
    if(is_array($result)){
    ?>
      
    <h1>詳細情報</h1>
    名前:<?php echo $result[0]['name'];?><br>
    生年月日:<?php echo $result[0]['birthday'];?><br>
    種別:<?php echo ex_typenum($result[0]['type']);?><br>
    電話番号:<?php echo $result[0]['tell'];?><br>
    登録日時:<?php echo date('Y年n月j日　G時i分s秒', strtotime($result[0]['newDate'])); ?><br>
    
    
    <form action="<?php echo UPDATE; ?>" method="POST">
        <input type="submit" name="update" value="変更"style="width:100px">
        <input type="hidden" name="id" value="<?php echo $result[0]['userID'] ?>">
    </form>
    <form action="<?php echo DELETE; ?>" method="POST">
        <input type="submit" name="delete" value="削除"style="width:100px">
    </form>
    
    <?php
    }else{
        echo 'データの検索に失敗しました。次記のエラーにより処理を中断します:'.$result;
    }
    echo return_top(); 
    ?>
  </body>
</html>
