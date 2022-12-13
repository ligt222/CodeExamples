<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$item_id = ( $_REQUEST['id'] ) ? $_REQUEST['id'] : $arParams['ITEM_ID'];
if ($item_id)
{
    $arProp = [
        'IBLOCK_ID' => 4,
        'PROPERTY_CML2_LINK' => $item_id,
        'ACTIVE' => 'Y',
    ];
}
//box-with-treshold

$resultProduct = [];
$arElemnts = [];
$arResult['RESULT_FILTER'] = [];

$arResult['RESULT_FILTER']['items'] = [];
$filters = [];
$box = true;
$box_items = [];
$model_image = false;

if ( $_REQUEST['id'] || $arParams['ITEM_ID']) {
    $resProductItem = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => 3, 'ID' => $item_id],
        false,
        false,
        ['DETAIL_PICTURE','PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD']
    );
    $resProductItem = $resProductItem->GetNext();

    if ($resProductItem['DETAIL_PICTURE']) {
        $model_image = $resProductItem['DETAIL_PICTURE'];
    }





    if ( $resProductItem['PROPERTY_BOX_NOT_TRESHOLD_VALUE'] ) {
        $box = true;
        $box_items['box_not_treshold'] = $resProductItem['PROPERTY_BOX_NOT_TRESHOLD_VALUE'];
    }

    $resProduct = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        $arProp,
        false,
        false,
        []
    );

    if ($obProduct = $resProduct->GetNextElement()){
        $el = $obProduct->GetFields();
        $prop = $obProduct->GetProperties();
        $arResult['ITEM']['FIELDS'] = $el;
        $arResult['ITEM']['PROP'] = $prop;
        $box_items['box_not_treshold'] = 'Y';
        $box_items['box_treshold'] = 'N';
    }

    $price = 0; //
    if ($resPrice = CPrice::GetBasePrice($el['ID'])){
        $price = (int)$resPrice['PRICE'];
    }

    // Для получение кол-ва
    $itemData = CCatalogProduct::GetByID($arResult['ITEM']['FIELDS']['ID']);
    //$arResult['ITEM']['TEST'] = $itemData;
    if (!$arParams['ITEM_ID']){
        $srcImage = new CreatingPicture($arResult['ITEM']['FIELDS']['ID']); // TODO Класс для вывода составных картинок
        $image = $srcImage->getArrSrcImg();
    }
    //$image = ($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) ? CFile::GetPath($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) : CFile::GetPath($arResult['ITEM']['FIELDS']['DETAIL_PICTURE']);
    //$image = ( $image ) ? $image : CFile::GetPath($model_image);
    $arResult['RESULT_FILTER'] = [
        'id' => $arResult['ITEM']['FIELDS']['ID'],
        //'image' => ( $image ) ? $image : '/upload/image_not_found.png',
        'image' => ( $image ),
        'item_quantity' => [
            'quantity' => $itemData['QUANTITY'],//$itemData['QUANTITY'],
            'moldings' => 1, // Пагонаж тестовое, нужно сделать
        ],
        'price' => $price,
        'title' => $arResult['ITEM']['FIELDS']['NAME'],
        'box' => $box,
        'box_items' => $box_items,
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
                    'kit-id' => $key,
                    'name' => $arResult['ITEMS'][$arId]['CODE'],
                    'desc' => $arFilter['VALUE'],
                    'value' => 'Y',
                    'checked' => ( $arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'] == 'checked' ? true : false ),//$arResult['ITEMS'][$arId]['VALUES'][$key]['CHECKED'],
                    'image' => ( $arFilter['FILE'] ) ? $arFilter['FILE']['SRC'] : '',
                    'image_style' => 'background: url('. $arFilter['FILE']['SRC'] .') center center/cover no-repeat;',
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
        if ( !empty($filters) ) {
            $filterItems[] = [
                'id' => $arId,
                'name' => $arResult['ITEMS'][$arId]['NAME'],
                'filters' => $filters,
            ];
        }

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

    

    // Для получение кол-ва
    $itemData = CCatalogProduct::GetByID($arResult['ITEM']['FIELDS']['ID']);
    $srcImage = new CreatingPicture($arResult['ITEM']['FIELDS']['ID']); // TODO Класс для вывода составных картинок
    $image = $srcImage->getArrSrcImg($_REQUEST['kit-id']);
    //$image = ($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) ? CFile::GetPath($arResult['ITEM']['FIELDS']['PREVIEW_PICTURE']) : CFile::GetPath($arResult['ITEM']['FIELDS']['DETAIL_PICTURE']);
    //$image = ( $image ) ? $image : CFile::GetPath($model_image);
    $arResult['RESULT_FILTER'] = [
        'id' => $arResult['ITEM']['FIELDS']['ID'],
        //'image' => ( $image ) ? $image : '/upload/image_not_found.png',
        'image' => $image,
        'item_quantity' => [
            'quantity' => 10,//$itemData['QUANTITY'],
            'moldings' => 1, // Пагонаж тестовое, нужно сделать
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

// TODO Замена надписи Цвет ПВХ
$pvsFlag = 0;
foreach ($arResult['COMBO'] as $arColor) {
    if (($arColor['12'] == false) && ($arColor['13'] == false)){
        $arResult['ITEMS']['3']['NAME'] = 'Цвет ПВХ';
        $arResult['ITEM']['PROP']['COLOR_REF']['NAME'] = 'Цвет ПВХ';
        $pvsFlag = 1;
        break;
    }
}
if($pvsFlag == 1){
    foreach ($arResult['RESULT_FILTER']['items'] as $key => $arColor) {
        if ($arColor['id'] == 3){
            //$arColor['NAME'] = 'Цвет ПВХ';
            $arResult['RESULT_FILTER']['items'][$key]['name'] = 'Цвет ПВХ';
            break;
        }
    }
}
$this->__component->SetResultCacheKeys(['RESULT_FILTER']);
?>