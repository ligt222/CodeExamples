<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$getSku = ($_REQUEST['get_sku'] === 'Y'); // получение по фильтрам
$skuID = $_REQUEST['sku-id']; // получение по торг. предложению
$basketItem = ($_REQUEST['basket_item'] ?: false); // получение по торг. предложению

$box_items = [];
$box = true;
$is_not_treshold = false;
$model_image = false;
if ($_REQUEST['id'])
{
    $arProp = [
        'IBLOCK_ID' => 4,
        'PROPERTY_CML2_LINK' => $_REQUEST['id'],
    ];

    // Получаем наличие коробок и их id у модели
    $resProductItem = CIBlockElement::GetList(
        ['ID' => 'ASC'],
        ['IBLOCK_ID' => 3, 'ID' => $_REQUEST['id']],
        false,
        false,
        ['PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD', 'DETAIL_PICTURE']
    );
    $resProductItem = $resProductItem->GetNext();

    if ($resProductItem['DETAIL_PICTURE']) {
        $model_image = $resProductItem['DETAIL_PICTURE'];
    }

}

$arElements = $resultProduct = [];
$arBox = [
    'exist' => false,
    'price' => 0
];

$arOfferProperty = [];
if ($skuID) // получаем свойства у торг. предл., чтобы включить их в фильтре
{
    $arFilter = ['IBLOCK_ID' => 4, 'ID' => $skuID];
    $res = CIBlockElement::GetList([], $arFilter, false, [], []);
    if ($next = $res->GetNextElement())
    {
        $items = $next->GetProperties();
        foreach ($items as $value)
        {
            if ($value['VALUE'])
                $arOfferProperty[$value['CODE']] = $value['VALUE'];
        }
        $box_items['box_not_treshold'] = 'Y';
        $box_items['box_treshold'] = 'N';
    }
}

// фильтр
$filterItems = [];
$arResult['RESULT_FILTER'] = ['items' => []];
foreach ($arResult['ITEMS'] as $key => $arItem)
{
    $filters = [];
    foreach ($arItem['VALUES'] as $id => $arFilter)
    {
        if ($arFilter['DISABLED'])
            continue;

        if ($getSku)
        {
            $checked = isset($arFilter['CHECKED']);

            if ($checked)
                $arProp["PROPERTY_" . $arItem['CODE']] = $id;
        }

        $filters[] = [
            'id' => $arFilter['CONTROL_ID'],
            'name' => $arItem['CODE'],
            'desc' => $arFilter['VALUE'],
            'kit-id' => $id,
            'value' => 'Y',
            'checked' => ($checked ? true : false),
            'image' => $arFilter['FILE']['SRC'] ?: '',
            'image_style' => 'background: url('. $arFilter['FILE']['SRC'] .') center center/cover no-repeat;',
        ];
    }

    if ($filters)
    {
        $filterItems[] = [
            'id' => $key,
            'name' => $arItem['NAME'],
            'filters' => $filters,
        ];
    }
}

// редактирование
if ($getSku || $skuID)
{
    $arFilter = (!$getSku ? ['IBLOCK_ID' => 4, 'ID' => $_REQUEST['sku-id']] : $arProp);
    $res = CIBlockElement::GetList([], $arFilter, false, ['nPageSize' => 1], ['ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'CATALOG_PRICE_1', 'PROPERTY_KIT']);

    $arOffer = $res->Fetch();

    $basket_quantity = 1;
    $basket_sub_title = 'Дверь';
    $boxCount = 0;
    $kit_price = 0;
    $arBasketItems = [];
    if ($basketItem) {
        $basket = CBasket::getItem($basketItem);
    } else {
        $dbBasketItems = CSaleBasket::GetList(
            [],
            [
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                'PRODUCT_ID' => ($skuID ?: []),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
            ],
            false,
            false,
            ["ID", "MODULE", "PRODUCT_ID", "QUANTITY"]
        );



        // TODO Нужно запросить id товара из корзины, а не искать методом тыка по айди торгового.
        if ($arItems = $dbBasketItems->Fetch())
        {
            if ( $arItems['PRODUCT_ID'] == $skuID ) {
                $basket = CBasket::getItem($arItems['ID']);
            }
        }
    }


    if ( $arOffer['PROPERTY_KIT_VALUE'] && $basket['KIT'] )
    {
        $resKitSect = CIBlockSection::GetList(array(), array('ID' => $arOffer['PROPERTY_KIT_VALUE']), false, array('ID', 'NAME'));
        if ($arKitSect = $resKitSect->Fetch())
        {
            $basket_sub_title = $basket_sub_title . " + Набор " . $arKitSect['NAME'];
        }
    }
    if ($basket['BOX']['ID']) {
        $resBox = CIBlockElement::GetList(
            array(),
            array('ID' =>$basket['BOX']['ID']),
            false,
            false,
            array('ID','NAME','PROPERTY_TRESHOLD')
        );
        if ($arrBox = $resBox->Fetch()){
            if ($arrBox['PROPERTY_TRESHOLD_VALUE'] == 'Y'){
                $is_not_treshold = true;
            }

            $basket_sub_title = $basket_sub_title . " +  " . $arrBox['NAME'];
        }
    }


    $image = ($arOffer['PREVIEW_PICTURE']) ? CFile::GetPath($arOffer['PREVIEW_PICTURE']) : CFile::GetPath($arOffer['DETAIL_PICTURE']);
    $image = ( $image ) ? $image : CFile::GetPath($model_image);

    $box_item = CBasket::getItemBoxTest($basket['BOX']['ID']);



    foreach ( $basket['KIT'] as $kit ) {
        $kit_price += (int)$kit['PRICE'] * (int)$kit['QUANTITY'];
    }
    if ($basket) {
        $price = (((int)$arOffer['CATALOG_PRICE_1'] * (int)$basket['QUANTITY']) + (int)$box_item['PRICE'] * (int)$basket['BOX']['QUANTITY']) + $kit_price;
    } else {
        $price = (int)$arOffer['CATALOG_PRICE_1'];
    }
    $srcImage = new CreatingPicture($arOffer['ID']);
    $image = $srcImage->getArrSrcImg($_REQUEST['kit-id']);
    $arResult['RESULT_FILTER'] = [
        'id' => $arOffer['ID'],
        // TODO Составная картинка
        'image' => ($image ?:'/upload/image_not_found.png'),
        'item_quantity' => [
            'quantity' => $arOffer['CATALOG_QUANTITY'],
            'moldings' => 1,
        ],
        'basket_quantity' => [
            'quantity' => (int)$basket['QUANTITY'],
            'moldings' => (int)$basket['BOX']['QUANTITY'],
            'basket_sub_title' => $basket_sub_title,
        ],
        'threshold' => $is_not_treshold,
        'price' => $price,
        'title' => $arOffer['NAME'],
        'box' => $box,//($arBox['exist'] !== false), Смотрим по наличию у модели в админке, а не у товара, который в корзине
        'box_items' => $box_items,
    ];
}

if ($resultProduct || $arElements)
{
    $arResult['SKU_RESULT'] = $arElements; // TODO: значение вроде не используется
    $this->__component->SetResultCacheKeys(['RESULT_FILTER', 'SKU_RESULT']);
}

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

$arResult['RESULT_FILTER']['items'] = $filterItems;

?>
<script>
    var test23 = <?=CUtil::PhpToJSObject($arResult)?>;
    console.log(test23);
</script>
