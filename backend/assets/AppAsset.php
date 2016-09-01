<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       'css/font-awesome.min.css',
    	'template-editorlog/css/bootstrap.min.css',
//     	'template-editorlog/css/font-awesome.min.css',
    	'template-editorlog/css/smartadmin-production-plugins.min.css',
    	'template-editorlog/css/smartadmin-production.min.css',
    	'template-editorlog/css/smartadmin-skins.min.css',
//     	'template-editorlog/css/demo.min.css',
    ];
    public $js = [
//     		'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js',
//     		'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
    		'template-editorlog/js/app.config.js',
    		'template-editorlog/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js',
    		'template-editorlog/js/bootstrap/bootstrap.min.js',
    		'template-editorlog/js/notification/SmartNotification.min.js',
//     		'template-editorlog/js/demo.min.js',
    		'template-editorlog/js/app.min.js',
    		'js/main.js',
    		'template-editorlog/js/plugin/masked-input/jquery.maskedinput.min.js'
    		
    ];
    public $depends = [
       'yii\web\YiiAsset',
       'yii\bootstrap\BootstrapAsset',
    ];
}
