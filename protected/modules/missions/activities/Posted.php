<?php

namespace humhub\modules\missions\activities;

use humhub\modules\activity\components\BaseActivity;

class Posted extends BaseActivity
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'missions';

    /**
     * @inheritdoc
     */
    public $viewName = 'posted';

    /**
     * @inheritdoc
     */
    public function render($mode = self::OUTPUT_WEB, $params = array())
    {
        $post = $this->source;
        $postSource = $like->getSource();
        $params['preview'] = $this->getContentInfo($postSource);

        return parent::render($mode, $params);
    }

}
