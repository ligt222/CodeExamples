<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'CBasket' => '/local/templates/main/helper/class/CBasket.php',
    'CreatingPicture' => '/local/php_interface/classes/CreatingPicture.php',
]);

if (!defined('BX_DISABLE_INDEX_PAGE')) {
    define('BX_DISABLE_INDEX_PAGE', true);
}

function header_catalog_sect()
{
    $catalogSect = $GLOBALS['APPLICATION']->GetProperty('catalog:sect');

    return ($catalogSect ?: ' b-header__top--fixed');
}

\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'onSaleOrderSaved',
    'OnOrderSave'
);
\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'iblock',
    'OnAfterIBlockElementUpdate',
    'FillingSetsSku'
);

function FillingSetsSku(&$arFields)
{
    $resIblock = CIBlock::GetList(array(), array('CODE' => 'offers'));
    if ($arIblock = $resIblock->Fetch()) {
        if ($arIblock['ID'] == $arFields['IBLOCK_ID']) {


            $arIdPropKit = [];
            $cml2Link = '';
            $res = CIBlockElement::GetProperty($arFields['IBLOCK_ID'], $arFields['ID'], array("sort" => "asc"), array());
            while ($arParam = $res->Fetch()) {
                file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/testi.json', json_encode($arParam, 256) . "\r", FILE_APPEND);
                if ($arParam['CODE'] == 'KIT') {
                    $arIdPropKit[] = $arParam['VALUE'];
                }
                if ($arParam['CODE'] == 'CML2_LINK') {
                    $cml2Link = $arParam['VALUE'];
                }
            }

            $resElem = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $arFields['IBLOCK_ID'], 'PROPERTY_CML2_LINK' => $cml2Link, 'PROPERTY_KIT' => false), false, false, array('ID', 'NAME', 'PROPERTY_CML2_LINK', 'PROPERTY_KIT'));
            while ($arElem = $resElem->Fetch()) {
                CIBlockElement::SetPropertyValuesEx($arElem['ID'], $arFields['IBLOCK_ID'], array('KIT' => $arIdPropKit));
            }

            //file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/test.json', json_encode(['elem' => $arIblock], 256) . "\r", FILE_APPEND);
        }
    }
}

