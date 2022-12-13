<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;

const MY_HL_BLOCK_ID = 7;

CModule::IncludeModule('highloadblock');

function GetEntityDataClass($HlBlockId)
{
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}

$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
    'select' => array('UF_XML_ID','UF_NAME', 'UF_LINK', 'UF_FILE'),
    'filter' => array(
        'UF_XML_ID' => $arResult['PROPERTIES']['LIST_CITIES_RUS']['VALUE']
    ),
    'order' => ['UF_SORT' => 'ASC']
));
while($el = $rsData->fetch()){
    $arUf = [];
    $arUf['NAME'] = $el['UF_NAME'];
    $arUf['LINK'] = $el['UF_LINK'];
    $arUf['FILE_SRC'] = CFile::GetPath($el['UF_FILE']);

    $arResult['CITIES_LIST'][] = $arUf;
}
?>