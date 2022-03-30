<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<main class="b-main" role="main">
    <div class="b-cart js-cart">
        <div class="b-container">
            <div class="b-top">
                <nav class="b-breadcrumbs">
                    <ul class="b-breadcrumbs__list">

                        <li class="b-breadcrumbs__item"><a class="b-breadcrumbs__link" href="/main.html"
                                                           title="Главная">Главная</a>
                        </li>
                        <li class="b-breadcrumbs__item"><span class="b-breadcrumbs__link">Корзина</span>
                        </li>
                    </ul>
                </nav>
                <a class="b-print" href="javascript:(print());" title="Распечатать заказ"><i
                            class="b-icon icon-printer"></i>
                    <p>Распечатать заказ</p></a>
            </div>
            <div class="b-cart__wrapper">
                <?foreach ($arResult['GRID']['ROWS'] as $item): ?>
                <div class="b-card js-card">
                    <div class="b-card__img-wrap">
                        <div class="b-card__img-inner">
                            <img class="b-card__image" loading="lazy"
                                 src="<?=$item['PREVIEW_PICTURE_SRC'];?>" alt=""
                                 role="presentation"/>
                        </div>
                    </div>
                    <div class="b-card__content">
                        <div class="b-card__top">
                            <div class="b-card__content-wrap">
                                <div class="b-card__name">Дверь
                                </div>
                                <div class="b-card__description">
                                    <?=$item['NAME'];?>
                                </div>
                            </div>
                        </div>
                        <div class="b-card__bottom">
                            <div class="b-card__left-inner">
                                <div class="b-card__amount">Общая стоимость
                                </div>
                                <div class="b-card__cost"><!--12&nbsp;100&nbsp;₽-->
                                    <?=$item['SUM_FULL_PRICE_FORMATED'];?> (<?=$item['QUANTITY']?> шт.)
                                </div>
                            </div>
                            <div class="b-card__right-inner">
                                <a class="b-card__edit js-edit js-aside-open"
                                   data-sku-id="<?=$item['PRODUCT_ID'];?>"
                                   data-prod-id="<?=$item['CML2_LINK'];?>"
                                   data-size-min="<?=$item['SIZE']['MIN']?>"
                                   data-size-max="<?=$item['SIZE']['MAX']?>"
                                   data-change-load="Y"
                                   href="javascript:void(0);" title="Редактировать">
                                    <i class="b-icon icon-edit"></i>
                                    <span>Редактировать</span>
                                </a>
                                <a class="b-card__delete" data-delet-id="<?=$item['ID']?>" href="javascript:void(0);" title="Удалить">
                                    <i class="b-icon icon-delete"></i>
                                    <span>Удалить</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?endforeach;?>
                <button class="b-button b-button--with-icon b-button--cart js-aside-open"><span>Офрмить заказ</span><i
                            class="b-icon icon-basket"></i>
                </button>
            </div>
        </div>
    </div>
