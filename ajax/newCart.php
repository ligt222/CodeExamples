<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

//if ($_GET['ajax_add'] == 'Y') {
Bitrix\Main\Loader::includeModule("catalog");
$fields = [
    'PRODUCT_ID' => 545, // ID товара, обязательно
    'QUANTITY' => 1, // количество, обязательно
];
$r = Bitrix\Catalog\Product\Basket::addProduct($fields);
if ($r->isSuccess()) {
    $resElement = CIBlockElement::GetByID($fields['PRODUCT_ID']);
    if ($arElement = $resElement->Fetch()) {
        $name = $arElement['NAME'];

        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'name' => $name], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        die;
    }
} else {
    var_dump($r->getErrorMessages());
}
//}

