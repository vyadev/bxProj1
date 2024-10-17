<?php
namespace Vyadev\Mod\Helper;

use Bitrix\Iblock\ElementTable;

class SymbolicCode
{
  public static function generateSymbolicCode(&$arFields)
  {
    if ($arFields['IBLOCK_ID'] == IblockId::getIblockIdByCode('access_to_a_section') &&     !$arFields['CODE']) {

      $dbItems = ElementTable::query()
        ->setFilter([
          'IBLOCK_ID' => IblockId::getIblockIdByCode('access_to_a_section'),
          'ACTIVE' => 'Y',
        ])
        ->setSelect(['CODE'])
        ->fetchAll();

      $arCodes = [];
      foreach ($dbItems as $arItem) {
        if (!($arItem['CODE'])) {
          continue;
        }
        $arCodes[] = $arItem['CODE'];
      }

      do {
        $randCode = \Bitrix\Main\Security\Random::getString(10);
      } while (in_array($randCode, $arCodes));
      $arFields['CODE'] = $randCode;
    }
  }
}