</main>
<aside class="b-aside js-aside">
    <div class="b-top-aside b-top-aside--cart">
        <div class="b-top-aside__inner">
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
    <div class="b-order-card">
        <div class="b-order-card__title">Ваш заказ
        </div>
        <ol class="b-order-card__main-list">
            <?foreach ($arResult['GRID']['ROWS'] as $item): ?>
                <li class="b-order-card__item">
                    <div class="b-order-card__wrap">
                        <div class="b-order-card__text">
                            Дверь
                        </div>
                        <div class="b-order-card__count"><?=$item['SUM_FULL_PRICE_FORMATED'];?>
                        </div>
                    </div>
                    <ul class="b-order-card__inner-list">
                        <?for ($i = 1; $i <= $item['QUANTITY']; $i++):?>
                        <li class="b-order-card__inner-item">
                            <div class="b-order-card__inner">
                                <div class="b-order-card__inner-text"><?=$item['NAME']?>
                                </div>
                                <div class="b-order-card__inner-count">+<?=$item['FULL_PRICE_FORMATED'];?>
                                </div>
                            </div>
                        </li>
                        <?endfor;?>

                    </ul>
                </li>
            <?endforeach;?>
        </ol>
        <div class="b-order-card__sum-wrap">
            <div class="b-order-card__sum-text">Итоговая стоимость
            </div>
            <div class="b-order-card__sum"><?=$arResult['allSum_FORMATED']?>
            </div>
        </div>
    </div>
    <div class="b-order-count">
        <div class="b-order-count__item">
            <div class="b-order-count__text">Количество дверей:
            </div>
            <div class="b-input b-input--number js-input-count"><input
                        class="b-input__input-field b-input__input-field--number js-input-count" type="number"
                        value="1"/>
                <button class="b-button b-button--minus js-minus">
                </button>
                <button class="b-button b-button--plus js-plus">
                </button>
            </div>
        </div>
        <div class="b-order-count__item">
            <div class="b-order-count__text">Количество погонажа:
            </div>
            <div class="b-input b-input--number js-input-count"><input
                        class="b-input__input-field b-input__input-field--number js-input-count" type="number"
                        value="1"/>
                <button class="b-button b-button--minus js-minus">
                </button>
                <button class="b-button b-button--plus js-plus">
                </button>
            </div>
        </div>
    </div>
    <?
    $APPLICATION->IncludeComponent(
	"tega:order.simple", 
	"order",
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ANONYMOUS_USER_ID" => "2",
		"BASKET_PAGE" => "",
		"EMAIL_PROPERTY" => "0",
		"ENABLE_VALIDATION_INPUT_ID" => "simple_order_form_validation",
		"ENABLE_VALIDATION_INPUT_NAME" => "validation",
		"EVENT_TYPES" => array(
		),
		"FIO_PROPERTY" => "1",
		"FORM_ID" => "simple_order_form",
		"FORM_NAME" => "simple_order_form",
		"PATH_TO_PAYMENT" => "/cart/payment/",
		"ORDER_PROPS" => array(
			0 => "1",
			1 => "2",
			2 => "3",
		),
		"ORDER_RESULT_PAGE" => "",
		"PERSON_TYPE_ID" => "1",
		"PHONE_PROPERTY" => "3",
		"REQUIRED_ORDER_PROPS" => array(
			0 => "1",
			1 => "2",
			2 => "3",
		),
		"SET_DEFAULT_PROPERTIES_VALUES" => "Y",
		"SITE_ID" => "s1",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_DATE_CALCULATION" => "N",
		"COMPONENT_TEMPLATE" => "order"
	),
	false
);
    ?>
    <?
    $GLOBALS['arrFilter'] = array('ID' => 558);
    if($_GET['ajax'] == 'Y'){
        $GLOBALS['arrFilter'] = array('ID' => $_GET['id']);
    }
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.smart.filter",
        "cart",
        array(
            "COMPONENT_TEMPLATE" => "constructor",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "3",
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
            "PRICE_CODE" => array(
            ),
            "CONVERT_CURRENCY" => "Y",
            "XML_EXPORT" => "N",
            "SECTION_TITLE" => "-",
            "SECTION_DESCRIPTION" => "-",
            "POPUP_POSITION" => "left",
            "SEF_RULE" => "/examples/books/#SECTION_ID#/filter/#SMART_FILTER_PATH#/apply/",
            "SECTION_CODE_PATH" => "",
            "SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
            "CURRENCY_ID" => "RUB",
            "PREFILTER_NAME" => "arrFilter"
        ),
        false
    );?>
    <?if ($_REQUEST['change-load'] == 'Y'){
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo json_encode(['change_load' => $GLOBALS['RESULT_FILTER']], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        die;
    }?>
    <?if ($_REQUEST['ajax_sku'] == 'Y'){
        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo json_encode(['result' => $GLOBALS['SKU_RESULT']], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        die;
    }?>
</aside>
