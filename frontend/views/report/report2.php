

<?php
use kartik\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => 'รายงาน', 'url' => ['report/index']];
$this->params['breadcrumbs'][] = 'รายงานหญิงมีครรภ์ฝากครรภ์ครั้งแรก< 12 สัปดาห์';

echo GridView::widget([
        'dataProvider' => $dataProvider,
     
        'panel'=>[
            'before'=>'รายงานหญิงมีครรภ์ฝากครรภ์ครั้งแรก< 12 สัปดาห์',
            'after'=>'ประมวลผล ณ '.date('Y-m-d H:i:s')
        ]]
    );
?>