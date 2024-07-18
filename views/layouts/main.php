<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap4\Nav;
use app\assets\AppAsset;
use yii\bootstrap4\Html;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Dropdown;
use yii\bootstrap4\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],

        ]);
        echo Nav::widget([
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                [
                    'label' => 'Pannello di controllo',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "logopedista",
                    'url' => ['logopedista/utente/index']
                ],
                [
                    'label' => 'Esercizi',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "logopedista",
                    'url' => ['logopedista/esercizi/index']
                ],
                [
                    'label' => 'Pannello di controllo',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "caregiver",
                    'url' => ['caregiver/utente/index']
                ],
                [
                    'label' => 'Pannello di controllo',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "utente",
                    'url' => ['utente/utente/index']
                ],
                [
                    'label' => 'Esercizi',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "utente",
                    'url' => ['utente/terapia/index']
                ],
                [
                    'label' => 'Esercizi utente',
                    "visible" => !Yii::$app->user->isGuest && Yii::$app->user->identity->tipoAttore === "caregiver",
                    'url' => ['caregiver/terapia/index']
                ],
                [
                    'label' => 'TestBVL',
                    'url' => ["site/test-bvl"],
                    "visible" => Yii::$app->user->isGuest,
                ],
                [
                    'label' => 'Contattaci',
                    'url' => ["site/contact"],
                    "visible" => Yii::$app->user->isGuest,
                ],
                [
                    'label' => 'Login',
                    'url' => ["site/login"],
                    "visible" => Yii::$app->user->isGuest,
                    "options" => ["class" => "ml-auto"]
                ],
                [
                    'label' => isset(Yii::$app->user->identity) ? Yii::$app->user->identity->username : "",
                    "visible" => !Yii::$app->user->isGuest,
                    "options" => ["class" => "ml-auto"],
                    'items' => [
                        ['label' => 'Logout', 'url' => ['site/logout']],
                    ]
                ],

            ],
            'options' => ['class' => 'navbar-nav w-100'],

        ]);
        NavBar::end();
        ?>

    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-left">&copy; Pronuntia <?= date('Y') ?></p>
            <p class="float-right"><?= "Powered by GC" ?></p>
        </div>
    </footer>



    <?php $this->endBody() ?>
</body>



</html>
<?php $this->endPage() ?>