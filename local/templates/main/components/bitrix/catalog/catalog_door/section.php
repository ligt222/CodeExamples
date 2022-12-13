<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->SetTitle("Конструктор");
$APPLICATION->SetPageProperty("showPopupConstructor", "Y");
?>

<main class="b-main" role="main">
    <div class="b-container">
        <div class="b-constructor-slider">
            <div class="b-constructor-slider__head">
                <nav class="b-breadcrumbs">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "bread_doors",
                        array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "s1"
                        )
                    ); ?>
                </nav>
                <? $APPLICATION->IncludeComponent(
                    "other:news.list.min",
                    "color_inter",
                    Array(
                        "ACTIVE" => "Y",
                        "CACHE_TIME" => "3600000",
                        "CACHE_TYPE" => "A",
                        "ID" => "",
                        "DETAIL_PAGE_URL" => "N",
                        "FIELD_CODE" => ['CODE'],
                        "FILTER_NAME" => "",
                        "IBLOCK_ID" => "5",
                        "IBLOCK_TYPE" => "content",
                        "NEWS_COUNT" => "99",
                        "PROPERTY_CODE" => [
                            'COLOR_ONE',
                            'COLOR_TWO',
                        ],
                        "GET_IBLOCK_NAME" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC"
                    ),
                    false,
                    Array('HIDE_ICONS' => 'Y')
                ); ?>
            </div>
            <div class="b-constructor-slider__gallery">
                <? $APPLICATION->IncludeComponent(
                    "other:news.list.min",
                    "color_style",
                    Array(
                        "ACTIVE" => "Y",
                        "CACHE_TIME" => "3600000",
                        "CACHE_TYPE" => "A",
                        "ID" => "",
                        "DETAIL_PAGE_URL" => "N",
                        "FIELD_CODE" => ['CODE', 'PREVIEW_PICTURE'],
                        "FILTER_NAME" => "",
                        "IBLOCK_ID" => "5",
                        "IBLOCK_TYPE" => "content",
                        "NEWS_COUNT" => "99",
                        "PROPERTY_CODE" => [
                            'COLOR_ONE',
                        ],
                        "GET_IBLOCK_NAME" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC"
                    ),
                    false,
                    Array('HIDE_ICONS' => 'Y')
                ); ?>
                <?
                //$GLOBALS['arrFilter'] = ['PROPERTY_CML2_LINK' => 558];
                if ( $_REQUEST['ajax'] == 'Y' || $_REQUEST['id'] ) {
                    $GLOBALS['arrFilter'] = [
                        'PROPERTY_CML2_LINK' => $_REQUEST['id'],
                        'ACTIVE' => 'Y'
                    ];
                } else {
                    $resProduct = CIBlockElement::GetList(
                        ['ID' => 'ASC'],
                        ['IBLOCK_ID' => 3, 'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE']],
                        false,
                        false,
                        []
                    );
                    $resInfo = $resProduct->GetNext();
                    $item_id = $resInfo['ID'];
                    $GLOBALS['arrFilter'] = [
                        'PROPERTY_CML2_LINK' => $resInfo['ID'],
                        'ACTIVE' => 'Y'
                    ];
                }

                ob_start();

                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.smart.filter",
                    "constructor",
                    array(
                        "COMPONENT_TEMPLATE" => "constructor",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "4",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "FILTER_NAME" => "arrFilter",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "FILTER_VIEW_MODE" => "horizontal",
                        "DISPLAY_ELEMENT_COUNT" => "Y",
                        "SEF_MODE" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "SAVE_IN_SESSION" => "N",
                        "INSTANT_RELOAD" => "Y",
                        "PAGER_PARAMS_NAME" => "arrPager",
                        "PRICE_CODE" => array(),
                        "CONVERT_CURRENCY" => "Y",
                        "XML_EXPORT" => "N",
                        "SECTION_TITLE" => "-",
                        "SECTION_DESCRIPTION" => "-",
                        "POPUP_POSITION" => "left",
                        "SEF_RULE" => "/examples/books/#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
                        "SECTION_CODE_PATH" => "",
                        "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
                        "CURRENCY_ID" => "RUB",
                        "PREFILTER_NAME" => "arrFilter",
                        "SIZE_MIN" => $arResult['SIZE']['MIN'],
                        "SIZE_MAX" => $arResult['SIZE']['MAX'],
                        "ITEM_ID" => ( $item_id ) ? $item_id : false,
                    ),
                    false
                );
                $arResult['filter_sku'] = ob_get_contents();
                ob_end_clean();

                if ($_REQUEST['change-load'] == 'Y')
                {
                    $APPLICATION->RestartBuffer();
                    header('Content-Type: application/json');
                    echo json_encode(['change_load' => $GLOBALS['RESULT_FILTER']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                    die;
                }
                ?>
                <div class="b-constructor-slider__doors-wrap">
                    <a class="b-constructor-slider__link js-open-popup js-open-feedback" href="javascript:void(0);" data-popup="door-view">
                        <img class="b-constructor-slider__door js-door-target js-image-wrapper" src="<?=$GLOBALS['RESULT_FILTER']['image']?>" alt="" loading="lazy" role="presentation"/>
                    </a>
                </div>
            </div>


            <? $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "product_door",
                array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "FILTER_NAME" => "arrFilter",
                    "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                    "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                    "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                    "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                    "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                    "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                    "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                    "BASKET_URL" => $arParams["BASKET_URL"],
                    "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                    "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                    "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                    "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                    "PAGE_ELEMENT_COUNT" => 9999,
                    "PRICE_CODE" => $arParams["~PRICE_CODE"],
                    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                    "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "ADD_SECTIONS_CHAIN" => "Y",

                    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                    "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                    "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                    "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                    "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                    "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                    "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                    "OFFERS_LIMIT" => 1,

                    "SECTION_ID" => $intSectionID,
                    "SECTION_CODE" => $arResult['VARIABLES']['SECTION_CODE'],
                    "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                    "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                    "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                    'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                    'LABEL_PROP' => $arParams['LABEL_PROP'],
                    'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                    'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                    'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
                    'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                    'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                    'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                    'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                    'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                    "DISPLAY_TOP_PAGER" => 'N',
                    "DISPLAY_BOTTOM_PAGER" => 'N',
                    "HIDE_SECTION_DESCRIPTION" => "Y",

                    "RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                    "SHOW_FROM_SECTION" => 'Y',

                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                    'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                    'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                    'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                    'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                    'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                    'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                    'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                    'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                    'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                    'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                    'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                    'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                    'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                    'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                    'ADD_TO_BASKET_ACTION' => $arParams['SECTION_ADD_TO_BASKET_ACTION'],
                    'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                    'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                    'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                    'USE_COMPARE_LIST' => 'Y',
                    'BACKGROUND_IMAGE' => '',
                    'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
//                            'IMAGE' =>
                    "SECTION_USER_FIELDS" => ['UF_OG_IMAGE'],
                ),
                $component
            );

            if ($_GET['ajax'] == 'Y')
            {
                // TODO: используется?
                $APPLICATION->RestartBuffer();
                header('Content-Type: application/json');
                echo json_encode(['filter' => $GLOBALS['FILTER_RESULT']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                die;
            }

            if ($_GET['ajax_sku'] == 'Y')
            {
                // TODO: используется?
                $APPLICATION->RestartBuffer();
                header('Content-Type: application/json');
                echo json_encode(['result' => $GLOBALS['SKU_RESULT']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                die;
            }
            ?>
            <div class="b-constructor-slider__button">
                <button class="b-button b-button--with-icon js-aside-open"><span>Открыть конструктор</span>
                    <i class="b-icon icon-sliders"></i>
                </button>
            </div>
        </div>
    </div>
</main>
<aside class="b-aside js-aside">
    <div class="b-top-aside">
        <div class="b-top-aside__inner">

            <? $APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "cart_link",
                array(
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
                    <a class="b-top-aside__link js-login js-authorization-open" href="javascript:void(0);">
                        <span class="b-top-aside__icon">
                            <i class="b-icon icon-log-in"></i>
                        </span>
                        <span class="b-top-aside__text">Войти</span>
                    </a>
                <?else:?>
                    <a class="b-top-aside__link authorized js-open-popup" data-popup="logout" href="javascript:void(0);">
                        <span class="b-top-aside__icon">
                            <i class="b-icon icon-log-in"></i>
                        </span>
                        <span class="b-top-aside__text"><?=$USER->GetLogin();?></span>
                    </a>
                <?endif;?>
            </div>
            <div class="b-top-aside__item b-top-aside__item--close">
                <a class="b-top-aside__link js-close" href="javascript:void(0);">
                    <span class="b-top-aside__text">Закрыть</span>
                    <span class="b-top-aside__icon">
                        <i class="b-icon icon-close"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="b-constructor-count">
        <div class="b-constructor-count__count">
            <div class="b-constructor-count__count-text">Количество дверей:</div>
            <div class="b-input b-input--number b-input--big js-input-count">
                <input class="b-input__input-field b-input__input-field--number b-input__input-field--big js-input-count" name="count-doors" type="number" data-watch="door" value="1"/>
                <button class="b-button b-button--minus js-minus"></button>
                <button class="b-button b-button--plus js-plus"></button>
            </div>
        </div>
        <? //if ( !empty($GLOBALS['BOX']) )
        $style = 'display:none;' ?>
        <div class="b-constructor-count__count" >
            <div class="b-constructor-count__count-text">Количество коробок:</div>
            <div class="b-input b-input--number b-input--big js-input-count">
                <input class="b-input__input-field b-input__input-field--number b-input__input-field--big js-input-count" name="count-mouldings" type="number" data-watched="door" disabled="disabled" value="1"/>
            </div>
        </div>
        <? if ( count($GLOBALS['BOX']) < 2 ) $style_box = 'display:none;' ?>
        <div class="b-constructor-count__count b-constructor-count__count--checkbox" style="<?//=$style_box?>">
            <div class="b-constructor-count__count-text">Без порога: </div>
            <div class="b-checkbox b-checkbox--order b-checkbox--constructor-count">
                <input class="b-checkbox__input js-input-checkbox" type="checkbox" name="box-with-treshold" id="box-with-treshold" value="Y" />
                <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--constructor-count" for="box-with-treshold"></label>
            </div>

        </div>
        <div class="b-constructor-count__name"><?=$GLOBALS['SKU_RESULT']['nameSku']?> + Набор: <?=$GLOBALS['SKU_RESULT']['nameKit']?></div>
        <div class="b-constructor-count__price">
            <div class="b-constructor-count__price-text">Цена полотна</div>
            <div class="b-constructor-count__sum"><?=$GLOBALS['SKU_RESULT']['price'];?> ₽</div>
        </div>
    </div>

    <?= $arResult['filter_sku']; ?>

</aside>