<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$sectionListParams = array(
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
    "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
    "FILTER_NAME" => "arrFilterSect",
    "AJAX_MODE" => 'Y'
);
if ($sectionListParams["COUNT_ELEMENTS"] === "Y") {
    $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
    if ($arParams["HIDE_NOT_AVAILABLE"] == "Y") {
        $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
    }
}
?>
<?

ob_start();
$APPLICATION->IncludeComponent(
    "bitrix:catalog.smart.filter",
    "filter_sect",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "SECTION_ID" => $arCurSection['ID'],
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

        if ($_REQUEST['AJAX_CALL'] == 'Y') {

            $arrFilterSect = array();
            $i = 0;
            $res = CIBlockElement::GetList(
                array(),
                $GLOBALS['FILTER_ELEM_SECT'],
                array('IBLOCK_SECTION_ID'),
                array(),
                array(
                    'ID',
                    'IBLOCK_SECTION_ID'
                )
            );
            while ($arFields = $res->Fetch()) {
                $arrFilterSect[$i] = $arFields['IBLOCK_SECTION_ID'];
                $i++;
            }
            if ($arrFilterSect) {
                $GLOBALS['arrFilterSect']['=ID'] = $arrFilterSect;
            } else {
                $GLOBALS['arrFilterSect'] = array();
            }
        }
        if (!empty($GLOBALS['FILTER_ELEM_SECT']) && empty($GLOBALS['arrFilterSect'])) {
            echo 'Нет элементов';
        } else {
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "catalog_door_section",
                $sectionListParams,
                $component,
                ($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
            );
        }
        if ($_REQUEST['AJAX_CALL'] == 'Y') {
            $APPLICATION->RestartBuffer();
            header('Content-Type: application/json');
            echo json_encode(['result' => $GLOBALS['RESULT'], 'filter' => $GLOBALS['FILTER_RESULT']], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            die;
        }

        unset($sectionListParams);
        ?>

    </div>
</main>
<aside class="b-aside js-aside">
    <div class="b-filter js-filter">
        <div class="b-filter__inner">
            <div class="b-top-aside b-top-aside--mainpage">
                <div class="b-top-aside__inner">
                    <div class="b-top-aside__item b-top-aside__item--cart"><a class="b-link-cart"
                                                                              href="/cart.html"><span
                                    class="b-link-cart__icon"><i class="b-icon icon-basket"></i><span
                                        class="b-link-cart__counter"><span>3</span></span></span><span
                                    class="b-link-cart__text">Корзина</span></a>
                    </div>
                    <div class="b-top-aside__item b-top-aside__item--login">
                        <a class="b-top-aside__link js-login js-authorization-open"
                           href="javascript:void(0);">
                            <span class="b-top-aside__icon">
                                <i class="b-icon icon-log-in"></i>
                            </span>
                            <span class="b-top-aside__text">
                                <?if($USER->IsAuthorized()):?>
                                    <?=$USER->GetLogin()?>
                                <?else:?>
                                    Войти
                                <?endif;?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <?= $arResult['interna_filter']; ?>
        </div>
    </div>
</aside>
