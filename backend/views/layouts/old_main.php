<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>SWUT | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    
    
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
    	NavBar::begin([
    			'brandLabel' => 'SWUT | สำนักทดสอบทางการศึกษาและจิตวิทยา',
    			'brandUrl' => Yii::$app->homeUrl,
    			'options' => [
    					'class' => 'navbar-inverse navbar-fixed-top',
    			],
    	]);
    	//     $menuItems = [
    	//         ['label' => 'Home', 'url' => ['/site/index']],
    	//     ];
    	$menuItems[] = ['label' => 'บันทึกข้อมูลการบริการสอบ', 'url' => ['/trn-edu-testing/create']];
   		$menuItems[] = ['label' => 'เลือกแบบทดสอบ', 'url' => ['/']];
   		$menuItems[] = ['label' => 'รายชื่อผู้ใช้งาน', 'url' => ['/user']];
    	$menuItems[] = ['label' => 'ฐานข้อมูลกลาง', 
    			'url' => ['/user'],
    			'items' => [
    					['label' => 'หน่วยงาน', 'url' => [ '/ms-institution']],
    					['label' => 'ประเภทหน่วยงาน', 'url' => ['/ms-institution-type']],
    					['label' => 'จังหวัด', 'url' => ['/ms-province']],
    					['label' => 'วัตถุประสงค์ในการสอบ', 'url' => ['/ms-objective']],
    					['label' => 'ประเภทของแบบทดสอบ', 'url' => ['/ms-test-type']],
    					['label' => 'วิทยากร', 'url' => ['/ms-lecturer']],
    					['label' => 'ระดับการศึกษา', 'url' => ['/ms-edu-level']],
    			],
    	];    	
    	
    	$menuItems[] = '<li>'
    		. Html::beginForm(['#'], 'post')
    		. Html::submitButton(
    				'<span class="glyphicon glyphicon-user" aria-hidden="true"></span> ' . Yii::$app->user->identity->username,
    				['class' => 'btn btn-link']
    				)
    		. Html::endForm()
    		. '</li>';
        
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                '<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> '.'Logout',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    }
    
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php 
if (Yii::$app->user->isGuest) {}
else{
?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; SWUT <?= date('Y') ?></p>

        <!--<p class="pull-right"><?/**= Yii::powered()*/ ?></p>-->
    </div>
</footer>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
