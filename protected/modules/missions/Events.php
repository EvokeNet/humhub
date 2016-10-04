<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\missions;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;

use humhub\modules\missions\widgets\EvidenceWidget;
use humhub\modules\missions\widgets\CTAPostEvidence;
use humhub\modules\missions\widgets\PopUpWidget;
use humhub\modules\missions\widgets\PlayerStats;
use humhub\modules\missions\widgets\PortfolioWidget;
use humhub\modules\missions\widgets\CreateATeamWidget;

use humhub\modules\space\models\Space;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Portfolio;
use app\modules\powers\models\UserPowers;
use humhub\modules\user\models\User;
use app\modules\teams\models\Team;
use humhub\modules\missions\controllers\MentorController;

/**
 * Description of Events
 *
 */
class Events
{

    public static function onDashboardSidebarInit($event){
        //$userPowers = UserPowers::getUserPowers(Yii::$app->user->getIdentity()->id);

        $user = Yii::$app->user->getIdentity();
        $team_id = Team::getUserTeam($user->id);

        $event->sender->addWidget(PopUpWidget::className(), []);
        if(!isset($team_id) && $user->group->name != "Mentors" ){
            $event->sender->addWidget(CreateATeamWidget::className(), [], array('sortOrder' => 0));   
        }
        //$event->sender->addWidget(CTAPostEvidence::className(), []);
        //$event->sender->addWidget(PlayerStats::className(), ['powers' => $userPowers]);
    }

