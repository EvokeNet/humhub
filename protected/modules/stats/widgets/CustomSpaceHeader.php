<?php

namespace humhub\modules\stats\widgets;

use Yii;
use \yii\base\Widget;
use humhub\modules\space\widgets\Header;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\missions\models\Evidence;
use app\modules\coin\models\Wallet;
use humhub\modules\content\models\Content;
use humhub\modules\post\models\Post;

class CustomSpaceHeader extends Header
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $postCount = Content::find()->where(['object_model' => Post::className(), 'space_id' => $this->space->id])->count();
        
        $missions = Missions::find()
        ->where(['locked' => 0])
        ->all();

        $total = Activities::find()->count();

        $done = (new \yii\db\Query())
        ->select(['count(DISTINCT e.activities_id) as count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('INNER JOIN', 'activities as a', '`e`.`activities_id`= `a`.`id`')
        ->where(['c.space_id' => $this->space->id])
        ->one()['count'];
        
        $evidencesTotal = (new \yii\db\Query())
        ->select(['count(e.id) as count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where(['c.space_id' => $this->space->id])
        ->one()['count'];

        return $this->render('customSpaceHeader', array(
                    'mission' => $missions,
                    'total' => $total,
                    'done' => $done,
                    'evidencesTotal' => $evidencesTotal,
                    'space' => $this->space,
                    'postCount' => $postCount
        ));
    }

}

?>
