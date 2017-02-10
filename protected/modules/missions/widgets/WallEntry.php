<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \humhub\modules\user\models\Profile;
use app\modules\missions\models\EvidenceTags;


class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evidence/edit";

    public $showFiles = false;

    public function run()
    {
      $user = $this->contentObject->content->user;
      $tags = (new \yii\db\Query())
                ->select(["count(et.id) as 'amount', tt.title as 'translation', t.title as 'title'"])
                ->from('tags t')
                ->join('LEFT JOIN','evidence_tags et', 'et.tag_id = t.id and et.evidence_id ='.$this->contentObject->id)
                ->join('LEFT JOIN','tag_translations tt', 'tt.tag_id = t.id')
                ->join('LEFT JOIN','languages l', 'l.id = tt.language_id and l.code ="'.Yii::$app->language.'"')
                ->groupBy('t.id')
                ->all();

        return $this->render('entry', array('evidence' => $this->contentObject,
                    'user' => $user,
                    'name' => $user->getName(),
                    'tags' => $tags,
                    'contentContainer' => $this->contentObject->content->container));
    }

}
