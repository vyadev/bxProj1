<?php
namespace Vyadev\Mod\Helper;

use Bitrix\Iblock\IblockTable;

class IblockId
{
  public static function getIblockIdByCode(string $code): int
  {
    $iblock = IblockTable::getList([
      'filter' => [
        'CODE' => $code,
      ],
      'select' => [
        'ID',
        'CODE',
      ],
    ])->fetch();

    if (!isset($iblock['ID'])) {
      throw new Exception("Не найден инфоблок с кодом {$code}");
    }

    return (int)$iblock['ID'];
  }
}
