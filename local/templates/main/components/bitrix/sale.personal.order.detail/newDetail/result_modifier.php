<?php
    $arResult['ITEMS'] = [];
    $arResult['ITEMS_KIT'] = [];
    foreach ( $arResult['BASKET'] as $key => $arItem ) {
        if ( $arItem['PROPERTY_POINT_VALUE'] ) {
            $item_id = explode("_", $arItem['PROPERTY_POINT_VALUE'] );
            $arResult['ITEMS_KIT'][$item_id[1]][] = $arItem;
        } else {
            $arResult['ITEMS'][$arItem['PRODUCT_ID']] = $arItem;
        }
    }

?>