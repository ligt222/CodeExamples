<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('catalog');
CModule::IncludeModule("sale");

$quantity = 1;
$basketItem = ($_REQUEST['basket_item'] ?: false);
$threshold = 'N';
if ( $_REQUEST['box-id'] )
{
    $threshold = $_REQUEST['box-id'];
}

if ($_REQUEST['count-doors'])
{
    $quantity = $_REQUEST['count-doors'];
}

if ($_REQUEST['count-mouldings'])
{
    $quantity_boxes = $_REQUEST['count-mouldings'];
}

if ($_REQUEST['quantity'])
{
    $quantity = $_REQUEST['quantity'];
}

if ($_REQUEST['product_id'])
{
    $PRODUCT_ID = $_REQUEST['product_id'];
    $QUANTITY = $quantity;
    $QUANTITY_BOXES = $quantity_boxes;
    $KIT_ID = $_REQUEST['kit-id'];
}

if ($_REQUEST['delete_all'] == 'Y') {

    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'all' => 'deleted'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die;

}

$is_delete = false;
if (($_REQUEST['delete'] === 'Y') && ($basketItem))
{
    $basket = CBasket::getItem($basketItem);
    $is_delete = CBasket::newDeleteItem($basket);
}


if (!$_REQUEST['delete'] && !$basketItem) // добавление товара
{
    $newItemId = CBasket::addItemTest($PRODUCT_ID, $QUANTITY, $QUANTITY, $KIT_ID, $threshold);
}

if ($PRODUCT_ID && $basketItem) // обновление товара
{

    $basket = CBasket::getItem($basketItem);
    if ($basket) {
        // Если переданный товар совпадает с тем что в корзине

        if ( $basket['PRODUCT_ID'] === $PRODUCT_ID ) {
            $box_id = CBasket::getBox($PRODUCT_ID, $threshold)['ID'];
            $countDoors = (isset($_REQUEST['count-doors']) ? $_REQUEST['count-doors'] : false);
            $countMouldings = (isset($_REQUEST['count-mouldings']) ? $_REQUEST['count-mouldings'] : false);
            $basket_quantity = $basket['QUANTITY'];

            // -- Обновление кол-ва у товара
            if ($basket['QUANTITY'] != $QUANTITY ) {
                CBasket::newUpdateItem( $basket, $QUANTITY);
            }
            /*if ($_REQUEST['kit-id']){
                CBasket::deleteItemKit($basket);
            }*/
            if ($KIT_ID){
                foreach ($basket['KIT'] as $kit){
                    if ($KIT_ID !== $kit['ID']){
                        if(CBasket::deleteItemKit($kit['ID'])){
                            CBasket::addItemKit($KIT_ID, $QUANTITY, $PRODUCT_ID);
                        }
                    }
                }
            }

            // -- Обновление коробок
            // Проверяем наличие коробки у товара в корзине
            if ( $basket['BOX'] ) {
                // Если передена коробка отличная от той что в корзине заменяем на новую
                if ( $basket['BOX']['ID'] != $box_id ) {
                    // Удаляем старую коробку
                    CBasket::deleteItemBoxTest( $basket, CBasket::getItemBoxTest($basket['BOX']['ID']));
                    // Добавляем новую
                    CBasket::addItemBoxTest( $basket, $box_id, $QUANTITY);
                } else {
                    // Если пришло нулевое кол-во на добавление, удаляем коробку у товара.
                    if ( $QUANTITY == 0 ) {
                        // Удаляем старую коробку
                        CBasket::deleteItemBoxTest( $basket, CBasket::getItemBoxTest($basket['BOX']['ID']));
                    } else {
                        $test = CBasket::updateItemBoxTest( $basket, CBasket::getItemBoxTest($basket['BOX']['ID']), $QUANTITY);
                    }
                }
            } else {
                // Если у товара не было коробки, добавляем новую
                if ( $box_id ) {
                    // Добавляем новую
                    $test = CBasket::addItemBoxTest( $basket, $box_id, $QUANTITY);
                }
            }
        } else {
            // Если не совпадает удаляем и заменяем на новый
            CBasket::newDeleteItem($basket);
            $newItemId = CBasket::addItemTest($PRODUCT_ID, $QUANTITY, $QUANTITY, $KIT_ID, $threshold);
        }
    }
}

