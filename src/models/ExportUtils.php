<?php


namespace stivehu\translate2xml\models;


use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use yii\base\BaseObject;

class ExportUtils extends BaseObject
{
    public $category = 'app';
    public $language_id = 'en-GB';
    public $filename = null;
    protected $translates = null;

    public function exportTranslatesAsXml(): string
    {
        $languages = LanguageUtils::getLanguageFromId($this->language_id);

        $languageSources = [];
        $LanguageTranslates = [];

        $oXMLWriter = new XMLWriter();
        $oXMLWriter->openMemory();
        $oXMLWriter->startDocument('1.0', 'UTF-8');
        $oXMLWriter->startElement('translations');
        $oXMLWriter->startElement('languages');
        $oXMLWriter->startElement('Language');
        foreach (LanguageUtils::getLanguageFromId('en-GB') as $__language => $_language) {
            $oXMLWriter->writeElement($__language, $_language);
        }
        $oXMLWriter->endElement();//Language
        $oXMLWriter->startElement('Language');
        foreach ($languages as $__language => $_language) {
            $oXMLWriter->writeElement($__language, $_language);
        }
        $oXMLWriter->endElement();//Language
        $oXMLWriter->endElement();//languages
        $oXMLWriter->startElement('languageSources');

        $id = 1;
        $LanguageTranslate = new XMLWriter();
        $LanguageTranslate->openMemory();
        foreach ($this->translates as $__category => $_category) {
            foreach ($_category as $__translation => $_translation) {
                $oXMLWriter->startElement('LanguageSource');
                $oXMLWriter->writeElement('id', $id++);
                $oXMLWriter->writeElement('category', $__category);
                $oXMLWriter->writeElement('message', $__translation);
                $oXMLWriter->endElement();//LanguageSource
                if (empty($_translation) === false) {
                    $LanguageTranslate->startElement('LanguageTranslate');
                    $LanguageTranslate->writeElement('id', $id - 1);
                    $LanguageTranslate->writeElement('language', $languages['language_id']);
                    $LanguageTranslate->writeElement('translation', $_translation);
                    $LanguageTranslate->endElement();//LanguageTranslate
                }

            }}
        $oXMLWriter->endElement();//LanguageSource
        $oXMLWriter->startElement('languageTranslations');
        $oXMLWriter->writeRaw($LanguageTranslate->outputMemory(true));
        $oXMLWriter->endElement();//languageTranslates
        $oXMLWriter->endElement();//languageTranslations
        $oXMLWriter->endElement();//languageSources
        $oXMLWriter->endElement();//languages
        $oXMLWriter->endElement();//translations
        return ($oXMLWriter->outputMemory(TRUE));
    }
}