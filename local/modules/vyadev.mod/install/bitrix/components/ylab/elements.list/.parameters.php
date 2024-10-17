<?php
/** @global CMain $APPLICATION */

use \Bitrix\Main\Loader;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

global $APPLICATION;

$arComponentParameters = array(
  "GROUPS" => array(
    "DATA_SOURCE" => array(
      "NAME" => 'Источник данных',
      "SORT" => 200,
    ),
    "CACHE" => array(
      "NAME" => 'Настройки кеширования',
      "SORT" => 800,
    )
  ),
);

$arComponentParameters["PARAMETERS"] = array(
    "IBLOCK_CODE" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => 'Код инфоблока',
      "TYPE" => "STRING",
      "DEFAULT" => "",
      "REFRESH" => "N",
    ),
    "ELEMENTS" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => "Какие элементы выводить",
      "TYPE" => "LIST",
      "DEFAULT" => "",
      "REFRESH" => "N",
//      "VALUES" => array(
//        ">=DATE_ACTIVE_TO" => "актуальные",
//        "<DATE_ACTIVE_TO" => "просроченные",
//      ),
      "VALUES" => array(
        "Y" => "активные",
        "N" => "неактивные",
      ),
    ),
    "CACHE_TIME" => array(
      "DEFAULT" => 3600,
    )
);

