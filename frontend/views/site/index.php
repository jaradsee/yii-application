<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'โรงพยาบาลฟากท่า';
?>
<?php
$route1 = Yii::$app->urlManager->createUrl('test/test1');
?>
<a href="<?=$route1?>"> ไปที่ test1</a>
<br>
    
<?php
$route2 = Yii::$app->urlManager->createUrl(['test/test2','name'=>'jarad','lname'=>'seeka']);
?>
<a href="<?=$route2?>"> ไปที่ test2</a>
<br>

<?=
\yii\helpers\Html::a('ลิงค์แบบที่ 3',['test/test1','a'=>'1']);

?>
