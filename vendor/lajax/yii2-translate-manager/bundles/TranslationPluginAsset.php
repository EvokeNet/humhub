<?php

namespace lajax\translatemanager\bundles;

use yii\web\AssetBundle;

/**
 * Translation Plugin asset bundle
 * 
 * @author Lajos Molnár <lajax.m@gmail.com>
 * @since 1.0
 */
class TranslationPluginAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@lajax/translatemanager/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'javascripts/md5.js',
        'javascripts/lajax.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'lajax\translatemanager\bundles\LanguageItemPluginAsset',
    ];

}
