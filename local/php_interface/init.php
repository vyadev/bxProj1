<?
use Bitrix\Main\Loader;
use Vyadev\Mod\Helper\SymbolicCode;

Loader::requireModule('iblock');

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", [SymbolicCode::class, 'generateSymbolicCode']);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", [SymbolicCode::class, 'generateSymbolicCode']);



