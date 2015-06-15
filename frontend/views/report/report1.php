<?php
use kartik\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานนับถือศาสนา';

echo GridView::widget([
        'dataProvider' => $dataProvider,
     
        'panel'=>[
            'before'=>'รายงาน xxxx',
            'after'=>'ประมวลผล ณ '.date('Y-m-d H:i:s')
        ]
    ]
    );
?>


