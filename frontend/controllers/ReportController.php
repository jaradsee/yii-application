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
 ) as 'ประชากรทั้งหมด'
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p where p.HOSPCODE = h.hoscode
   AND p.typearea in (1,3) AND p.RELIGION = 1
  ) as 'นับถือศาสนาพุทธ'
,(select COUNT(DISTINCT p.HOSPCODE,p.PID) from person p where p.HOSPCODE = h.hoscode
   AND p.typearea in (1,3) AND p.RELIGION != 1
  ) as 'นับถือศาสนาอื่นๆ'
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
     
     public function actionReport2(){
        $sql = "select h.distcode as amphur,h.hoscode as hospcode ,
concat(provcode,distcode,subdistcode,mu) as areacode,h.hosname as hospname, 
(select total from (select anc.hospcode,count(distinct anc.pid) as total 
from labor INNER JOIN anc ON labor.hospcode = anc.hospcode 
AND labor.pid = anc.pid INNER JOIN person ON person.hospcode = anc.hospcode 
AND person.pid = anc.pid WHERE person.discharge = '9' and person.typearea in 
('1', '3') and person.nation ='099' and person.sex = '2' and labor.btype<>'6' 
and labor.bdate BETWEEN '2014-04-01' AND '2015-06-15' 
GROUP BY person.hospcode ) as t where t.hospcode =h.hoscode ) as target, 
( select total from ( select labor.hospcode,count(*) 
as total from labor 
INNER JOIN (select anc1.hospcode,anc1.pid,anc1.gravida,
count(distinct anc1.pid) as total from anc anc1 
WHERE anc1.ga <= 12 GROUP BY anc1.hospcode,anc1.pid ) as anc1 
ON labor.hospcode = anc1.hospcode AND labor.pid = anc1.pid 
INNER JOIN person ON person.hospcode = labor.hospcode 
AND person.pid = labor.pid WHERE person.discharge = '9' 
and person.typearea in ('1', '3') and person.nation ='099' 
and person.sex = '2' and labor.btype<>'6' and labor.bdate 
BETWEEN '2014-04-01' AND '2015-06-15' GROUP BY labor.hospcode ) 
as 12wks where 12wks.hospcode = h.hoscode) as result 
from chospital_amp h order by distcode,hoscode asc";
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
                    'dataProvider' => $dataProvider,
                    'sql'=>$sql,
                   
        ]);
        
    }
     
   
}
