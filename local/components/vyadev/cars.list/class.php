<?php
/** @global CMain $APPLICATION */

use Vyadev\Mod\Orm\CarTable;
use Vyadev\Mod\Orm\ColorTable;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

class ElementsList extends \CBitrixComponent
{
  public function onPrepareComponentParams($arParams)
  {
    return $arParams;
  }

  public function executeComponent()
  {
    $arParams = &$this->arParams;
    $arResult = &$this->arResult;

    if ($this->startResultCache()) {

      $colorsCollection = ColorTable::query()->setSelect(['*'])->fetchCollection();

      $arResult['COLOR_NAMES'] = $colorsCollection->getNameList();

      $arFilter = [];
        // Три варианта фильтра
//      $arFilter = ['IS_COMMERCIAL' => 'Y'];
//      $arFilter = ['>DATE' => (new \Bitrix\Main\Type\Date())->add('-5years')];
//      $color = 'white';
      if (isset($color)) {
        $colorItem = ColorTable::query()
          ->setSelect(['ID'])
          ->setFilter(['CODE' => $color])
          ->fetch();
        $arFilter = ['COLOR_ID' => $colorItem['ID']];
      }

      $carItems = CarTable::query()
        ->setSelect(['*'])
        ->setFilter($arFilter)
        ->fetchAll();

      foreach ($carItems as &$carItem) {
        foreach ($colorsCollection as $colorObj) {
          if ($carItem['COLOR_ID'] == $colorObj->getId()) {
            $carItem['COLOR'] = $colorObj->getName();
            $arResult['CARS'][] = $carItem;
          }
        }
      }

      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }
  }
}