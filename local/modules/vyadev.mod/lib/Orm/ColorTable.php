<?php

namespace Vyadev\Mod\Orm;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;

class ColorTable extends DataManager
{
  public static function getTableName()
  {
    return 'vyadev_colors';
  }

  public static function getMap()
  {
    return [
      'ID'             => new IntegerField("ID", [
        "primary"      => true,
        "autocomplete" => true,
      ]),
      'NAME'   => new StringField('NAME', [
        'title' => Loc::getMessage('COLOR_TABLE_FIELD_NAME'),
      ]),
      'CODE'   => new StringField('CODE', [
        'title' => Loc::getMessage('COLOR_TABLE_FIELD_CODE'),
      ]),
    ];
  }
}
