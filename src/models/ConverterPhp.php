<?php

namespace stivehu\translate2xml\models;

use PhpOffice\PhpSpreadsheet\Shared\XMLWriter;
use yii\base\BaseObject;

class ConverterPhp extends ExportUtils
{
    /**
     *
     */
    public function load():void
    {
        $this->translates[$this->category] = require($this->filename);
    }

    /**
     * @return array|null
     */
    public function getTranslates(): ?array
    {
        return $this->translates;
    }


}