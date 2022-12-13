<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->SetPageProperty("header_page_wrapper", " mainpage");

ob_start();
$APPLICATION->IncludeComponent(
    "bitrix:catalog.smart.filter",
    "filter_sect",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "FILTER_NAME" => 'arrFilter',
        "PRICE_CODE" => $arParams["~PRICE_CODE"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SAVE_IN_SESSION" => "N",
        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
        "XML_EXPORT" => "N",
        "SECTION_TITLE" => "NAME",
        "SECTION_DESCRIPTION" => "DESCRIPTION",
        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        "SEF_MODE" => $arParams["SEF_MODE"],
        "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
    ),
    $component
);

$arResult['interna_filter'] = ob_get_contents();
ob_end_clean();
?>
<main class="b-main" role="main">
    <div class="b-container">
    <?
        if ($_GET['set_filter'] == 'Y')
        {
            if ($GLOBALS['arrFilter'])
            {
                $arrFilterSect = [];
                $res = CIBlockElement::GetList(
                    array(),
                    $GLOBALS['arrFilter'],
                    array('IBLOCK_SECTION_ID'),
                    array(),
                    array(
                        'ID',
                        'IBLOCK_SECTION_ID'
                    )
                );

                while ($arFields = $res->Fetch())
                {
                    $arrFilterSect[] = $arFields['IBLOCK_SECTION_ID'];
                }

                if ($arrFilterSect)
                {
                    $GLOBALS['arrFilterSect']['=ID'] = $arrFilterSect;
                }
            }
        }

        if (!empty($GLOBALS['arrFilter']) && empty($GLOBALS['arrFilterSect']))
        {
            echo 'Нет элементов';
        }
        else
        {
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "catalog_door_section",
                array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                    "TOP_DEPTH" => 1,
                    "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
                    "FILTER_NAME" => "arrFilterSect",
                    "AJAX_MODE" => 'Y'
                ),
                $component,
                ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
            );
        }
        if ($_GET['set_filter'] == 'Y')
        {
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo json_encode(['result' => $GLOBALS['RESULT'], 'filter' => $GLOBALS['FILTER_RESULT']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            die;
        }
    ?>

    </div>
</main>
<aside class="b-aside js-aside">
    <div class="b-filter js-filter">
        <div class="b-filter__inner">
            <div class="b-top-aside b-top-aside--mainpage">
                <div class="b-top-aside__inner">
                    <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "cart_link", array(
                            "HIDE_ON_BASKET_PAGES" => "Y",
                            "PATH_TO_BASKET" => "/cart/",
                            "PATH_TO_ORDER" => '',
                            "PATH_TO_PERSONAL" => '',
                            "PATH_TO_PROFILE" => '',
                            "PATH_TO_REGISTER" => '',
                            "POSITION_FIXED" => "Y",
                            "POSITION_HORIZONTAL" => "right",
                            "POSITION_VERTICAL" => "top",
                            "SHOW_AUTHOR" => "Y",
                            "SHOW_DELAY" => "N",
                            "SHOW_EMPTY_VALUES" => "Y",
                            "SHOW_IMAGE" => "Y",
                            "SHOW_NOTAVAIL" => "N",
                            "SHOW_NUM_PRODUCTS" => "Y",
                            "SHOW_PERSONAL_LINK" => "N",
                            "SHOW_PRICE" => "Y",
                            "SHOW_PRODUCTS" => "Y",
                            "SHOW_SUMMARY" => "Y",
                            "SHOW_TOTAL_PRICE" => "Y"
                        )
                    ); ?>
                    <div class="b-top-aside__item b-top-aside__item--login">
                        <? if (!$USER->IsAuthorized()): ?>
                            <a class="b-top-aside__link js-login js-authorization-open"
                               href="javascript:void(0);">
                                <span class="b-top-aside__icon">
                                    <i class="b-icon icon-log-in"></i>
                                </span>
                                <span class="b-top-aside__text">
                                        Войти
                                </span>
                            </a>
                        <? else : ?>
                            <a class="b-top-aside__link authorized js-open-popup" data-popup="logout""
                               href="javascript:void(0);">
                                <span class="b-top-aside__icon">
                                    <i class="b-icon icon-log-in"></i>
                                </span>
                                <span class="b-top-aside__text">
                                    <?= $USER->GetLogin() ?>
                                </span>
                            </a>
                        <? endif; ?>
                    </div>
                </div>
            </div>
            <?= $arResult['interna_filter']; ?>
        </div>
    </div>
</aside>
