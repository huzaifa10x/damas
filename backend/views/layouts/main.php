<?php
/** @var \yii\web\View $this */

/** @var string $content */
use backend\assets\AppAsset;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);
$controler = Yii::$app->controller->id;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="noindex,nofollow,noarchive" />
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script src="<?= Yii::$app->homeUrl ?>js/jquery.min.js"></script>
        <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>images/favicon.ico" />
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="main-wrapper">

            <!-- partial:partials/_sidebar.html -->
            <?php echo $this->render('@app/views/layouts/partials/_sidebar'); ?>

            <!-- partial -->

            <div class="page-wrapper">

                <!-- partial:partials/_navbar.html -->
                <?php echo $this->render('@app/views/layouts/partials/_navbar'); ?>
                <!-- partial -->


                    <?= $content ?>


                <!-- partial:partials/_footer.html -->
                <?php echo $this->render('@app/views/layouts/partials/_footer'); ?>

                <!-- partial -->

            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
