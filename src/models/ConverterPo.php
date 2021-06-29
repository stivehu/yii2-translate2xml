<?php


namespace stivehu\translate2xml\models;


use yii\i18n\GettextPoFile;

class ConverterPo extends ExportUtils
{
    /**
     *
     */
    public function load()
    {
        $gettextFile = new GettextPoFile();
        $translates = [];
        foreach ($this->listContexts() as $_listContext) {
            $translates[$_listContext] =  $gettextFile->load($this->filename, $_listContext);
        }

        $this->translates = $translates;
    }

    public function listContexts()
    {
        $searchthis = 'msgctxt';
        $matches = array();

        $handle = @fopen($this->filename, 'r');
        if ($handle) {
            while (!feof($handle)) {
                $buffer = fgets($handle);
                if (strpos($buffer, $searchthis) !== FALSE)
                    $matches[] = str_replace(['"'," ","\n"], '', str_replace('msgctxt', '', $buffer));
            }
            fclose($handle);
        }
        $matches = array_unique($matches);
        return ($matches);
    }


}