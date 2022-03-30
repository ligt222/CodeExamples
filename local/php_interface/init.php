<?php
if (!defined('BX_DISABLE_INDEX_PAGE')) {
    define('BX_DISABLE_INDEX_PAGE', true);
}

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockElementAdd', array(
    'PropElem',
    'OnAfterIBlockElementAddProp'
));

EventManager::getInstance()->addEventHandler('iblock', 'OnAfterIBlockElementUpdate', array(
    'PropElem',
    'OnAfterIBlockElementUpdateProp'
));

class PropElem
{
    function OnAfterIBlockElementAddProp(&$arFields)
    {
        $res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION'][0]);
        if ($arRes = $res->GetNext()){
            CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arFields['IBLOCK_ID'], array('SERIES_SECT' => $arRes['NAME']));
        }
    }
    function OnAfterIBlockElementUpdateProp(&$arFields)
    {
        $res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION'][0]);
        if ($arRes = $res->GetNext()){
            CIBlockElement::SetPropertyValuesEx($arFields['ID'], $arFields['IBLOCK_ID'], array('SERIES_SECT' => $arRes['NAME']));
        }
    }
}