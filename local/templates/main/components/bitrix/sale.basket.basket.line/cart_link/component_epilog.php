<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//CJSCore::Init(array('fx', 'popup'));

//$GLOBALS['CNT_PRODUCT'] = $arResult['CNT_PRODUCT'];

if ($_REQUEST['ajax_add'] == 'Y')
{
    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode(['count_product' => $arResult['CNT_PRODUCT']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    die;
}