$arBasketItems = [];
$arDataOrder = [];

$itemInfoResult = CCatalogSku::GetProductInfo($PRODUCT_ID);
if ( $PRODUCT_ID || $is_delete ) {
    $APPLICATION->IncludeComponent(
        "bitrix:sale.basket.basket",
        "basket",
        array(
            "ACTION_VARIABLE" => "action",
            "AUTO_CALCULATION" => "Y",
            "TEMPLATE_THEME" => "blue",
            "COLUMNS_LIST" => array("NAME", "DISCOUNT", "WEIGHT", "DELETE", "DELAY", "TYPE", "PRICE", "QUANTITY"),
            "COMPONENT_TEMPLATE" => ".default",
            "GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_CONVERT_CURRENCY" => "Y",
            "GIFTS_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_HIDE_NOT_AVAILABLE" => "N",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_MESS_BTN_DETAIL" => "Подробнее",
            "GIFTS_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
            "GIFTS_PRODUCT_QUANTITY_VARIABLE" => "",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_OLD_PRICE" => "Y",
            "GIFTS_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_PLACE" => "BOTTOM",
            "HIDE_COUPON" => "N",
            "OFFERS_PROPS" => array("SIZES_SHOES", "SIZES_CLOTHES"),
            "PATH_TO_ORDER" => "/personal/order.php",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "QUANTITY_FLOAT" => "N",
            "SET_TITLE" => "Y",
            "USE_GIFTS" => "Y",
            "USE_PREPAYMENT" => "N",
            "ITEM_SKU_ID" => $PRODUCT_ID,
        )
    );
    $resProduct = CIBlockElement::GetList(
        [],
        ['ID' => $PRODUCT_ID],
        false,
        false,
        ['ID', 'NAME', 'PROPERTY_KIT', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_CML2_LINK']
    );
    if ($arProduct = $resProduct->Fetch())
    {
        $arPrice = CPrice::GetByID(intval($arProduct['ID']));
        $db_res = CPrice::GetList(
            [],
            [ "PRODUCT_ID" => $arProduct['ID'],"CATALOG_GROUP_ID" => $arPrice['CATALOG_GROUP_ID'] ],
        );
        $price = 0;
        if ($ar_res = $db_res->Fetch())
        {
            $price = intval($ar_res['PRICE']);
        }

        $resProductModel = CIBlockElement::GetList(
            [],
            ['IBLOCK_ID' => 3, 'ID' => $arProduct['PROPERTY_CML2_LINK_VALUE']],
            false,
            false,
            ['DETAIL_PICTURE']
        );
        $image = ($arProduct['PREVIEW_PICTURE']) ? CFile::GetPath($arProduct['PREVIEW_PICTURE']) : CFile::GetPath($arProduct['DETAIL_PICTURE']);
        if ($model = $resProductModel->Fetch() ) {
            $image = ( $image  ? $image : CFile::GetPath($model['DETAIL_PICTURE']) );
        }
        $srcImage = new CreatingPicture($arProduct['ID']);
        $image = $srcImage->getArrSrcImg($_REQUEST['kit-id']);
        $arDataProd = [
            'id' => $arProduct['ID'],
            'item_id' => $itemInfoResult['ID'],
            'title' => $arProduct['NAME'],
            'basket_sub_title' => $GLOBALS['RESULT_NEW_CART']['ITEM_BASKET']['basket_sub_title'],
            'quantity' => $GLOBALS['RESULT_NEW_CART']['ITEM_BASKET']['quantity'],
            'price' => $GLOBALS['RESULT_NEW_CART']['ITEM_BASKET']['price'],//$price,//strval($price),
            'image' => ( $image  ? $image : '/upload/image_not_found.png'),
            'basket_item_id' =>( $newItemId  ? $newItemId : false),
        ];
    }

    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'dataOrder' => $GLOBALS['RESULT_NEW_CART'], 'data' => $arDataProd], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    //, 'old_basket' => $basket, 'test' => CBasket::getItemBoxTest(CBasket::getItem($basket['ID'])['BOX']['ID']), 'test2' => CBasket::getItem($basket['ID']), 'test3' => CBasket::getItemBoxTest($basket['BOX']['ID'])
    die;

}


