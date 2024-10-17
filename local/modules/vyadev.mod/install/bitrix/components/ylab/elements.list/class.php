<?php
/** @global CMain $APPLICATION */

use \Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

class ElementsList extends \CBitrixComponent
{
//  public function onPrepareComponentParams($arParams)
//  {
//    return $arParams;
//  }

  public function executeComponent()
  {
    $arParams = &$this->arParams;
    $arResult = &$this->arResult;

    Loader::includeModule('iblock');

    if ($this->startResultCache()) {

      // фильтр по дате
//      $filter = [
//        'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
//        htmlspecialchars_decode($arParams['ELEMENTS']) => ConvertTimeStamp(false, 'FULL'),
//      ];
//      или написать условие по строковому параметру в parameters.php и подставить в фильтр (без htmlspecialchars_decode)

      // фильтр по полю активности
      $filter = [
        'IBLOCK_CODE' => $arParams['IBLOCK_CODE'],
        'ACTIVE' => $arParams['ELEMENTS'],
      ];

      $dbItems = CIBlockElement::GetList(
        [],
        $filter,
        false,
        false,
        [
          'IBLOCK_ID',
          'ID',
          'NAME',
        ]
      );
      $arResult = [];
      while ($arItem = $dbItems->Fetch()) {
        $arResult['ITEMS'][] = $arItem;
      }

      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }
  }
}