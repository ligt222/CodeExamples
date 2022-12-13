<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$result = [];
foreach ($arResult['GRID']['ROWS'] as $key=>$item) {
    if (!$item['PROPS_ALL']['POINT']) {
        $result[$key]['name'] = 'Дверь';
        $result[$key]['price'] = $item['FULL_PRICE_FORMATED'];
        foreach ($arResult['GRID']['ROWS'] as $kit) {
            if ($kit['PROPS_ALL']['POINT']['VALUE'] == 'kit_' . $item['PRODUCT_ID']) {

                $result[$key]['sub_item'][] = [
                    'name' => $kit['NAME'],
                    'price' => $kit['FULL_PRICE_FORMATED'],
                    'count' => $item['QUANTITY']
                ];

            }
        }

    }
}

$arResult['ITEMS'] = [];
$sub_items = [];
$total_item_price = 0;

foreach ( $arResult['GRID']['ROWS'] as $item ) {
    if ( !$item['PROPS_ALL']['POINT'] ) {

        $sub_items[] = [
            "name" => $item['NAME'],
            "price" => $item['FULL_PRICE_FORMATED'],
            "count" => $item['QUANTITY'],
        ];

        $total_item_price = $item['FULL_PRICE_FORMATED'];

        foreach ( $arResult['GRID']['ROWS'] as $kit ) {
            if ( $kit['PROPS_ALL']['POINT']['VALUE'] == 'kit_' . $item['PRODUCT_ID'] ) {

                $sub_items[] = [
                    "name" => $kit['NAME'],
                    "price" => $kit['FULL_PRICE_FORMATED'],
                    "count" => 1,
                ];

                $total_item_price += $kit['FULL_PRICE_FORMATED'];
            }
        }
        $arResult['ITEMS']['items'][] = [
            "name" => "Дверь",
            "price" => $total_item_price,
            "sub_item" => $sub_items,
        ];
    }
    $total_item_price = 0;
    $sub_items = [];
}
$arResult['ITEMS']['total'] = $arResult['allSum_FORMATED'];


$arResult['RESULT'] = $result;

$this->__component->SetResultCacheKeys(['RESULT']);

/*{
    "items": [
    {
        "name": "Viva-Luxur",
      "price": "26 350",
      "sub_item": [
        {
            "name": "Дверь",
          "price": "12 100",
          "count": 1
        }
      ]
    },
    {
        "name": "Viva-Luxur",
      "price": "26 350",
      "sub_item": [
        {
            "name": "Дверь",
          "price": "12 100",
          "count": 1
        },
        {
            "name": "Погонаж",
          "price": "14 250",
          "count": 1
        }
      ]
    }
  ],
  "total": "79 050"
}*/