<?php

namespace app\controllers;

use Yii;
use app\models\Cura;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DownloadController extends Controller
{
    public function downloadFromText($fileName, $content, $base64encoded = false)
    {
        $filePath = Yii::getAlias("@uploads/") . $fileName;
        file_put_contents($filePath, $base64encoded ? base64_decode($content) : $content);
        if (!file_exists($filePath)) throw new NotFoundHttpException("The file is not found on the server");
        return Yii::$app->response->sendFile($filePath, $fileName, ["mimeType" => "application/pdf"]);
    }

    public function downloadFromFile($fileName)
    {
        $filePath = Yii::getAlias("@uploads/") . $fileName . ".pdf";
        if (!file_exists($filePath)) throw new NotFoundHttpException("The file is not found on the server");
        return Yii::$app->response->sendFile($filePath, null, ["mimeType" => "application/pdf"]);
    }

    public function actionDownloadDiagnosi($id, $fileName)
    {
        $content = Cura::findOne($id)->diagnosi;
        return self::downloadFromText($fileName, $content, true);
    }

    public function actionDownloadTestBvl()
    {
        return self::downloadFromFile("testBvl");
    }
}
