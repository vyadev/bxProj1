<?php

namespace Vyadev\Mod\Orm;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main;

class CarTable extends DataManager
{
  public static function getTableName()
  {
    return 'vyadev_cars';
  }

  public static function getMap()
  {
    return [
      'ID'             => new IntegerField("ID", [
        "primary"      => true,
        "autocomplete" => true,
      ]),
      'BRAND'   => new StringField('BRAND', [
        'title' => Loc::getMessage('CAR_TABLE_FIELD_BRAND'),
      ]),
      'MODEL'   => new StringField('MODEL', [
        'title' => Loc::getMessage('CAR_TABLE_FIELD_MODEL'),
      ]),
      'DATE'   =>  new DateField('DATE', [
        'default_value' => function () {
          return new Main\Type\DateTime();
        },
        'title' => Loc::getMessage('CAR_TABLE_FIELD_DATE'),
      ]),
      'CAPACITY' => new IntegerField('CAPACITY', [
        'title' => Loc::getMessage('CAR_TABLE_FIELD_CAPACITY'),
      ]),
      'COLOR_ID' => new IntegerField('COLOR_ID', [
        'title' => Loc::getMessage('CAR_TABLE_FIELD_COLOR_ID'),
      ]),
      'COLOR' => new Reference('COLOR',
        ColorTable::class,
        Join::on('this.COLOR_ID', 'ref.ID')
      ),
      'IS_COMMERCIAL' => new BooleanField('IS_COMMERCIAL', [
        'values' => ['N', 'Y'],
        'default_value' => 'Y',
        'title' => Loc::getMessage('CAR_TABLE_FIELD_IS_COMMERCIAL'),
      ]),
    ];
  }
}
