<?php

use kartik\grid\GridView;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานANC <12 weeks';
?>

<div id="chart" style="padding-bottom: 10px"></div>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'รายงานANC <12 weeks',
        'after' => 'ประมวลผล ณ ' . date('Y-m-d H:i:s')
        ],
    
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'attribute' => 'hoscode',
            'header' => 'รหัสสถานบริการ',
        ],
        [
            'attribute' => 'hosname',
            'format' => 'raw',
            'value' => function($model) {
                $hoscode = $model['hoscode'];
                $hosname = $model['hosname'];
                return Html::a(Html::encode($hosname), ['report/report4', 'hoscode' => $hoscode]);
            }
                ],
                [
                    'attribute' => 'target',
                    'header' => 'หญิงตั้งครรภ์ทั้งหมด(คน)'
                ],
                [
                    'attribute' => 'result',
                    'header' => 'ฝากครรภ์แรกน้อยกว่า 12 สัปดาห์(คน)'
                ],
                
            ]
       ]);
                
        ?>