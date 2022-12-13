<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['RESULT'] = [];
foreach ($arResult['SECTIONS'] as $section) {
    if ($section['CODE'] !== 'dekor') {
        $arResult['RESULT'][] = [
            'link' => $section['SECTION_PAGE_URL'],
            'image' => $section['PICTURE']['SRC'],
            'name' => $section['NAME'],
        ];
    }
}



$res = CIBlockElement::GetList(
    [ 'SORT' => 'ASC' ],
    ['IBLOCK_TYPE' => 'seo', 'IBLOCK_CODE' => 'seo', 'CODE' => 'main_page'],
    false,
    false,
    ['ID', 'NAME', 'PROPERTY_OG_IMAGE'],
);

if ($arSeo = $res->Fetch()) {
    $arResult['OG_IMAGE'] = ($arSeo['PROPERTY_OG_IMAGE_VALUE'] ? CFile::GetPath($arSeo['PROPERTY_OG_IMAGE_VALUE']) : false);
}



$this->__component->SetResultCacheKeys(['RESULT', 'OG_IMAGE']);
?>