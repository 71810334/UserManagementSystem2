<?php 
require_once '../common/defineUtil.php';
require_once '../common/scriptUtil.php';
require_once '../common/dbaccesUtil.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
      <title>更新結果画面</title>
</head>
  <body>
    <?php
    session_start();
    
    //直リンクを禁止する
    if(!$_POST['mode']=="UPRESULT"){
      echo 'アクセスルートが不正です。もう一度トップページからやり直して下さい<br>';
    }else{
           $confirm_values = array(
                                'name' => bind_p2s('name'),
                                'year' => bind_p2s('year'),
                                'month' =>bind_p2s('month'),
                                'day' =>bind_p2s('day'),
                                'type' =>bind_p2s('type'),
                                'tell' =>bind_p2s('tell'),
                                'comment' =>bind_p2s('comment'));
    
    $name = $_SESSION['name'];
    $birthday = $_SESSION['year'].'-'.sprintf('%02d',$_SESSION['month']).'-'.sprintf('%02d',$_SESSION['day']);
    $type = $_SESSION['type'];
    $tell = $_SESSION['tell'];
    $comment = $_SESSION['comment'];
    $userID = $_SESSION['userID'];
    
    
    if(!in_array(null,$confirm_values, true)){
      $result = update_profile($name,$birthday,$type,$tell,$comment,$userID);
    }
    //エラーが発生しなければ表示を行う
    if(!isset($result)){
?>
    <h1>更新確認</h1>
    
    <h1>更新結果画面</h1><br>
          名前:<?php echo $name;?><br>
          生年月日:<?php echo $birthday;?><br>
          種別:<?php echo ex_typenum($type);?><br>
          電話番号:<?php echo $tell;?><br>
          自己紹介:<?php echo $comment;?><br><br>
          以上の内容で更新しました。<br>
    <?php
       }else{
        echo 'データの更新に失敗しました。次記のエラーにより処理を中断します:'.$result;
    }
    }
    echo return_top(); 
    ?>
  </body>
</html>
