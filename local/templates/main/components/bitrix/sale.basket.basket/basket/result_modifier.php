<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arResult['ITEMS_INFO'] = [];
$arResult['ITEMS_KIT'] = [];
$arResult['ITEM_BASKET'] = [];

$hideProduct = [];
foreach ($arResult['GRID']['ROWS'] as $key => &$arItem) {
    if ($arItem['NOT_AVAILABLE']) {
        CSaleBasket::Delete($arItem['ID']);
        continue;
    }

    if ($arItem['PROPS_ALL']['BOX']) {
        $hideProduct[$arItem['PROPS_ALL']['BOX']['VALUE']] = [];
    }
}

foreach ($arResult['GRID']['ROWS'] as $key => $row) {
    if (isset($hideProduct[$row['PRODUCT_ID']])) {
        $hideProduct[$row['PRODUCT_ID']] = [
            'PRICE' => $row['PRICE'],
            'NAME' => $row['NAME']
        ];

        unset($arResult['GRID']['ROWS'][$key]);
    }
}

foreach ($arResult['GRID']['ROWS'] as $key => $row) {

    if (!$row['PROPS_ALL']['POINT']) {
        $box_items = [];

        $resElem = CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => $row['IBLOCK_ID'], 'ID' => $row['PRODUCT_ID']],
            false,
            false,
            []
        );
        $sub_title = 'Дверь';
        if ($obElem = $resElem->GetNextElement()) {
            $arElem = $obElem->GetFields();
            $arProp = $obElem->GetProperties();

            $image = ($arElem['PREVIEW_PICTURE']) ? CFile::GetPath($arElem['PREVIEW_PICTURE']) : CFile::GetPath($arElem['DETAIL_PICTURE']);
            if ($arProp['KIT']['VALUE']) {

                foreach ($arResult['GRID']['ROWS'] as $k => $r) {
                    if ($r['PROPS_ALL']['POINT']) {
                        $point_str = explode("_", $r['PROPS_ALL']['POINT']['VALUE']);
                        $item_id = $point_str[1];
                        if ($arElem['ID'] == $item_id) {
                            $resParSect = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 3, 'DEPTH_LEVEL' => 2, 'HAS_ELEMENT' => $r['PRODUCT_ID']), false, array('ID', 'NAME'));
                            if ($arParSect = $resParSect->Fetch()) {
                                foreach ($arProp['KIT']['VALUE'] as $idKit) {
                                    if ($idKit == $arParSect['ID']) {
                                        $kit = $arParSect['NAME'];
                                        $kitId = $arParSect['ID'];
                                        $sub_title = $sub_title . ' + набор ' . $arParSect['NAME'];
                                    }
                                }
                            }
                        }
                    }
                }
            }


            $resSect = CIBlockSection::GetList(
                array(),
                array('IBLOCK_ID' => 3, 'HAS_ELEMENT' => $arProp['CML2_LINK']['VALUE']),
                false,
                array('UF_SIZE_MIN', 'UF_SIZE_MAX', 'DETAIL_PICTURE'),
                false
            );


            if ($arSect = $resSect->Fetch()) {

                $size['MIN'] = $arSect['UF_SIZE_MIN'];
                $size['MAX'] = $arSect['UF_SIZE_MAX'];
            }
            $resElemModel = CIBlockElement::GetList(
                [],
                ['IBLOCK_ID' => 3, 'ID' => $arProp['CML2_LINK']['VALUE']],
                false,
                false,
                ['ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_KIT', 'PROPERTY_CML2_LINK', 'PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD']
            );

            if ($arModel = $resElemModel->Fetch()) {

                $image = ($image ? $image : CFile::GetPath($arModel['DETAIL_PICTURE']));

                if ($row['PROPS_ALL']['BOX']) {
                    $resBox = CIBlockElement::GetList(
                            array(),
                            array('ID' => $row['PROPS_ALL']['BOX']['VALUE']),
                        false,
                        false,
                        array('ID', 'NAME')
                    );
                    if ($arBox = $resBox->Fetch()){
                        $box = $arBox['NAME'];
                        $sub_title = $sub_title . ' + ' . $arBox['NAME'];
                    }
                }
            }

            $cml_2_link = $arProp['CML2_LINK']['VALUE'];
        }

        $arResult['ITEMS_INFO'][$row['ID']] = [
            'ID' => $row['ID'],
            'PRODUCT_ID' => $row['PRODUCT_ID'],
            'NAME' => $row['NAME'],
            'QUANTITY' => $row['QUANTITY'],
            'ID_KIT' => $kitId,
            'NAME_KIT' => $kit,
            'NAME_BOX' => ($box ?: ''),
            'CML2_LINK' => $cml_2_link,
            'SIZE' => ($size ? $size : false),
            'IMAGE' => ($image ? $image : '/upload/image_not_found.png'),
            'SUB_TITLE' => $sub_title,
            'TEST' => $arModel,
            'TEST2' => $row['PROPS_ALL']['BOX']['VALUE'],
        ];

    } else {
        $point_str = explode("_", $row['PROPS_ALL']['POINT']['VALUE']);
        $item_id = $point_str[1];
        $arResult['ITEMS_' . $point_str[0]][$item_id][] = $row;
    }
    if ($row['PROPS_ALL']['POINT']) {
        $point_str = explode("_", $row['PROPS_ALL']['POINT']['VALUE']);
        $item_id = $point_str[1];
    }
}

