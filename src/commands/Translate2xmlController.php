<?php

namespace stivehu\translate2xml\commands;

use stivehu\translate2xml\models\ConverterPhp;
use stivehu\translate2xml\models\ConverterPo;
use yii\console\Controller;

class Translate2xmlController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'help';

    /**
     * Display this help.
     */
    public function actionHelp()
    {
        $this->run('/help', [$this->id]);
    }

    /**
     * convert message file to xml
     */
    public function actionConvert2xml(string $importFile, string $language_id, string $filetype = 'php', $output = 'messages.xml')
    {
        switch ($filetype) {
            case 'php':
                $converter = new ConverterPhp();
                $converter->category = pathinfo($importFile, PATHINFO_FILENAME);
                break;
            case 'po':
                $converter = new ConverterPo();
                break;
            default:
                echo "Possible filetypes: php,po";
                exit;
                break;
        }
        $converter->filename = $importFile;
        $converter->language_id = $language_id;
        $converter->load();
        file_put_contents($output, $converter->exportTranslatesAsXml());

    }
}
