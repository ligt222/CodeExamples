<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arProp = [
    'IBLOCK_ID' => 4,
    'PROPERTY_CML2_LINK' => $_REQUEST['id'],
];


$resultProduct = [];
$arElemnts = [];
$arResult['RESULT_FILTER'] = [];

$arResult['RESULT_FILTER']['items'] = [];
$filters = [];

$box = false;

if ( $_REQUEST['id'] && $_REQUEST['sku-id']) {
    $resProductItem = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => 3, 'ID' => $_REQUEST['id']],
        false,
        false,
        ['PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD']
    );
    $resProductItem = $resProductItem->GetNext();

    if ( $resProductItem['PROPERTY_BOX_TRESHOLD_VALUE'] || $resProductItem['PROPERTY_BOX_NOT_TRESHOLD_VALUE'] ) {
        $box = true;
    }

    $resProduct = CIBlockElement::GetByID($_REQUEST['sku-id']);
    if ($obProduct = $resProduct->GetNextElement()){
        $el = $obProduct->GetFields();
        $prop = $obProduct->GetProperties();
        $arResult['ITEM']['FIELDS'] = $el;
        $arResult['ITEM']['PROP'] = $prop;
    }

    $price = 0; //
    if ($resPrice = CPrice::GetBasePrice($el['ID'])){
        $price = (int)$resPrice['PRICE'];
    }

    $basket_quantity = 0;
    $basket_sub_title = 'Дверь';
    $arBasketItems = [];
    $dbBasketItems = CSaleBasket::GetList(
        [],
        [
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ],
        false,
        false,
        ["ID", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT", 'PROPERTY_POINT']
    );
    while ($arItems = $dbBasketItems->Fetch())
    {
        $arResult['BASKET'][$arItems['PRODUCT_ID']] = $arItems['QUANTITY'];
        if ( $arItems['PRODUCT_ID'] == $arResult['ITEM']['FIELDS']['ID'] ) {
            $basket_quantity = $arItems['QUANTITY'];
            if ( $arResult['ITEM']['PROP']['KIT']['VALUE'] ) {
                $resKitSect = CIBlockSection::GetList(array(), array('ID' => $arResult['ITEM']['PROP']['KIT']['VALUE']), false, array('ID', 'NAME'));

                if ($arKitSect = $resKitSect->Fetch()){
                    $kit = $arKitSect['NAME'];
                }
                $basket_sub_title = $basket_sub_title .' + набор ' . $kit;
            }

            if ( $resProductItem['PROPERTY_BOX_TRESHOLD_VALUE'] || $resProductItem['PROPERTY_BOX_NOT_TRESHOLD_VALUE'] ) {
                $basket_sub_title = $basket_sub_title .' + Коробка';
            }
        }
    }



    // Для получение кол-ва
    $itemData = CCatalogProduct::GetByID($arResult['ITEM']['FIELDS']['ID']);
    $arResult['ITEM']['TEST'] = $itemData;

    $image = ($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) ? CFile::GetPath($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) : CFile::GetPath($arResult['ITEM']['FIELDS']['DETAIL_PICTURE']);

    $arResult['RESULT_FILTER'] = [
        'id' => $arResult['ITEM']['FIELDS']['ID'],
        'image' => ( $image ) ? $image : '/upload/image_not_found.png',
        'item_quantity' => [
            'quantity' => 10,//$itemData['QUANTITY'],
            'moldings' => 1, // Пагонаж тестовое, нужно сделать
        ],
        'basket_quantity' => [
            'quantity' => $basket_quantity,
            'moldings' => 1, // Пагонаж в корзине тестовое, нужно сделать
            'basket_sub_title' => $basket_sub_title,
        ],
        'price' => $price,
        'title' => $arResult['ITEM']['FIELDS']['NAME'],
        'box' => $box,
        'test' => $arResult,
    ];
}

$filterItems = [];

