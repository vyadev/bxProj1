<?

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Localization\Loc;
?>
<p><?=Loc::getMessage('CAR_COLOR_LIST')?> <?echo implode(', ', $arResult["COLOR_NAMES"]);?></p>
<?foreach($arResult["CARS"] as $arItem):?>
    <p><?=Loc::getMessage('CAR_BRAND')?> <?echo $arItem["BRAND"]?></p>
    <p><?=Loc::getMessage('CAR_MODEL')?> <?echo $arItem["MODEL"]?></p>
    <p><?=Loc::getMessage('CAR_DATE')?> <?echo $arItem["DATE"]?></p>
    <p><?=Loc::getMessage('CAR_CAPACITY')?> <?echo $arItem["CAPACITY"]?></p>
    <p><?=Loc::getMessage('CAR_COLOR')?> <?echo $arItem["COLOR"]?></p>
    <p><?=Loc::getMessage('CAR_IS_COMMERCIAL')?> <?echo ($arItem["IS_COMMERCIAL"] == 'Y') ?
          (Loc::getMessage('CAR_YES')) : (Loc::getMessage('CAR_NO'))?></p>
  <hr>
<?endforeach;?>


