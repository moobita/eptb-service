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
class LoginAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'login/bootstrap-3.3.6/css/bootstrap.min.css',
    	'login/assets/css/form-elements.css',
    	'login/assets/css/form-elements.css',
    	'login/assets/css/form-style.css',
    ];
    public $js = [
    		'login/assets/js/jquery-1.11.1.min.js',
    		'login/bootstrap-3.3.6/js/bootstrap.min.js',
    		'login/assets/js/jquery.backstretch.min.js',
    		'login/assets/js/scripts.js',
    		'login/js/joinable.js',
    		'login/js/resizeable.js',
    		'login/js/neon-api.js',    		
    		'login/js/jquery.validate.min.js',    		
    		'login/js/neon-login.js',    		
    		'login/js/neon-demo.js',
    ];
   /*

    
    */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