$arResult['ITEMS'] = [];
$total_item_price = 0;
$total_count = 0;

foreach ($arResult['GRID']['ROWS'] as $item) {
    $sub_items = [];
    $total_item_price = 0;

    if (!$item['PROPS_ALL']['POINT']) {
        $sub_items[] = [
            "name" => $item['NAME'],
            "price" => $item['FULL_PRICE'],
            "price_formatted" => $item['FULL_PRICE_FORMATED'],
            "count" => $item['QUANTITY'],
        ];

        $total_item_price = $item['PRICE'] * $item['QUANTITY'];

        foreach ($arResult['GRID']['ROWS'] as $kit) {
            if ($kit['PROPS_ALL']['POINT']['VALUE'] == 'kit_' . $item['PRODUCT_ID']) {
                $kit_full_price = number_format($kit['FULL_PRICE'], 0, '', '&nbsp;') . '&nbsp₽';
                $sub_items[] = [
                    "name" => $kit['NAME'],
                    "price" => $kit['FULL_PRICE'],
                    "price_formatted" => $kit_full_price,
                    "count" => $kit['QUANTITY'],
                ];

                $total_item_price += $kit['FULL_PRICE'] * $kit['QUANTITY'];
            }
        }

        if ($item['PROPS_ALL']['BOX']) // коробка
        {
            $priceBox = $hideProduct[$item['PROPS_ALL']['BOX']['VALUE']]['PRICE'];
            $total_item_price += ($hideProduct[$item['PROPS_ALL']['BOX']['VALUE']]['PRICE'] * $item['PROPS_ALL']['BOX_COUNT']['VALUE']);

            $sub_items[] = [
                "name" => $hideProduct[$item['PROPS_ALL']['BOX']['VALUE']]['NAME'],
                "price" => $priceBox,
                "price_formatted" => (number_format($priceBox, 0, '', '&nbsp;') . '&nbsp₽'),
                "count" => $item['PROPS_ALL']['BOX_COUNT']['VALUE'],
            ];
        }

        $total_item_price_formatted = number_format($total_item_price, 0, '', '&nbsp;') . '&nbsp₽';
        $arResult['ITEMS']['items'][] = [
            "name" => "Дверь",
            "price" => $total_item_price,
            "price_formatted" => $total_item_price_formatted,
            "sub_item" => $sub_items,
        ];

        $arResult['ITEMS_INFO'][$item['ID']]['TOTAL_ITEM_PRICE_FORMATTED'] = $total_item_price_formatted;
        $arResult['ITEMS_INFO'][$item['ID']]['TOTAL_ITEM_PRICE'] = $total_item_price;
        $total_count += $item['QUANTITY'];
        if ($arParams['ITEM_SKU_ID'] == $item['PRODUCT_ID']) {
            $arResult['ITEM_BASKET_ID'] = $item['ID'];
            $arResult['ITEMS']['basket_item_id'] = $item['ID'];
            $arResult['ITEMS']['ITEM_BASKET'] = [
                'basket_sub_title' => $arResult['ITEMS_INFO'][$item['ID']]['SUB_TITLE'],
                'quantity' => $item['QUANTITY'],
                'price' => $total_item_price,
                'test' => $arResult['ITEMS_INFO'],
            ];
        }
    }
}
$arResult['ITEMS']['total_count'] = $total_count;
$arResult['ITEMS']['total'] = $arResult['allSum'];

$arResult['RESULT'] = $arResult['ITEMS'];

$this->__component->SetResultCacheKeys(['RESULT']);

?>

<script>
    var test2 = <?=CUtil::PhpToJSObject($arResult)?>;
    console.log(test2);
</script>