foreach ($arResult['PROPERTY_ID_LIST'] as $arId) {
    if ($arResult['ITEMS'][$arId]) {
        foreach ($arResult['ITEMS'][$arId]['VALUES'] as $key => $arFilter) {

            if ($arFilter['DISABLED'])
                continue;

            if ( $_REQUEST['get_sku'] == 'Y' ) {
                if ( $_REQUEST[$arFilter['CONTROL_ID']] == 'Y' ) {
                    $arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'] = 'checked';
                    $arProp['PROPERTY_' . $arResult['ITEMS'][$arId]['CODE']] = $key;
                }
            }
            
            if ($arResult['ITEMS'][$arId]['CODE'] != ['KIT']) {
                $filters[] = [
                    'id' => $arFilter['CONTROL_ID'],
                    'name' => $arResult['ITEMS'][$arId]['CODE'],
                    'desc' => $arFilter['VALUE'],
                    'value' => 'Y',
                    'checked' => ( $arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'] == 'checked' ? true : false ),//$arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'],
                    'image' => ( $arFilter['FILE'] ) ? $arFilter['FILE']['SRC'] : '',
                ];
            } else {
                $filters[] = [
                    'id' => $arFilter['CONTROL_ID'],
                    'name' => $arResult['ITEMS'][$arId]['CODE'],
                    'desc' => $arFilter['VALUE'],
                    'value' => 'Y',
                    'checked' => ( $arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'] == 'checked' ? true : false ),//$arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'] = 'checked',
                    'image' => '',
                ];
            }
        }
        $filterItems[] = [
            'id' => $arId,
            'name' => $arResult['ITEMS'][$arId]['NAME'],
            'filters' => $filters,
        ];
        $filters = [];
    }
}

if ( $_REQUEST['get_sku'] == 'Y' ) {
    $resProduct = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        $arProp,
        false,
        false,
        []
    );
    //$resProduct = CIBlockElement::GetByID($_REQUEST['sku-id']);
    if ($obProduct = $resProduct->GetNextElement()){
        //$arResult['ITEM']['TEST'] = $obProduct;
        $el = $obProduct->GetFields();
        $prop = $obProduct->GetProperties();
        $arResult['ITEM']['FIELDS'] = $el;
        $arResult['ITEM']['PROP'] = $prop;
    }

    $price = 0; //
    if ($resPrice = CPrice::GetBasePrice($el['ID'])){
        $price = (int)$resPrice['PRICE'];
    }

    $basket_quantity = 0;
    $arBasketItems = [];
    $dbBasketItems = CSaleBasket::GetList(
        [],
        [
            "FUSER_ID" => CSaleBasket::GetBasketUserID(),
            "LID" => SITE_ID,
            "ORDER_ID" => "NULL"
        ],
        false,
        false,
        ["ID", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "CAN_BUY", "PRICE", "WEIGHT"]
    );
    while ($arItems = $dbBasketItems->Fetch())
    {
        $arResult['BASKET'][$arItems['PRODUCT_ID']] = $arItems['QUANTITY'];
        if ( $arItems['PRODUCT_ID'] == $arResult['ITEM']['FIELDS']['ID'] ) {
            $basket_quantity = $arItems['QUANTITY'];
        }
    }

    

    // Для получение кол-ва
    $itemData = CCatalogProduct::GetByID($arResult['ITEM']['FIELDS']['ID']);

    $image = ($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) ? CFile::GetPath($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) : CFile::GetPath($arResult['ITEM']['FIELDS']['DETAIL_PICTURE']);

    $arResult['RESULT_FILTER'] = [
        'id' => $arResult['ITEM']['FIELDS']['ID'],
        'image' => ( $image ) ? $image : '/upload/image_not_found.png',
        'item_quantity' => [
            'quantity' => 10,//$itemData['QUANTITY'],
            'moldings' => 1, // Пагонаж тестовое, нужно сделать
        ],
        'basket_quantity' => [
            'quantity' => $basket_quantity,
            'moldings' => 1, // Пагонаж в корзине тестовое, нужно сделать
        ],
        'price' => $price,
        'title' => $arResult['ITEM']['FIELDS']['NAME'],
    ];
}

if (!empty($resultProduct) || !empty($arElemnts)) {
    //$arResult['RESULT_FILTER'] = $resultProduct;
    $arResult['SKU_RESULT'] = $arElemnts;
    $this->__component->SetResultCacheKeys(['RESULT_FILTER', 'SKU_RESULT']);
}

$arResult['PROPS'] = $arProp;
$arResult['RESULT_FILTER']['items'] = $filterItems;
?>