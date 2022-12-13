<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Main\Mail\Event;
global $APPLICATION;
$boxTest = $_REQUEST['box-test'];
$success = false;

$arFields = [
    'SIMPLE_QUESTION_486' => $_REQUEST['form_text_4'],
    'SIMPLE_QUESTION_751' => $_REQUEST['form_email_5'],
    'SIMPLE_QUESTION_761' => $_REQUEST['form_text_6'],
    'SIMPLE_QUESTION_589' => $_REQUEST['form_textarea_7']
];

$arMail = [
    'EVENT_NAME' => 'FORM_FILLING_SIMPLE_FORM_2',
    'LID' => 's1',
    'C_FIELDS' => $arFields
];


if ( $_SERVER['REQUEST_METHOD'] === 'POST' ): ?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:form.result.new",
        "feedback",
        Array(
            "SEF_MODE" => "N",
            "WEB_FORM_ID" => 2,
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "Y",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600000",
            "SEF_FOLDER" => "/",
            "VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
        ),false, ['HIDE_ICONS' => 'Y']
    );?>
<? endif;

if (Event::send($arMail) && $boxTest == 'on'){
    $success = true;
}
$APPLICATION->RestartBuffer();
header('Content-Type: application/json');
echo json_encode(['success' => $success,], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
die;