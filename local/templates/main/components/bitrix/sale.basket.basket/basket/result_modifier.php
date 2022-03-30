<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


foreach ($arResult['GRID']['ROWS'] as $key=>$row){
    $resProduct = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => $row['IBLOCK_ID'], 'ID' => $row['PRODUCT_ID']),
        false,
        false,
        array('PROPERTY_CML2_LINK')
    );

    if ($arProduct = $resProduct->Fetch()){
        $resSect = CIBlockSection::GetList(
            array(),
            array('IBLOCK_ID' => 3, 'HAS_ELEMENT' => $arProduct['PROPERTY_CML2_LINK_VALUE']),
            false,
            array('UF_SIZE_MIN', 'UF_SIZE_MAX'),
            false
        );
        if ($arSect = $resSect->Fetch()){
            $arResult['GRID']['ROWS'][$key]['SIZE']['MIN'] = $arSect['UF_SIZE_MIN'];
            $arResult['GRID']['ROWS'][$key]['SIZE']['MAX'] = $arSect['UF_SIZE_MAX'];
        }
        $arResult['GRID']['ROWS'][$key]['CML2_LINK'] = $arProduct['PROPERTY_CML2_LINK_VALUE'];

    }

}


