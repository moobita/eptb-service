<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\LoginAppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

LoginAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>
.navbar-right > li {
    float: left;
    margin-right: 0px; 
}
</style>
<body>
<?php $this->beginBody() ?>
<body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                         <div class="col-md-12">
                            <center><img src="image/logo_swu_R2.png" width="40%"></center>
                        </div>

                        <!--<div class="col-sm-8 col-sm-offset-2 text">
                              <p class="login-title text-center">ระบบจัดข้อสอบ</p>
                        </div>-->
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        			<p class="login-title-form text-center">Please Login</p>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                   
			                    <?=$content?>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>