<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule('sale');

class CBasket
{
    function getBox($PRODUCT_ID, $threshold = 'N')
    {
        $arrBox = [];
        $resProduct = CIBlockElement::GetList(
            [],
            ['ID' => $PRODUCT_ID],
            false,
            false,
            []
        );
        if ($obProduct = $resProduct->GetNextElement()) {
            $arPropProd = $obProduct->GetProperties();

            $colorRef = $arPropProd['COLOR_REF']['VALUE'];
            $sizeRef = $arPropProd['SIZE']['VALUE'];

            $resBox = CIBlockElement::GetList(
                array(),
                array('IBLOCK_CODE' => 'boxes'),
                false,
                false,
                array()
            );

            while ($obBox = $resBox->GetNextElement()){
                $fieldsBox = $obBox->GetFields();
                $propBox = $obBox->GetProperties();
                if ($propBox['COLOR_REF']['VALUE'] == $colorRef){
                    if ($propBox['TRESHOLD']['VALUE'] == $threshold){
                        if ($propBox['SIZE_REF']['VALUE'] && in_array($sizeRef, $propBox['SIZE_REF']['VALUE'])){

                            $arrBox['ID'] = $fieldsBox['ID'];
                            $arrBox['NAME'] = $fieldsBox['NAME'];

                        } elseif (!$propBox['SIZE_REF']['VALUE']){
                            $arrBox['ID'] = $fieldsBox['ID'];
                            $arrBox['NAME'] = $fieldsBox['NAME'];
                        }
                    }
                }

            }


        }
        return $arrBox;
    }

    function deleteItemKit($basketKitId)
    {

        if(CSaleBasket::Delete($basketKitId)){
            return true;
        } else {
            return false;
        }

    }