    public static function onProfileMenuInit($event){

        $user = $event->sender->user;
        $team_id = Team::getUserTeam($user->id);

        if($team_id){

            $team = Team::findOne($team_id);    

            $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.widgets_ProfileMenuWidget', "Team"),
                'group' => 'profile',
                'url' => Url::to(['/space/space', 'sguid' => $team->guid]),
                'sortOrder' => 250
            ));

        }

    }
    
    public static function onSidebarInit($event)
    {
        $user = Yii::$app->user->getIdentity();

        if (Yii::$app->user->isGuest || $user->getSetting("hideSharePanel", "share") != 1) {
            $space = $event->sender->space;
            $event->sender->addWidget(PopUpWidget::className(), []);

            $team_id = Team::getUserTeam($user->id);

            if(!isset($team_id) && $space->name != "Mentors" && $space->name != "Mentor" && $user->group->name != "Mentors" && !$space->is_team){
                $event->sender->addWidget(CreateATeamWidget::className(), [], array('sortOrder' => 0));    
            }

            if($space->is_team && $user->group->name != "Mentors"){
                //$event->sender->addWidget(EvidenceWidget::className(), array('space' => $space), array('sortOrder' => 9));    

                $userPowers = UserPowers::getUserPowers($user->id);
                $event->sender->addWidget(PlayerStats::className(), ['powers' => $userPowers], array('sortOrder' => 9));
                
                if(Setting::Get('enabled_evokations')){
                    $portfolio = Portfolio::getUserPortfolio($user->id);
                    $event->sender->addWidget(PortfolioWidget::className(), ['portfolio' => $portfolio], array('sortOrder' => 8));    
                }
                
            }

        }

    }

    public static function onSidebarRun($event){

    }

    public static function onAccountMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Evoke Settings'),
            'url' => Url::to(['/missions/user-settings']),
            'group' => 'account',
            'sortOrder' => 105,
            'icon' => '<i class="fa fa-university"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'user-settings'
           ),
        ));
    }

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Missions'),
            'url' => Url::to(['/missions/admin']),
            'group' => 'manage',
            'sortOrder' => 600,
            'icon' => '<i class="fa fa-sitemap"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'
            
                && Yii::$app->controller->action->id != 'index-categories'
                && Yii::$app->controller->action->id != 'create-categories'
                && Yii::$app->controller->action->id != 'update-categories'

                && Yii::$app->controller->action->id != 'index-category-translations'
                && Yii::$app->controller->action->id != 'create-category-translations'
                && Yii::$app->controller->action->id != 'update-category-translations'
                
                && Yii::$app->controller->action->id != 'index-deadline'
                && Yii::$app->controller->action->id != 'create-deadline'
                && Yii::$app->controller->action->id != 'update-deadline'

                && Yii::$app->controller->action->id == 'index-evidences'
                && Yii::$app->controller->action->id == 'update-evidences'

           ),
        ));

        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Evoke Settings'),
            'url' => Url::to(['/missions/settings']),
            'group' => 'settings',
            'sortOrder' => 150,
            'icon' => '<i class="fa fa-university"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'settings'
           ),
        ));
    }

    public static function onCategoriesAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Evokation Categories'),
            'url' => Url::to(['/missions/admin/index-categories']),
            'group' => 'manage',
            'sortOrder' => 1100,
            'icon' => '<i class="fa fa-sort-amount-asc"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'
            &&
                (
                    Yii::$app->controller->action->id == 'index-categories'
                    || Yii::$app->controller->action->id == 'create-categories'
                    || Yii::$app->controller->action->id == 'update-categories'

                    || Yii::$app->controller->action->id == 'index-category-translations'
                    || Yii::$app->controller->action->id == 'create-category-translations'
                    || Yii::$app->controller->action->id == 'update-category-translations'
                    
                )
            ),
        ));
    }

    public static function onEvidencesAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Evidences'),
            'url' => Url::to(['/missions/admin/index-evidences']),
            'group' => 'manage',
            'sortOrder' => 950,
            'icon' => '<i class="fa fa-file-text-o"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'
            &&
                (
                    Yii::$app->controller->action->id == 'index-evidences'
                    || Yii::$app->controller->action->id == 'update-evidences'
                )
            ),
        ));
    }
    
    public static function onReviewsAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Reviews'),
            'url' => Url::to(['/missions/admin/index-reviews']),
            'group' => 'manage',
            'sortOrder' => 950,
            'icon' => '<i class="fa fa-file-text-o"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'
            &&
                (
                    Yii::$app->controller->action->id == 'index-reviews'
                    || Yii::$app->controller->action->id == 'update-reviews'
                )
            ),
        ));
    }

    public static function onLockdownAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Evokation Deadline'),
            'url' => Url::to(['/missions/admin/index-deadline']),
            'group' => 'manage',
            'sortOrder' => 1000,
            'icon' => '<i class="fa fa-clock-o"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'
            &&
                (
                    Yii::$app->controller->action->id == 'index-deadline'
                    || Yii::$app->controller->action->id == 'create-deadline'
                    || Yii::$app->controller->action->id == 'update-deadline'

                    // || Yii::$app->controller->action->id != 'index-categories'
                    // || Yii::$app->controller->action->id != 'create-categories'
                    // || Yii::$app->controller->action->id != 'update-categories'

                    // || Yii::$app->controller->action->id != 'index-category-translations'
                    // || Yii::$app->controller->action->id != 'create-category-translations'
                    // || Yii::$app->controller->action->id != 'update-category-translations'
                )
            ),
        ));
    }

     /**
     * Create installer sample data
     *
     * @param \yii\base\Event $event
     */
    public static function onSampleDataInstall($event)
    {
        $space = Space::find()->where(['id' => 1])->one();

        // activate module at space
        if (!$space->isModuleEnabled("missions")) {
            $space->enableModule("missions");
        }

    }

    public static function onUserLike($event){

        $evidenceModel = 'app\modules\missions\models\Evidence';

        $like = $event->action->id === 'like' ? true : false;

        $content_user_id = $event->action->controller->parentContent->content->user_id;
        $evidence = $event->action->controller->parentContent;

        //check if user isn't liking its own evidence and if it's like/unlike action and content is an evidence.
        if(($event->action->id === 'like' || $event->action->id === 'unlike') && Yii::$app->user->getIdentity()->id != $content_user_id && $event->action->controller->contentModel == $evidenceModel && isset($evidence->activities_id)){

            //ACTIVITY POWER POINTS
            $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);

            //USER POWER POINTS
            foreach($activityPowers as $activity_power){
                if(!$activity_power->flag){
                    $user = User::findOne($content_user_id);
                    if($like){
                        UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
                    }else{
                        UserPowers::addPowerPoint($activity_power->getPower(), $user, - $activity_power->value);
                    }
                }
            }
        }

    }

    public static function onSpaceMenuInit($event)
    {
        $user = Yii::$app->user->getIdentity();
        $team_id = Team::getUserTeam($user->id);
        $space = $event->sender->space;

        if($space->name=="Mentors"){
            $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'All Evidences'),
                'group' => 'modules',
                'url' => $space->createUrl('/missions/evidence/mentor_activities'),
                'icon' => '<i class="fa fa-sitemap"></i>',
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->module
                && Yii::$app->controller->module->id == 'missions'
                && Yii::$app->controller->id == 'evidence'),
            ));
        }

        if ($space->isModuleEnabled('missions') ) {

            //MEMBERS
            $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'Members'),
                'group' => 'modules',
                'url' => $space->createUrl('/missions/space/members'),
                'icon' => '<i class="fa fa-group"></i>',
                'sortOrder' => 200,
                'isActive' => (Yii::$app->controller->module
                && Yii::$app->controller->module->id == 'missions'
                && Yii::$app->controller->id == 'space'),
            ));

            
            if($team_id == $space->id){

                //MISSIONS
                $event->sender->addItem(array(
                    'label' => Yii::t('MissionsModule.event', 'Missions'),
                    'group' => 'modules',
                    'url' => $space->createUrl('/missions/evidence/missions'),
                    'icon' => '<i class="fa fa-sitemap"></i>',
                    'sortOrder' => 400,
                    'isActive' => (Yii::$app->controller->module
                    && Yii::$app->controller->module->id == 'missions'
                    && Yii::$app->controller->id == 'evidence'),
                ));

                //REVIEW EVIDENCE
                $event->sender->addItem(array(
                    'label' => Yii::t('MissionsModule.event', 'Review Evidence'),
                    'group' => 'modules',
                    'url' => $space->createUrl('/missions/review/index'),
                    'icon' => '<i class="fa fa-thumbs-up" aria-hidden="true"></i>',
                    'sortOrder' => 500,
                    'isActive' => (Yii::$app->controller->module
                    && Yii::$app->controller->module->id == 'missions'
                    && Yii::$app->controller->id == 'review'

                    ),
                ));

                if(Setting::Get('enabled_evokation_page_visibility')){

                    //EVOKATION
                    $event->sender->addItem(array(
                        'label' => Yii::t('MissionsModule.event', 'Evokation'),
                        'group' => 'modules',
                        'url' => $space->createUrl('/missions/evokations/home'),
                        'icon' => '<i class="fa fa-users"></i>',
                        'sortOrder' => 300,
                        'isActive' => (Yii::$app->controller->module
                        && Yii::$app->controller->module->id == 'missions'
                        && Yii::$app->controller->id == 'evokations'),
                    ));
                }


            }
        }

    }

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onNewTopMenuInit($event)
    {

        $user = Yii::$app->user->getIdentity();

        if(isset($user)){

            // REVIEW EVIDENCE

            $team_id = Team::getUserTeam($user->id);
            // $space = $event->sender->space;
            $team = Team::findOne($team_id);        

            

                $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'Evidences to be reviewed'),
                'id' => 'evidence_reviewed',
                'icon' => '<i class="fa fa-thumbs-up" aria-hidden="true"></i>',
                'url' => Url::to(['/missions/review/list', 'sguid' => $team->guid]),
                'sortOrder' => 500,
                'isActive' => (Yii::$app->controller->module
                    && Yii::$app->controller->module->id == 'missions'
                    && 
                        ( 
                            Yii::$app->controller->id == 'review'
                            || (Yii::$app->controller->id == 'evidence' && Yii::$app->controller->action->id == 'mentor_activities' && Yii::$app->controller->action->id != 'review_evidence')
                            || Yii::$app->controller->action->id == 'mentor'
                        )
                    ),
                ));
           

        }
        
        
    }

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event)
    {

        $user = Yii::$app->user->getIdentity();

        if(isset($user)){

            // LEADERBOARD
            $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.event', 'Leaderboard'),
            'id' => 'leaderboard',
            'icon' => '<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>',
            'url' => Url::to(['/missions/leaderboard/index']),
            'sortOrder' => 700,
            'isActive' => (Yii::$app->controller->module
                && Yii::$app->controller->module->id == 'missions'
                && Yii::$app->controller->id == 'leaderboard'),
            ));

            // REVIEW EVIDENCE

            $team_id = Team::getUserTeam($user->id);

            $team = Team::findOne($team_id);        

            if(!$team && $user->group->name == "Mentors"){

                //MY TEAM
                $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'My Teams'),
                'id' => 'my_team',
                'icon' => '<i class="fa fa-users" aria-hidden="true"></i>',
                'url' => Url::to(['/missions/mentor/myteams']),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller
                    && Yii::$app->controller->id == 'mentor'
                    && Yii::$app->controller->action->id == 'myteams'
                    ),
                ));

                $team = Space::findOne(['name' => 'Mentors']);
                $review_evidence_link = $team->createUrl('/missions/evidence/mentor_activities');

            }else if($team){

                $review_evidence_link = Url::to(['/missions/review/index', 'sguid' => $team->guid]);

                //MY TEAM
                $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'My Team'),
                'id' => 'my_team',
                'icon' => '<i class="fa fa-users" aria-hidden="true"></i>',
                'url' => Url::to(['/space/space', 'sguid' => $team->guid]),
                'sortOrder' => 300,
                'isActive' => (Yii::$app->controller
                    && Yii::$app->controller->id == 'space'
                    && property_exists(Yii::$app->controller, "contentContainer")
                    && Yii::$app->controller->contentContainer->guid == $team->guid
                    ),
                ));

                //MISSIONS

                $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'Missions'),
                'id' => 'missions',
                'icon' => '<i class="fa fa-sitemap"></i>',
                'url' => $team->createUrl('/missions/evidence/missions'),
                'sortOrder' => 400,
                'isActive' => (Yii::$app->controller->module
                    && Yii::$app->controller->module->id == 'missions'
                    && Yii::$app->controller->id == 'evidence'),
                ));

            }

            if($team){


                $event->sender->addItem(array(
                'label' => Yii::t('MissionsModule.event', 'Review Evidence'),
                'id' => 'review_evidence',
                'icon' => '<i class="fa fa-thumbs-up" aria-hidden="true"></i>',
                'url' => $review_evidence_link,
                'sortOrder' => 500,
                'isActive' => (Yii::$app->controller->module
                    && Yii::$app->controller->module->id == 'missions'
                    && 
                        ( 
                            Yii::$app->controller->id == 'review'
                            || (Yii::$app->controller->id == 'evidence' && Yii::$app->controller->action->id == 'mentor_activities')
                            || Yii::$app->controller->action->id == 'mentor'
                        )
                    ),
                ));
            }

        }
        
        
    }

    public static function onProfileSidebarInit($event)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
           
            // if viewing other user profile
            if(Yii::$app->user->getIdentity()->id != $event->sender->user->id){
                $userPowers = UserPowers::getUserPowers(Yii::$app->user->getIdentity()->id);
                $event->sender->addWidget(PlayerStats::className(), ['powers' => $userPowers], array('sortOrder' => 9));
            }

            $event->sender->addWidget(PopUpWidget::className(), []);    
        }
        
    }  




    public function onTopMenuRun($event)  {
        // Remove Directory
        //$event->sender->deleteItemByUrl(\yii\helpers\Url::to(['/directory/directory'])); 
        // Remove Mail
        $event->sender->deleteItemByUrl(\yii\helpers\Url::to(['/mail/mail/index'])); 
    }

}