function OnOrderSave(Bitrix\Main\Event $event)
{
    $order = $event->getParameter("ENTITY");
    $arOrderVals = $order->getFields()->getValues();
    $collection = $order->getPropertyCollection();
    $basket = $order->getBasket();

    if ($event->getParameter("IS_NEW")) {
        $items_array = [];
        $sub_items_array = [];
        $items_full_prices = [];
        $boxes_items = [];
        $box_id = false;
        $box_count = 0;
        $is_kit = false;
        $is_door = false;
        $items = "<table>";
        $items = $items . "<tr><td align='left'><b>Наименование</b></p></td><td align='left'>Цена&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='left'>Количество&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='right'>Итоговая сумма&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>";
        foreach ($basket as $basketItem) {
            $collection_basket = $basketItem->getPropertyCollection();
            foreach ($collection_basket->getPropertyValues() as $item) {
                if ($item['CODE'] == 'POINT') {
                    $point_id = explode("_", $item['VALUE'])[1];
                    $sub_items_array[$point_id][] = [
                        'id' => $basketItem->getField('PRODUCT_ID'),
                        'name' => $basketItem->getField('NAME'),
                        'quantity' => $basketItem->getQuantity(),
                        'price' => $basketItem->getField('PRICE'),
                        'total_price' => $basketItem->getField('PRICE') * $basketItem->getQuantity(),
                    ];
                    if (empty($items_full_prices[$point_id])) {
                        $items_full_prices[$point_id] = $basketItem->getField('PRICE') * $basketItem->getQuantity();
                    } else {
                        $items_full_prices[$point_id] += $basketItem->getField('PRICE') * $basketItem->getQuantity();
                    }
                    $is_kit = true;
                    //$is_door = false;
                }
                if ($item['CODE'] == 'BOX') {
                    $box_id = $item['VALUE'];
                    $is_door = true;
                }

                if ($item['CODE'] == 'BOX_COUNT') {
                    $box_count = $item['VALUE'];
                    $is_door = true;
                }
            }
            if (!$is_kit && $is_door) {
                $items_array[$basketItem->getField('PRODUCT_ID')] = [
                    'id' => $basketItem->getField('PRODUCT_ID'),
                    'name' => $basketItem->getField('NAME'),
                    'quantity' => $basketItem->getQuantity(),
                    'price' => $basketItem->getField('PRICE'),
                    'total_price' => $basketItem->getField('PRICE') * $basketItem->getQuantity(),
                    'box' => $box_id,
                    'box_quantity' => $box_count,
                ];
                if (empty($items_full_prices[$basketItem->getField('PRODUCT_ID')])) {
                    $items_full_prices[$basketItem->getField('PRODUCT_ID')] = $basketItem->getField('PRICE') * $basketItem->getQuantity();
                } else {
                    $items_full_prices[$basketItem->getField('PRODUCT_ID')] += $basketItem->getField('PRICE') * $basketItem->getQuantity();
                }
            }

            if (!$is_kit && !$is_door) {
                $boxes_items[$basketItem->getField('PRODUCT_ID')] = [
                    'id' => $basketItem->getField('PRODUCT_ID'),
                    'name' => $basketItem->getField('NAME'),
                    'quantity' => $basketItem->getQuantity(),
                    'price' => $basketItem->getField('PRICE'),
                    'total_price' => $basketItem->getField('PRICE') * $basketItem->getQuantity(),
                ];
            }

            $is_kit = false;
            $is_door = false;
            $box_id = false;
            $box_count = 0;
        }
        $total_price = 0;

        foreach ($items_array as $key => $arItem) {
            if ($arItem['box']) {
                if (empty($items_full_prices[$arItem['id']])) {
                    $items_full_prices[$arItem['id']] = $boxes_items[$arItem['box']]['price'] * $arItem['box_quantity'];
                } else {
                    $items_full_prices[$arItem['id']] += $boxes_items[$arItem['box']]['price'] * $arItem['box_quantity'];
                }
            }
            if (!empty($sub_items_array[$arItem['id']])) {
                if (empty($items_full_prices[$arItem['id']])) {
                    $items_full_prices[$arItem['id']] = $sub_items_array[$arItem['id']]['price'] * $sub_items_array[$arItem['id']]['quantity'];
                } else {
                    $items_full_prices[$arItem['id']] += $sub_items_array[$arItem['id']]['price'] * $sub_items_array[$arItem['id']]['quantity'];
                }
            }
        }

        foreach ($items_full_prices as $arPrice) {
            $total_price += $arPrice;
        }

        foreach ($items_array as $key => $arItem) {
            $items = $items . "<tr><td align='left'>" . "<b>" . $arItem['name'] .
                "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='left'>" .
                $arItem['price'] . "&nbsp;руб.</td><td align='center'>" .
                $arItem['quantity'] . "&nbsp;шт.</td><td align='right'>" .
                $items_full_prices[$arItem['id']] . "&nbsp;руб.</td></tr>";
            if (!empty($sub_items_array[$arItem['id']])) {
                foreach ($sub_items_array[$arItem['id']] as $subItem) {
                    $items = $items . "<tr><td align='left'>" . "<b>" . '--' . $subItem['name'] .
                        "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='left'>" .
                        $subItem['price'] . "&nbsp;руб.</td><td align='center'>" .
                        $subItem['quantity'] . "&nbsp;шт.</td><td align='right'>" .
                        "</td></tr>";
                }
            }
            if ($arItem['box']) {
                $items = $items . "<tr><td align='left'>" . "<b>" . '--' . $boxes_items[$arItem['box']]['name'] .
                    "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align='left'>" .
                    $boxes_items[$arItem['box']]['price'] . "&nbsp;руб.</td><td align='center'>" .
                    $arItem['box_quantity'] . "&nbsp;шт.</td><td align='right'>" .
                    "</td></tr>";
            }

        }

        $arEventFields = [
            "NEW_ORDER_ID" => $arOrderVals['ACCOUNT_NUMBER'],
            "ORDER_DATE" => $order->getField('DATE_INSERT')->toString(),
            "AUTHOR" => $collection->getItemByOrderPropertyCode('NAME')->getValue(),
            "AUTHOR_EMAIL" => $collection->getItemByOrderPropertyCode('EMAIL')->getValue(),
            "PHONE" => $collection->getItemByOrderPropertyCode('PHONE')->getValue(),
            "ITEMS" => $items,
            "TOTAL_PRICE" => $total_price,
        ];
        if ($arOrderVals['USER_ID'] == 2) {
            CEvent::Send("SALE_NEW_ORDER_NOTIFY", SITE_ID, $arEventFields, "N", 53);
        } else {
            CEvent::Send("SALE_NEW_ORDER_NOTIFY", SITE_ID, $arEventFields, "N", 52);
        }
    }
}