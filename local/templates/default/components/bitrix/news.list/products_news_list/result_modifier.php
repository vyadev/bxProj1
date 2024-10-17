<?

$sections_id = array();
foreach ($arResult["ITEMS"] as $arItem) {
  $sections_id[] = $arItem["IBLOCK_SECTION_ID"];
}

$rsSections = CIBlockSection::GetList(array("SORT" => "ASC"),
  array("IBLOCK_ID" => $arResult["ID"], "ID" => $sections_id),
  false, array("NAME", "ID"));

while ($arSection = $rsSections->GetNext()) {
  foreach ($arResult["ITEMS"] as &$arItem) {
    if ($arItem["IBLOCK_SECTION_ID"] == $arSection["ID"]) {
      $arItem["SECTION_NAME"] = $arSection["NAME"];
    }
  }
}