    function addItem($PRODUCT_ID, $QUANTITY_BOXES, $box_id, $QUANTITY)
    {
        $resProduct = CIBlockElement::GetList(
            [],
            ['ID' => $PRODUCT_ID],
            false,
            false,
            ['ID', 'NAME', 'PROPERTY_KIT', 'PREVIEW_PICTURE']
        );
        if ($arProduct = $resProduct->Fetch()) {
            $arProp = [];
            if ($QUANTITY_BOXES && $box_id) // добавление коробки
            {
                $mxResult = CCatalogSku::GetProductInfo($PRODUCT_ID);
                $resBox = CIBlockElement::GetList(
                    [],
                    ['IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'ID' => $mxResult['ID']],
                    false,
                    false,
                    ['ID', 'PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD']
                );

                if ($res_item = $resBox->Fetch()) {
                    if (($res_item['PROPERTY_BOX_TRESHOLD_VALUE'] || $res_item['PROPERTY_BOX_NOT_TRESHOLD_VALUE'])) {
                        //if ($QUANTITY_BOXES > $QUANTITY) // TODO: сделать чтобы на фронте нельзя было выбрать кол-во коробок больше кол-ва дверей
                        //$QUANTITY_BOXES = $QUANTITY; // TODO: Дима сказал не ограничивать пока что

                        //$box_id = ($res_item['PROPERTY_BOX_TRESHOLD_VALUE'] ?: $res_item['PROPERTY_BOX_NOT_TRESHOLD_VALUE']); // TODO: должно приходит в запросе, какая коробка, если их 2
                        $box = Bitrix\Catalog\Product\Basket::addProduct(
                            [
                                'PRODUCT_ID' => $box_id,
                                'QUANTITY' => $QUANTITY_BOXES,
                                'PROPS' => [
                                    [
                                        'NAME' => 'Id двери',
                                        'CODE' => 'DOOR_ID',
                                        'VALUE' => $PRODUCT_ID,
                                    ]
                                ]
                            ]
                        );

                        if ($box->isSuccess()) {
                            $arProp = [
                                [
                                    'NAME' => 'Коробка',
                                    'CODE' => 'BOX',
                                    'VALUE' => $box_id,
                                ],
                                [
                                    'NAME' => 'Коробка',
                                    'CODE' => 'BOX_BASKET_ID',
                                    'VALUE' => $box->getData()['ID'],
                                ],
                                [
                                    'NAME' => 'Кол-во коробок',
                                    'CODE' => 'BOX_COUNT',
                                    'VALUE' => $QUANTITY_BOXES,
                                ]
                            ];
                        }
                    }
                }
            }

            $result = Bitrix\Catalog\Product\Basket::addProduct(
                [
                    'PRODUCT_ID' => $PRODUCT_ID, // id товара или предложения
                    'QUANTITY' => $QUANTITY, // количество
                    'PROPS' => $arProp
                ]
            );

            if (!$result->isSuccess()) {
                \Bitrix\Main\Diag\Debug::dump($result->getErrorMessages());
            } else {
                if ($arProduct['PROPERTY_KIT_VALUE']) {


                    $resKit = CIBlockElement::GetList(
                        [],
                        ['IBLOCK_SECTION_ID' => $arProduct['PROPERTY_KIT_VALUE']],
                        false,
                        false,
                        ['ID', 'NAME']
                    );

                    while ($arKit = $resKit->Fetch()) {
                        $kit = Bitrix\Catalog\Product\Basket::addProduct(
                            [
                                'PRODUCT_ID' => $arKit['ID'],
                                'QUANTITY' => $QUANTITY,
                                'PROPS' => [
                                    [
                                        'NAME' => 'Метка',
                                        'CODE' => 'POINT',
                                        'VALUE' => 'kit_' . $PRODUCT_ID,
                                    ]
                                ]
                            ]
                        );
                    }


                }
            }
            return $result->getData()['ID'];
        }
    }

    function deleteItem($basketItem)
    {
        $arDelIdKit = [];
        $is_delete = false;
        $resElBasket = CSaleBasket::GetList(
            ["NAME" => "ASC", "ID" => "ASC"],
            ["ID" => $basketItem, "FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID],
            false,
            false,
            []);
        if ($arElBasket = $resElBasket->Fetch()) {
            // удаление коробки
            $basket = CSaleBasket::GetPropsList([], [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'BASKET_ID' => $arElBasket['ID'],
                'LID' => SITE_ID,
            ],
                false,
                false,
                []
            );

            $items = [];
            while ($next = $basket->Fetch()) {
                $items[$next['CODE']] = $next['VALUE'];
            }

            if ($items['BOX'] && $items['BOX_COUNT']) {
                $arBox = Bitrix\Sale\Internals\BasketTable::getList(array(
                    'filter' => [
                        'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                        'PRODUCT_ID' => $items['BOX'],
                        'LID' => SITE_ID,
                    ],
                    'select' => array(
                        'ID',
                        'QUANTITY'
                    )
                ))->fetch();

                //if ($arBox['QUANTITY'] <= $items['BOX_COUNT'])
                //CSaleBasket::Delete($arBox['ID']);
                //else
                //CSaleBasket::Update($arBox['ID'], ['QUANTITY' => ($arBox['QUANTITY'] - $items['BOX_COUNT'])]);
            }

            // TODO: удаление набора
            $resBasket = CSaleBasket::GetList(
                ["NAME" => "ASC", "ID" => "ASC"],
                ["FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID],
                false,
                false,
                ['ID', 'NAME', 'PRODUCT_ID', 'PROPERTY_POINT']
            );
            while ($arBasket = $resBasket->Fetch()) {
                $dbRes = CSaleBasket::GetPropsList(
                    ["SORT" => "ASC"],
                    ["BASKET_ID" => $arBasket['ID'], 'CODE' => 'POINT']
                );

                while ($arRes = $dbRes->Fetch()) {
                    if ($arRes['VALUE'] == 'kit_' . $arElBasket['PRODUCT_ID']) {
                        $arDelIdKit[] = $arRes['BASKET_ID'];
                    }
                }
            }
        }
        $is_delete = CSaleBasket::Delete($basketItem);

        foreach ($arDelIdKit as $id) {
            CSaleBasket::Delete(intval($id));
        }
        return $is_delete;
    }

    function UpdateItem($basketItem, $countDoors, $countMouldings, $basket_quantity, $QUANTITY_BOXES)
    {
        // изменяем кол-во дверей, если новое значение отличается от текущего

        if ($countDoors && ($basket_quantity !== $countDoors)) {
            CSaleBasket::Update($basketItem, ['QUANTITY' => $countDoors]);
        }

        // изменяем кол-во коробок у товара

        if ($countMouldings !== false) {
            // получаем привязанную к товару коробку
            $basket = CSaleBasket::GetPropsList([], [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'BASKET_ID' => $basketItem,
                'LID' => SITE_ID,
            ],
                false,
                false,
                []
            );

            $boxID = 0;
            $boxCount = 0;
            $arProductProp = []; // нужно для обновления свойств у товара
            while ($next = $basket->Fetch()) {
                $arProductProp[] = [
                    'NAME' => $next['NAME'],
                    'CODE' => $next['CODE'],
                    'VALUE' => $next['VALUE']
                ];

                switch ($next['CODE']) {
                    case 'BOX':
                        $boxID = $next['VALUE'];
                        break;
                    case 'BOX_COUNT':
                        $boxCount = $next['VALUE'];
                        break;
                }
            }

            // у товара есть коробка
            if ($boxID) {
                // получаем саму коробку
                $arBox = Bitrix\Sale\Internals\BasketTable::getList(array(
                    'filter' => [
                        'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                        'PRODUCT_ID' => $boxID,
                        'LID' => SITE_ID,
                    ],
                    'select' => array(
                        'ID',
                        'QUANTITY'
                    )
                ))->fetch();

                if ($countMouldings !== $boxCount) // увеличить кол-во коробок
                {
                    // увеличиваем кол-во самих коробок
                    if (CSaleBasket::Update($arBox['ID'], ['QUANTITY' => $QUANTITY_BOXES])) {
                        foreach ($arProductProp as &$value) {
                            if ($value['CODE'] === 'BOX_COUNT')
                                $value['VALUE'] = $QUANTITY_BOXES;
                        }

                        // обновляем кол-во коробок у товара
                        CSaleBasket::Update($basketItem, ['PROPS' => $arProductProp]);
                    }
                }
            }


//            CSaleBasket::Update($basketItem, ['QUANTITY' => $countDoors]);
        }
    }

    function addItemKit($kitId, $QUANTITY, $PRODUCT_ID){
        $resProduct = CIBlockElement::GetList(
            [],
            ['ID' => $PRODUCT_ID],
            false,
            false,
            []
        );
        if ($obProduct = $resProduct->GetNextElement()) {
            $arPropProd = $obProduct->GetProperties();
            $sizeVal = $arPropProd['SIZE']['VALUE'];

            $resKit = CIBlockElement::GetList(
                [],
                ['IBLOCK_SECTION_ID' => $kitId],
                false,
                false,
                ['ID', 'NAME', 'PROPERTY_SIZE_REF']
            );
            $arTrueSizeKit = [];
            $arNotTrueSizeKit = [];
            while ($arKit = $resKit->Fetch()) {
                if ($sizeVal == $arKit['PROPERTY_SIZE_REF_VALUE']){
                    $arTrueSizeKit[] = $arKit['ID'];
                } else if (empty($arKit['PROPERTY_SIZE_REF_VALUE'])){
                    $arNotTrueSizeKit[] = $arKit['ID'];
                }
            }
            if (!empty($arTrueSizeKit)){
                foreach ($arTrueSizeKit as $item){
                    $kit = Bitrix\Catalog\Product\Basket::addProduct(
                        [
                            'PRODUCT_ID' => $item,
                            'QUANTITY' => $QUANTITY,
                            'PROPS' => [
                                [
                                    'NAME' => 'Метка',
                                    'CODE' => 'POINT',
                                    'VALUE' => 'kit_' . $PRODUCT_ID,
                                ]
                            ]
                        ]
                    );
                }
            } else {
                foreach ($arNotTrueSizeKit as $item){
                    $kit = Bitrix\Catalog\Product\Basket::addProduct(
                        [
                            'PRODUCT_ID' => $item,
                            'QUANTITY' => $QUANTITY,
                            'PROPS' => [
                                [
                                    'NAME' => 'Метка',
                                    'CODE' => 'POINT',
                                    'VALUE' => 'kit_' . $PRODUCT_ID,
                                ]
                            ]
                        ]
                    );
                }
            }
        }

    }

    function addItemTest($PRODUCT_ID, $QUANTITY_BOXES, $QUANTITY, $kit_id = 0, $threshold = 'N')
    {
        $box_id = self::getBox($PRODUCT_ID, $threshold)['ID'];

        //TODO работа тут
        $resProduct = CIBlockElement::GetList(
            [],
            ['ID' => $PRODUCT_ID],
            false,
            false,
            []
        );

        if ($obProduct = $resProduct->GetNextElement()) {
            $arPropProd = $obProduct->GetProperties();

            $sizeVal = $arPropProd['SIZE']['VALUE'];

            $arProp = [];
            if ($QUANTITY_BOXES && $box_id) // добавление коробки
            {
                //file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/test.json' , json_encode($box_id, 256)."\r", FILE_APPEND);
                $mxResult = CCatalogSku::GetProductInfo($PRODUCT_ID);
                $resBox = CIBlockElement::GetList(
                    [],
                    ['IBLOCK_ID' => $mxResult['IBLOCK_ID'], 'ID' => $mxResult['ID']],
                    false,
                    false,
                    ['ID', 'PROPERTY_BOX_TRESHOLD', 'PROPERTY_BOX_NOT_TRESHOLD']
                );

                if ($res_item = $resBox->Fetch()) {
                    //if (($res_item['PROPERTY_BOX_TRESHOLD_VALUE'] || $res_item['PROPERTY_BOX_NOT_TRESHOLD_VALUE'])) {
                        //if ($QUANTITY_BOXES > $QUANTITY) // TODO: сделать чтобы на фронте нельзя было выбрать кол-во коробок больше кол-ва дверей
                        //$QUANTITY_BOXES = $QUANTITY; // TODO: Дима сказал не ограничивать пока что

                        //$box_id = ($res_item['PROPERTY_BOX_TRESHOLD_VALUE'] ?: $res_item['PROPERTY_BOX_NOT_TRESHOLD_VALUE']); // TODO: должно приходит в запросе, какая коробка, если их 2
                        $box = Bitrix\Catalog\Product\Basket::addProduct(
                            [
                                'PRODUCT_ID' => $box_id,
                                'QUANTITY' => $QUANTITY_BOXES,
                            ]
                        );

                        if ($box->isSuccess()) {
                            $arProp = [
                                [
                                    'NAME' => 'Коробка',
                                    'CODE' => 'BOX',
                                    'VALUE' => $box_id,
                                ],
                                [
                                    'NAME' => 'Кол-во коробок',
                                    'CODE' => 'BOX_COUNT',
                                    'VALUE' => $QUANTITY_BOXES,
                                ]
                            ];
                        }
                    //}
                }
            }

            $result = Bitrix\Catalog\Product\Basket::addProduct(
                [
                    'PRODUCT_ID' => $PRODUCT_ID, // id товара или предложения
                    'QUANTITY' => $QUANTITY, // количество
                    'PROPS' => $arProp
                ]
            );

            if (!$result->isSuccess()) {
                \Bitrix\Main\Diag\Debug::dump($result->getErrorMessages());
            } else {
                if ($arPropProd['KIT']['VALUE']) {
                    if ($kit_id == 0) {
                        $resKit = CIBlockElement::GetList(
                            [],
                            ['IBLOCK_SECTION_ID' => $arPropProd['KIT']['VALUE'][0]],
                            false,
                            false,
                            ['ID', 'NAME', 'PROPERTY_SIZE_REF', 'PROPERTY_COLOR_REF']
                        );
                        $arTrueSizeKit = [];
                        $arNotTrueSizeKit = [];
                        while ($arKit = $resKit->Fetch()) {
                            if (in_array($sizeVal, $arKit['PROPERTY_SIZE_REF_VALUE'])){
                                $arTrueSizeKit[] = $arKit['ID'];
                            } else if (empty($arKit['PROPERTY_SIZE_REF_VALUE'])){
                                $arNotTrueSizeKit[] = $arKit['ID'];
                            }
                        }
                        file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/test.json' , json_encode($sizeVal, 256)."\r", FILE_APPEND);
                        file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/test.json' , json_encode(['$arTrueSizeKit'=>$arTrueSizeKit,'$arNotTrueSizeKit'=>$arNotTrueSizeKit,], 256)."\r", FILE_APPEND);

                        if (!empty($arTrueSizeKit)){
                            foreach ($arTrueSizeKit as $item){
                                $kit = Bitrix\Catalog\Product\Basket::addProduct(
                                    [
                                        'PRODUCT_ID' => $item,
                                        'QUANTITY' => $QUANTITY,
                                        'PROPS' => [
                                            [
                                                'NAME' => 'Метка',
                                                'CODE' => 'POINT',
                                                'VALUE' => 'kit_' . $PRODUCT_ID,
                                            ]
                                        ]
                                    ]
                                );
                            }
                        } else {
                            foreach ($arNotTrueSizeKit as $item){
                                $kit = Bitrix\Catalog\Product\Basket::addProduct(
                                    [
                                        'PRODUCT_ID' => $item,
                                        'QUANTITY' => $QUANTITY,
                                        'PROPS' => [
                                            [
                                                'NAME' => 'Метка',
                                                'CODE' => 'POINT',
                                                'VALUE' => 'kit_' . $PRODUCT_ID,
                                            ]
                                        ]
                                    ]
                                );
                            }
                        }
                    } else {
                        foreach ($arPropProd['KIT']['VALUE'] as $kit) {

                            if ($kit == $kit_id) {

                                $resKit = CIBlockElement::GetList(
                                    [],
                                    ['IBLOCK_SECTION_ID' => $kit_id],
                                    false,
                                    false,
                                    ['ID', 'NAME', 'PROPERTY_SIZE_REF']
                                );
                                $arTrueSizeKit = [];
                                $arNotTrueSizeKit = [];
                                while ($arKit = $resKit->Fetch()) {
                                    if ($sizeVal == $arKit['PROPERTY_SIZE_REF_VALUE']){
                                        $arTrueSizeKit[] = $arKit['ID'];
                                    } else if (empty($arKit['PROPERTY_SIZE_REF_VALUE'])){
                                        $arNotTrueSizeKit[] = $arKit['ID'];
                                    }
                                }

                                if (!empty($arTrueSizeKit)){
                                    foreach ($arTrueSizeKit as $item){
                                        $kit = Bitrix\Catalog\Product\Basket::addProduct(
                                            [
                                                'PRODUCT_ID' => $item,
                                                'QUANTITY' => $QUANTITY,
                                                'PROPS' => [
                                                    [
                                                        'NAME' => 'Метка',
                                                        'CODE' => 'POINT',
                                                        'VALUE' => 'kit_' . $PRODUCT_ID,
                                                    ]
                                                ]
                                            ]
                                        );
                                    }
                                } else {
                                    foreach ($arNotTrueSizeKit as $item){
                                        $kit = Bitrix\Catalog\Product\Basket::addProduct(
                                            [
                                                'PRODUCT_ID' => $item,
                                                'QUANTITY' => $QUANTITY,
                                                'PROPS' => [
                                                    [
                                                        'NAME' => 'Метка',
                                                        'CODE' => 'POINT',
                                                        'VALUE' => 'kit_' . $PRODUCT_ID,
                                                    ]
                                                ]
                                            ]
                                        );
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return $result->getData()['ID'];
        }
    }

    function newDeleteItem($basket)
    {
        $is_box_delete = false;
        if ($basket['BOX']['ID']) {
            $box = self::getItemBoxTest($basket['BOX']['ID']);
            if ($basket['BOX']['QUANTITY'] != $box['QUANTITY']) {
                $is_box_delete = CSaleBasket::Update($box['ID'], ['QUANTITY' => ($box['QUANTITY'] - $basket['BOX']['QUANTITY'])]);
            } else {
                $is_box_delete = CSaleBasket::Delete($box['ID']);
            }
        }
        if (CSaleBasket::Delete($basket['ID'])) {
            if ($basket['KIT']) {
                foreach ($basket['KIT'] as $kit) {
                    CSaleBasket::Delete($kit['ID']);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function newUpdateItem($basket, $QUANTITY)
    {
        if (CSaleBasket::Update($basket['ID'], ['QUANTITY' => $QUANTITY])) {
            if ($basket['KIT']) {
                foreach ($basket['KIT'] as $kit) {
                    CSaleBasket::Update($kit['ID'], ['QUANTITY' => $QUANTITY]);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function addItemBox($basket, $box_id, $QUANTITY_BOXES)
    {
        $arProductProp = $basket['PRODUCT_PROPS'];

        if ($box = self::getItemBox($box_id)) {
            CSaleBasket::Update($basket['BOX']['ID'], ['QUANTITY' => $QUANTITY_BOXES]);
            $is_add = true;
        } else {
            $box = Bitrix\Catalog\Product\Basket::addProduct(
                [
                    'PRODUCT_ID' => $box_id,
                    'QUANTITY' => $QUANTITY_BOXES,
                    'PROPS' => [
                        [
                            'NAME' => 'Id двери',
                            'CODE' => 'DOOR_ID',
                            'VALUE' => $basket['PRODUCT_ID'],
                        ]
                    ]
                ]
            );

            $is_add = $box->isSuccess();
        }


        if ($is_add) {

            $arProductProp[] = [
                'NAME' => 'Коробка',
                'CODE' => 'BOX',
                'VALUE' => $box_id,
            ];

            $arProductProp[] = [
                'NAME' => 'Коробка',
                'CODE' => 'BOX_BASKET_ID',
                'VALUE' => $box->getData()['ID'],
            ];

            $arProductProp[] = [
                'NAME' => 'Кол-во коробок',
                'CODE' => 'BOX_COUNT',
                'VALUE' => $QUANTITY_BOXES,
            ];

            CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
            return true;
        } else {
            return false;
        }
    }

    function addItemBoxTest($basket, $box_id, $QUANTITY_BOXES)
    {
        $arProductProp = $basket['PRODUCT_PROPS'];

        if ($box = self::getItemBox($box_id)) {
            CSaleBasket::Update($box['ID'], ['QUANTITY' => $box['QUANTITY'] + $QUANTITY_BOXES]);
            $is_add = true;
        } else {
            $box = Bitrix\Catalog\Product\Basket::addProduct(
                [
                    'PRODUCT_ID' => $box_id,
                    'QUANTITY' => $QUANTITY_BOXES,
                ]
            );

            $is_add = $box->isSuccess();
        }


        if ($is_add) {

            $arProductProp[] = [
                'NAME' => 'Коробка',
                'CODE' => 'BOX',
                'VALUE' => $box_id,
            ];

            $arProductProp[] = [
                'NAME' => 'Кол-во коробок',
                'CODE' => 'BOX_COUNT',
                'VALUE' => $QUANTITY_BOXES,
            ];

            CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
            return true;
        } else {
            return false;
        }
    }

    function deleteItemBox($basket, $item_box)
    {
        $arProductProp = $basket['PRODUCT_PROPS'];
        if (CSaleBasket::Delete($item_box['ID'])) {
            foreach ($arProductProp as $key => $prop) {
                if ($prop['CODE'] == 'BOX') {
                    unset($arProductProp[$key]);
                }
                if ($prop['CODE'] == 'BOX_COUNT') {
                    unset($arProductProp[$key]);
                }
            }
            CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
            return true;
        } else {
            return false;
        }
    }

    function deleteItemBoxTest($basket, $item_box)
    {
        $box = self::getItemBoxTest($basket['BOX']['ID']);
        if ($basket['BOX']['QUANTITY'] != $box['QUANTITY']) {
            CSaleBasket::Update($box['ID'], ['QUANTITY' => ($box['QUANTITY'] - $basket['BOX']['QUANTITY'])]);
        } else {
            CSaleBasket::Delete($box['ID']);
        }
        $arProductProp = $basket['PRODUCT_PROPS'];
        foreach ($arProductProp as $key => $prop) {
            if ($prop['CODE'] == 'BOX') {
                unset($arProductProp[$key]);
            }
            if ($prop['CODE'] == 'BOX_COUNT') {
                unset($arProductProp[$key]);
            }
        }
        CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
        return true;
    }

    function updateItemBox($basket, $item_box, $QUANTITY_BOXES)
    {
        $arProductProp = $basket['PRODUCT_PROPS'];
        if (CSaleBasket::Update($item_box['ID'], ['QUANTITY' => $QUANTITY_BOXES])) {
            foreach ($arProductProp as &$value) {
                if ($value['CODE'] === 'BOX_COUNT') {
                    $value['VALUE'] = $QUANTITY_BOXES;
                }
            }
            // обновляем кол-во коробок у товара
            CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
        }
    }

    function updateItemBoxTest($basket, $item_box, $QUANTITY_BOXES)
    {
        $arProductProp = $basket['PRODUCT_PROPS'];
        $box_total = $item_box['QUANTITY'] - $basket['BOX']['QUANTITY'];
        if (CSaleBasket::Update($item_box['ID'], ['QUANTITY' => ($box_total + $QUANTITY_BOXES)])) {
            foreach ($arProductProp as &$value) {
                if ($value['CODE'] === 'BOX_COUNT') {
                    $value['VALUE'] = $QUANTITY_BOXES;
                }
            }
            // обновляем кол-во коробок у товара
            CSaleBasket::Update($basket['ID'], ['PROPS' => $arProductProp]);
            return true;
        } else {
            return false;
        }
    }

    function getItemBox($box_id)
    {
        $box = Bitrix\Sale\Internals\BasketTable::getList(array(
            'filter' => [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'ID' => (int)$box_id,
                'LID' => SITE_ID,
            ],
            'select' => array(
                'ID',
                'PRODUCT_ID',
                'QUANTITY',
                'PRICE'
            )
        ))->fetch();

        if ($box) {
            return [
                'ID' => $box['ID'],
                'PRODUCT_ID' => $box['PRODUCT_ID'],
                'QUANTITY' => $box['QUANTITY'],
                'PRICE' => $box['PRICE']
            ];
        } else {
            return false;
        }
    }

    function getItemBoxTest($box_id)
    {
        $box = Bitrix\Sale\Internals\BasketTable::getList(array(
            'filter' => [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'PRODUCT_ID' => (int)$box_id,
                'LID' => SITE_ID,
            ],
            'select' => array(
                'ID',
                'PRODUCT_ID',
                'QUANTITY',
                'PRICE'
            )
        ))->fetch();

        if ($box) {
            return [
                'ID' => $box['ID'],
                'PRODUCT_ID' => $box['PRODUCT_ID'],
                'QUANTITY' => $box['QUANTITY'],
                'PRICE' => $box['PRICE']
            ];
        } else {
            return false;
        }
    }

    function getItem($basketItem)
    {
        $arProductProp = [];
        $kit = false;
        $box = false;
        $basket = Bitrix\Sale\Internals\BasketTable::getList(array(
            'filter' => [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'ID' => $basketItem,
                'LID' => SITE_ID,
            ],
            'select' => array(
                'ID',
                'PRODUCT_ID',
                'QUANTITY'
            )
        ))->fetch();

        $basket_item_props = CSaleBasket::GetPropsList([], [
            'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
            'BASKET_ID' => $basketItem,
            'LID' => SITE_ID,
        ],
            false,
            false,
            []
        );

        while ($next = $basket_item_props->Fetch()) {
            $arProductProp[] = [
                'NAME' => $next['NAME'],
                'CODE' => $next['CODE'],
                'VALUE' => $next['VALUE']
            ];
            switch ($next['CODE']) {
                case 'BOX':
                    $box['ID'] = $next['VALUE'];
                    break;
                case 'BOX_COUNT':
                    $box['QUANTITY'] = $next['VALUE'];
                    break;
            }
        }

        $resBasket = CSaleBasket::GetList(
            ["NAME" => "ASC", "ID" => "ASC"],
            ["FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID],
            false,
            false,
            ['ID', 'NAME', 'PRICE', 'QUANTITY', 'PRODUCT_ID', 'PROPERTY_POINT']
        );
        while ($arBasket = $resBasket->Fetch()) {
            $dbRes = CSaleBasket::GetPropsList(
                ["SORT" => "ASC"],
                ["BASKET_ID" => $arBasket['ID'], 'CODE' => 'POINT']
            );

            while ($arRes = $dbRes->Fetch()) {
                if ($arRes['VALUE'] == 'kit_' . $basket['PRODUCT_ID']) {
                    $kit[] = [
                        'ID' => $arBasket['ID'],
                        'NAME' => $arBasket['NAME'],
                        'PRICE' => $arBasket['PRICE'],
                        'QUANTITY' => $arBasket['QUANTITY'],
                    ];
                }
            }
        }

        if ($basket) {
            return [
                'ID' => $basket['ID'],
                'PRODUCT_ID' => $basket['PRODUCT_ID'],
                'QUANTITY' => $basket['QUANTITY'],
                'BOX' => $box,
                'PRODUCT_PROPS' => $arProductProp,
                'KIT' => $kit,
            ];
        } else {
            return false;
        }
    }

    function getBasketItemID($product_id)
    {
        $item = Bitrix\Sale\Internals\BasketTable::getList(array(
            'filter' => [
                'FUSER_ID' => Bitrix\Sale\Fuser::getId(),
                'PRODUCT_ID' => $product_id,
                'LID' => SITE_ID,
            ],
            'select' => array(
                'ID',
            )
        ))->fetch();
        return $item['ID'];
    }
}

?>
