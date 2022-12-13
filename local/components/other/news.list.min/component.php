<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;

$arParams['FILTER_NAME'] = (empty($arParams['FILTER_NAME'])) ? 'arrFilter' : $arParams['FILTER_NAME'];
$arrFilter = (!is_array($GLOBALS[$arParams['FILTER_NAME']])) ? [] : $GLOBALS[$arParams['FILTER_NAME']];

if($this->startResultCache(false, array(false, $arrFilter, $arParams['CACHE_NUMBER'])))
{
	if(!Loader::includeModule('iblock'))
	{
		$this->abortResultCache();
		ShowError(GetMessage('IBLOCK_MODULE_NOT_INSTALLED'));
		return;
	}

	$arSelect = array_merge($arParams['FIELD_CODE'], ['ID', 'IBLOCK_ID', 'NAME']);

	if (!empty($arParams['PROPERTY_CODE']) && is_array($arParams['PROPERTY_CODE']))
    {
        $prop = [];
        foreach ($arParams['PROPERTY_CODE'] as $value)
        {
            if ($value)
            {
                $prop[] = 'PROPERTY_'.$value;
            }
        }

        $arSelect = array_merge($prop, $arSelect);
        $bGetProperty = true;

        unset($prop);
    }
	else
    {
        $bGetProperty = (!empty($arrFilter));
    }

    $arFilter = [
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'ACTIVE' => 'N'
    ];

	if ($arParams['ID'])
    {
        if (is_numeric($arParams['ID']))
            $arFilter['ID'] = $arParams['ID'];
        else
            $arFilter['CODE'] = $arParams['ID'];
    }

	if (is_numeric($arParams['IBLOCK_ID']))
	    $arFilter['IBLOCK_ID'] = $arParams['IBLOCK_ID'];
	else
        $arFilter['IBLOCK_CODE'] = $arParams['IBLOCK_ID'];

    if ($arParams['ACTIVE'] == 'Y')
    {
        $arFilter['ACTIVE_DATE'] = 'Y';
        $arFilter['ACTIVE'] = 'Y';
    }

    $newsCount = intval($arParams['NEWS_COUNT']);
    if ($newsCount === 0)
    {
        $newsCount = 20;
    }

    if (is_array($arrFilter))
    {
        $arFilter = array_merge($arFilter, $arrFilter);
    }

    $rsElement = CIBlockElement::GetList(
        [$arParams['SORT_BY1'] => $arParams['SORT_ORDER1']],
        $arFilter,
        false,
        ['nPageSize'=>$newsCount],
        $arSelect);

    $arResult['ITEMS'] = array();
    if ($arParams['DETAIL_PAGE_URL'] === 'N')
    {
        while ($row = $rsElement->fetch())
        {
            $arResult['ITEMS'][$row['ID']] = $row;
        }
    }
    else
    {
        while ($row = $rsElement->GetNext())
        {
            $arResult['ITEMS'][$row['ID']] = $row;
        }
    }

	unset($arSelect);
	unset($rsElement);
	unset($row);

	if (empty($arResult['ITEMS']))
	{
        $this->abortResultCache();
	}


	foreach ($arResult['ITEMS'] as &$arItem)
	{
	    if (!empty($arItem['PREVIEW_PICTURE']))
        {
            $arItem['PREVIEW_PICTURE'] = CFile::GetPath($arItem['PREVIEW_PICTURE']);
        }
	    if (!empty($arItem['DETAIL_PICTURE']))
        {
            $arItem['DETAIL_PICTURE'] = CFile::GetPath($arItem['DETAIL_PICTURE']);
        }
	}

	unset($arItem);

    $this->setResultCacheKeys([]);

    if(isset($_REQUEST["ajax"]) && $_REQUEST["ajax"] === "y")
    {
        ob_start();
        $this->IncludeComponentTemplate("ajax");
        $json = ob_get_contents();

        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
        die;
    }
    else
    {
        $this->IncludeComponentTemplate();
    }
}

return $arResult;