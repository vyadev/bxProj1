<?php
namespace Vyadev\Mod;

use Bitrix\Iblock\ElementTable;
use Vyadev\Mod\Helper\IblockId;
use CIBlockElement;

class ClearElementsAgent
{
  public static function clearNotActualElements()
  {
    $dbItems = ElementTable::query()
      ->setFilter([
        'IBLOCK_ID' => IblockId::getIblockIdByCode('access_to_a_section'),
        'ACTIVE' => 'Y',
        '<ACTIVE_TO' => ConvertTimeStamp(false, 'FULL'),
      ])
      ->setSelect(['ID'])
      ->fetchAll();

    $el = new CIBlockElement;
    foreach ($dbItems as $arItem) {
      $el->Update($arItem['ID'], ['ACTIVE' => 'N']);
//  $el::Delete($arItem['ID']);
    }

    return "Vyadev\Mod\ClearElementsAgent::clearNotActualElements();";
  }
}
