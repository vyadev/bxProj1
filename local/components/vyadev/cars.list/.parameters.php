<?php
/** @global CMain $APPLICATION */

use \Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
  die();
}

global $APPLICATION;

$arComponentParameters = array(
  "GROUPS" => array(
    "DATA_SOURCE" => array(
      "SORT" => 200,
    ),
    "CACHE" => array(
      "SORT" => 800,
    ),
  ),
);

$arComponentParameters["PARAMETERS"] = array(
    "CACHE_TIME" => array(
      "DEFAULT" => 3600,
    )
);

