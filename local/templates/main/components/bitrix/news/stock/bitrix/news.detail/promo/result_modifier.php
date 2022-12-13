<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$og_image = ($arResult['DETAIL_PICTURE'] ? $arResult['DETAIL_PICTURE']['SRC'] : $arResult['PREVIEW_PICTURE']['SRC']);
$arResult['OG_IMAGE'] = ($og_image ? $og_image : false);

$this->__component->SetResultCacheKeys([
    'OG_IMAGE'
]);

?>
