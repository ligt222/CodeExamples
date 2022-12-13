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
?>


<main class="b-main" role="main">
    <div class="b-container b-container--fluid">
        <section class="b-about b-about--where-to-buy">
            <div class="b-about__content">
                <style>
                    .b-about__info {
                        width: 100%;
                    }

                    .b-title--contacts {
                        font-size: 24px;
                        line-height: 24px;
                        margin-bottom: 20px;
                    }

                    .b-about__contacts-item {
                        display: block;
                        margin-bottom: 39px;
                    }

                    .b-about__contacts-item > div {
                        display: flex;
                        align-items: center;
                        margin-bottom: 10px;
                    }

                    .b-about__contacts-item:last-child.
                    .b-about__contacts-item > div:last-child {
                        margin-bottom: 0;
                    }
                    .b-about__contacts-link {
                        display: block;
                    }
                    .b-about__contacts-link--title {
                        font-family: 'MicraDi';
                        line-height: 14px;
                        text-transform: uppercase;
                        margin-bottom: 22px;
                    }
                </style>
                <div class="b-about__info">
                    <div class="b-about__contacts">
                        <ul class="b-about__contacts-list">
                            <? foreach ($arResult['ITEMS'] as $item): ?>
                                <li class="b-about__contacts-item">
                                    <a class="b-about__contacts-link b-about__contacts-link--title"><?=$item['NAME']?></a>
                                   <div>
                                        <div class="b-about__icon">
                                            <i class="b-icon icon-map-marker"></i>
                                        </div>
                                        <a class="b-about__contacts-link"> <?=$item['PROPERTIES']['ADDRESS']['VALUE']?></a>
                                   </div>

                                    <div>
                                        <div class="b-about__icon">
                                            <i class="b-icon icon-phone-call"></i>
                                        </div>
                                        <div>
                                            <a class="b-about__contacts-link"
                                            href="tel:<?=$item['PROPERTIES']['PHONE']['VALUE']?>"
                                            title="#"><?=$item['PROPERTIES']['PHONE']['VALUE']?></a>
                                        </div>
                                    </div>
                                </li>
                            <? endforeach; ?>

                        </ul>
                    </div>


                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "city",
                        array(
                            "COMPONENT_TEMPLATE" => "cooperation",
                            "IBLOCK_TYPE" => "seo",
                            "IBLOCK_ID" => "11",
                            "ELEMENT_ID" => "",
                            "ELEMENT_CODE" => "cooperation",
                            "CHECK_DATES" => "Y",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "NAME_LIST_CITIES",
                                1 => "TITLE_SUBTITLE",
                                2 => "NAME_LIST_1",
                                3 => "NAME_LIST_2",
                                4 => "DESC_1",
                                5 => "LIST",
                                6 => "LIST_CITIES_RUS",
                                7 => "FOOTER_TEXT",
                            ),
                            "IBLOCK_URL" => "",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_GROUPS" => "Y",
                            "SET_TITLE" => "Y",
                            "SET_CANONICAL_URL" => "N",
                            "SET_BROWSER_TITLE" => "Y",
                            "BROWSER_TITLE" => "-",
                            "SET_META_KEYWORDS" => "Y",
                            "META_KEYWORDS" => "-",
                            "SET_META_DESCRIPTION" => "Y",
                            "META_DESCRIPTION" => "-",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "USE_PERMISSIONS" => "N",
                            "STRICT_SECTION_CHECK" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Страница",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    );?>

                </div>
            </div>
        </section>
    </div>
</main>