<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$res = CIBlockElement::GetList(
        [ 'SORT' => 'ASC' ],
        ['IBLOCK_TYPE' => 'seo', 'IBLOCK_CODE' => 'seo', 'CODE' => 'promo_page'],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_OG_IMAGE'],
);

if ($arSeo = $res->Fetch()) {
    $arResult['OG_IMAGE'] = ($arSeo['PROPERTY_OG_IMAGE_VALUE'] ? CFile::GetPath($arSeo['PROPERTY_OG_IMAGE_VALUE']) : false);
}

$this->__component->SetResultCacheKeys([
    'OG_IMAGE'
]);

?>