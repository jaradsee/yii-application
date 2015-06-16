<?php

namespace frontend\controllers;
use yii;
class ReportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function  actionReport1(){
        $sql = "SELECT 
h.hoscode,h.hosname
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p where p.HOSPCODE = h.hoscode
	 AND p.typearea in (1,3)
 ) as 'total'
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p where p.HOSPCODE = h.hoscode
   AND p.typearea in (1,3) AND p.RELIGION = 1
  ) as 'buddha'
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p where p.HOSPCODE = h.hoscode
   AND p.typearea in (1,3) AND p.RELIGION != 1
  ) as 'other'
 from chospital_amp h";    
    
    $rawData = \yii::$app->db->createCommand($sql)->queryAll();
    
    //print_r($rawData);
     try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report1', [
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                   
        ]);
    
     }
     
     public function  actionReport2(){
        $sql = "select h.hoscode 
	,h.hosname 
	,a.target
	,a.result
from chospital_amp h
left join (
	select l.hospcode
		,count(distinct l.pid) target
		,count(distinct if(a.ga<=12,a.pid,null)) result
	from labor l
	left join person p on p.pid=l.pid and l.hospcode=p.hospcode
	left join anc a on a.pid=l.pid and a.hospcode=l.hospcode and a.ancno=1
	where l.bdate between'2014-4-1' and'2015-3-31'
			and p.typearea in (1,3)
	group by l.hospcode
) a on a.hospcode=h.hoscode;";    
    try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report2', [
                    'dataProvider' => $dataProvider
                    
                   
        ]);
        
    
     }
     
     
    public function  actionReport3($hoscode){
        $sql = "select hospcode,name,lname from person where hospcode=$hoscode";    
    try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report3', [
                    'dataProvider' => $dataProvider
                    
                   
        ]);
        
    }
        public function  actionReport4($hoscode){
        $sql = "select l.hospcode
	,p.cid
	,p.hn
	,p.pid
	,concat(p.name,' ',p.lname) ptname
	,a.ga,if(a.ga<=12,'Y',null) OK
from labor l
left join person p on p.pid=l.pid and l.hospcode=p.hospcode
left join anc a on a.pid=l.pid and a.hospcode=l.hospcode and a.ancno=1
where l.bdate between '2014-4-1' and '2015-3-31'
		and p.typearea in (1,3) and l.hospcode=$hoscode";    
    try {
            $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        } catch (\yii\db\Exception $e) {
            throw new \yii\web\ConflictHttpException('sql error');
        }
        $dataProvider = new \yii\data\ArrayDataProvider([

            'allModels' => $rawData,
            'pagination' => FALSE,
        ]);
        return $this->render('report4', [
                    'dataProvider' => $dataProvider
                    
                   
        ]);
    }
     
   
}
