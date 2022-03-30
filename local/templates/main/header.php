<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Page\Asset;

//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
//Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/mobile.css");
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery/jquery.min.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/external.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/internal.js');
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/filter.js');

global $APPLICATION;
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui, user-scalable=no">
    <meta name="skype_toolbar" content="skype_toolbar_parser_compatible">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="google" value="notranslate">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/main.css" rel="stylesheet">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/mobile.css" rel="stylesheet">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/tablet.css" rel="stylesheet" media="(min-width: 768px)">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/desktop-min.css" rel="stylesheet" media="(min-width: 1024px)">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/desktop.css" rel="stylesheet" media="(min-width: 1366px)">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/desktop-big.css" rel="stylesheet" media="(min-width:1600px)">
    <link href="<?=SITE_TEMPLATE_PATH?>/css/desktop-fullhd.css" rel="stylesheet" media="(min-width:1920px)">
    <title><? $APPLICATION->ShowTitle(); ?></title>
    <meta name="description" content="">
    <meta name="keywords" content=""><!--[if lte IE 9]>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/html5shiv/html5shiv.min.js"></script><![endif]-->
    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<?$APPLICATION->ShowPanel();?>

<div class="b-page-wrapper <?$APPLICATION->ShowProperty('catalog:sect');?> <?if($APPLICATION->GetCurPage() == '/') { ?> mainpage<? } ?> js-page-wrapper">
    <header class="b-header js-header">
        <?if($APPLICATION->GetCurPage() !== '/' && $APPLICATION->GetCurPage() !== '/cart/'):?>
        <div class="b-header__top <?if($APPLICATION->ShowProperty('catalog:sect') == 'N'):?> <?else:?>b-header__top--fixed<?endif;?>">
            <div class="b-container">
                <div class="b-header__mobile-inner"><a class="b-logo b-logo--mobile" href="/">
                        <svg width="85" height="40" viewBox="15 0 85 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M32.8947 40.2205H32.4369V4.33653L15.2398 0.620516V36.1872H14.7891V0L32.8947 3.91346V40.2205Z"
                                  fill="#ED1C24"/>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M17.5705 36.7707V28.5674L15.8311 28.1872V36.3774L17.5705 36.7707ZM15.8311 27.5738L17.5705 27.9547V12.8746L15.8311 12.5152V27.5738ZM15.8311 12.0526L17.5705 12.4123V2.04259L15.8311 1.68506V12.0526ZM18.0212 36.8726L18.2325 36.9203L18.4437 36.9767L27.7113 39.0903V30.7839L18.0212 28.6659V36.8726ZM28.1691 39.1948L31.8311 40.0299L31.8125 31.6804L28.1691 30.884V39.1948ZM31.8111 31.0735L31.8099 30.5389V30.0101L31.7813 15.8112L28.1691 15.0648V30.2759L31.8111 31.0735ZM31.7804 15.3512L31.7747 12.5793L31.7677 12.0575L31.7536 4.9639L28.8311 4.36455L28.4296 4.27993L28.1691 4.22621V14.6043L31.7804 15.3512ZM27.7113 4.13183L18.6832 2.27032L18.2325 2.17865L18.0212 2.13523V12.5055L27.7113 14.5096V4.13183ZM18.0212 12.9677L27.7113 14.9702V30.1757L18.0212 28.0535V12.9677Z"
                                  fill="#ED1C24"/>
                            <path d="M30.8023 22.2749H29.9502V25.2505H30.8023V22.2749Z" fill="white"/>
                            <path opacity="0.1"
                                  d="M18.4399 54.9998L32.3944 40.2313L14.9513 36.6665L0 49.9073L18.4399 54.9998Z"
                                  fill="url(#paint0_linear_464:6852)"/>
                            <path d="M67.6902 16.5567H54.8311V8.29263H56.0634V15.4356H60.648V8.29263H61.8804V15.4356H66.4578V8.29263H67.6902V16.5567ZM77.0916 16.5567H69.2043V8.29263H77.0634V9.42788H70.4085V11.8253H76.8311V12.9535H70.4085V15.4567H77.0634L77.0916 16.5567ZM88.6339 16.5567H87.4015V9.37147L80.3592 16.5567H78.493V8.28557H79.7325V15.5272L86.7747 8.28557H88.5705L88.6339 16.5567ZM85.3522 8.18686H81.662V7.07275H85.3522V8.18686ZM99.9578 16.5567H98.7184V9.42788H92.7747V10.9792C92.7747 14.7022 92.2888 16.5708 91.324 16.5708H90.1268V15.4497H90.6127C91.2275 15.4497 91.5353 14.2369 91.5353 11.8112V8.28557H99.986L99.9578 16.5567Z"
                                  fill="#231F20"/>
                            <path d="M64.3874 30.6871H63.155V29.1711H55.486V30.6871H54.1973V28.0499H54.9015C55.1086 27.3394 55.257 26.613 55.3452 25.8781C55.4489 25.1468 55.5054 24.4096 55.5142 23.6711V20.9211H63.824V28.0499H64.3874V30.6871ZM62.5705 28.0499V22.0422H56.7254V23.6711C56.7399 25.1466 56.5671 26.618 56.2114 28.0499H62.5705ZM75.5212 22.4089C75.7747 24.1602 75.7747 25.939 75.5212 27.6903C75.2888 28.4589 74.5916 28.9525 73.4085 29.164C72.474 29.2751 71.5325 29.3175 70.5916 29.2909C69.6626 29.3146 68.733 29.2722 67.8099 29.164C66.6268 28.9454 65.9226 28.4589 65.6973 27.6973C65.5303 26.8288 65.4665 25.9437 65.5071 25.0602C65.4678 24.1744 65.5316 23.287 65.6973 22.4159C65.9297 21.6403 66.6339 21.1467 67.8099 20.9352C69.6674 20.7612 71.5367 20.7612 73.3944 20.9352C74.5705 21.1537 75.2677 21.6403 75.5071 22.4159L75.5212 22.4089ZM74.4649 25.0672C74.4649 23.5441 74.3029 22.6486 73.979 22.3807C73.6268 22.0775 72.5071 21.9294 70.6128 21.9294C69.7975 21.9076 68.9817 21.9311 68.1691 21.9999C67.9307 22.0119 67.6999 22.0875 67.5005 22.219C67.3011 22.3504 67.1405 22.5328 67.0353 22.7473C66.7988 23.4965 66.7033 24.2831 66.7536 25.0672C66.7058 25.8402 66.8037 26.6152 67.0423 27.3518C67.1535 27.5652 67.3173 27.7466 67.5183 27.8786C67.7192 28.0107 67.9505 28.0891 68.1902 28.1063C68.9959 28.1746 69.8046 28.1981 70.6128 28.1768C71.9578 28.1768 72.7677 28.1768 73.0353 28.1204C73.274 28.102 73.5036 28.0231 73.7036 27.8911C73.9029 27.7591 74.0656 27.5784 74.1761 27.3659C74.4163 26.6248 74.5142 25.8448 74.4649 25.0672ZM83.7606 20.9211C85.324 20.9211 86.1057 21.8025 86.1057 23.5653C86.1451 24.2452 85.9374 24.9164 85.5212 25.455C85.2916 25.701 85.0099 25.8922 84.6966 26.0143C84.3832 26.1363 84.0466 26.1862 83.7113 26.1602H78.2677V29.1711H77.0635V20.9069L83.7606 20.9211ZM83.7113 25.0531C84.486 25.0531 84.8733 24.5525 84.8733 23.5582C84.8733 22.564 84.479 22.0422 83.6973 22.0422H78.2677V25.0531H83.7113ZM96.6761 26.3082C96.7444 27.0951 96.5353 27.881 96.0846 28.5294C95.6515 28.963 95.0698 29.2151 94.4578 29.2345C94.1621 29.2345 93.3592 29.2839 92.0423 29.2839C91.074 29.3217 90.105 29.2436 89.155 29.0512C88.8444 28.9813 88.555 28.8389 88.3106 28.6354C88.0656 28.4319 87.8726 28.1733 87.7466 27.8807C87.4423 26.9731 87.3135 26.016 87.3663 25.0602C87.3184 24.1046 87.4473 23.1483 87.7466 22.2396C87.874 21.9483 88.0677 21.6908 88.3128 21.4876C88.5571 21.2843 88.8451 21.1411 89.155 21.0691C90.105 20.8775 91.074 20.7994 92.0423 20.8364C93.3733 20.8364 94.155 20.8364 94.4578 20.8858C95.0691 20.908 95.6501 21.1597 96.0846 21.5909C96.536 22.2415 96.7451 23.0299 96.6761 23.8191H95.4437C95.4437 22.9166 95.2536 22.3736 94.8733 22.1903C93.9529 21.9634 93.0022 21.8824 92.0564 21.9505C91.2987 21.9246 90.5402 21.9623 89.7888 22.0634C89.5698 22.0992 89.3649 22.1934 89.1951 22.3361C89.0254 22.4787 88.8973 22.6647 88.824 22.8743C88.6522 23.599 88.5832 24.3444 88.6198 25.0884C88.5818 25.8235 88.6529 26.5601 88.8311 27.2743C88.9064 27.4849 89.0374 27.6713 89.2099 27.814C89.3818 27.9566 89.5895 28.0503 89.8099 28.0852C90.5543 28.1865 91.3057 28.2243 92.0564 28.198C93.0015 28.2639 93.9508 28.1878 94.8733 27.9723C95.2606 27.7819 95.4578 27.2319 95.4578 26.3294L96.6761 26.3082Z"
                                  fill="#231F20"/>
                            <defs>
                                <linearGradient id="paint0_linear_464:6852" x1="15.493" y1="56.4101" x2="23.8014"
                                                y2="46.3593" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white"/>
                                    <stop offset="0.1526" stop-color="white"/>
                                    <stop offset="0.8478" stop-color="#9D9D9C"/>
                                    <stop offset="1" stop-color="#9D9D9C"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <ul class="b-header__buttons-panel">
                        <li class="b-header__bp-item b-header__bp-item--cart"><a class="b-link-cart"
                                                                                 href="/cart.html"><span
                                        class="b-link-cart__icon"><i class="b-icon icon-basket"></i><span
                                            class="b-link-cart__counter"><span>3</span></span></span><span
                                        class="b-link-cart__text">Корзина</span></a>
                        </li>
                        <? if (!$USER->IsAuthorized()): ?>
                        <li class="b-header__bp-item b-header__bp-item--login"><a
                                    class="b-link b-link--block js-authorization-open" href="javascript:void(0);"
                                    title="undefined"><i class="b-icon icon-log-in"></i>
                                <div class="b-header__link-name">Войти</div>
                            </a>
                        </li>
                        <?else:?>
                            <li class="b-header__bp-item b-header__bp-item--login"><a
                                        class="b-link b-link--block" href="#"
                                        title="undefined"><i class="b-icon icon-log-in"></i>
                                    <div class="b-header__link-name"><?=$USER->GetLogin(); ?></div>
                                </a>
                            </li>
                        <?endif;?>
                        <li class="b-header__bp-item b-header__bp-item--burger"><a class="b-burger js-burger"
                                                                                   href="javascript:void(0);"><span
                                        class="b-burger__link"><span class="b-burger__line"></span></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?endif;?>
        <div class="b-header__left js-menu">
            <div class="b-header__inner">
                <div class="b-header__logo"><a class="b-logo" href="/">
                        <svg width="204" height="133" viewBox="0 0 204 133" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_464:5654)">
                                <path d="M62.3951 105.433H61.541V37.7125L28.9495 30.7129V97.8342H28.082V29.5286L62.3951 36.914V105.433Z"
                                      fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M54.7071 103.782L60.3926 105.073L60.3392 87.1619V86.1771L60.2819 57.9453L54.7071 56.8052V86.8426L60.3392 88.1067V89.2511L54.7071 87.9896V103.782ZM53.8396 103.585V87.7953L35.4752 83.6818V99.4144L53.8396 103.585ZM34.6077 99.2048V83.4874L30.0566 82.468V98.1802L34.6077 99.2048ZM30.0566 81.3104L34.6077 82.3318V52.6942L30.0566 51.7635V81.3104ZM30.0566 50.8931L34.6077 51.8243V33.6538L30.0566 32.709V50.8931ZM35.4752 33.8268V52.0018L53.8396 55.7595V37.5842L35.4752 33.8268ZM54.7071 37.7657L60.2458 38.8968L60.2724 52.2838V53.2685L60.2802 57.0773L54.7071 55.9369V37.7657ZM35.4752 52.8717L53.8396 56.6277V86.6479L35.4752 82.5264V52.8717Z"
                                      fill="white"/>
                                <path d="M58.444 71.5659H56.8291V77.1815H58.444V71.5659Z" fill="#E62C25"/>
                                <path opacity="0.1"
                                      d="M35.1213 133.072L61.5673 105.2L28.5099 98.4729L0.174805 123.461L35.1213 133.072Z"
                                      fill="url(#paint0_linear_464:5654)"/>
                                <path d="M109.849 65.5209H85.4785V49.9249H87.7607V63.4051H96.4358V49.9249H98.7713V63.4051H107.446V49.9249H109.795L109.849 65.5209ZM127.666 65.5209H112.705V49.9249H127.666V52.0674H115.054V56.5918H127.225V58.721H115.054V63.445H127.666V65.5209ZM149.54 65.5209H147.205V51.9609L133.925 65.5209H130.389V49.9116H132.724V63.5781L146.137 49.9116H149.54V65.5209ZM143.321 49.7253H136.328V47.6228H143.321V49.7253ZM170.988 65.5209H168.652V52.0674H157.375V54.995C157.375 62.0345 156.467 65.5476 154.625 65.5476H152.356V63.4317H153.277C154.452 63.4317 155.039 61.1429 155.039 56.5652V49.9116H171.054L170.988 65.5209Z"
                                      fill="white"/>
                                <path d="M103.563 92.1885H101.227V89.3274H86.7197V92.1885H84.2773V87.2116H85.612C86.003 85.8704 86.2846 84.4996 86.4528 83.113C86.649 81.7329 86.7557 80.3416 86.7731 78.9479V73.7581H102.442V87.2116H103.536L103.563 92.1885ZM100.133 87.2116V75.8739H89.0953V78.9479C89.1167 81.7321 88.7884 84.508 88.121 87.2116H100.133ZM124.676 76.5659C125.157 79.871 125.157 83.2278 124.676 86.5329C124.236 87.9834 122.901 88.9149 120.672 89.3141C118.923 89.5213 117.161 89.6014 115.401 89.5537C113.618 89.6024 111.833 89.5224 110.062 89.3141C107.82 88.9016 106.472 87.9834 106.058 86.5462C105.755 84.9055 105.639 83.2361 105.711 81.5694C105.642 79.8983 105.758 78.2246 106.058 76.5792C106.495 75.1154 107.829 74.1839 110.062 73.7847C111.833 73.5642 113.618 73.4797 115.401 73.5318C117.161 73.4858 118.923 73.5659 120.672 73.7714C122.905 74.1794 124.24 75.111 124.676 76.5659ZM122.701 81.5694C122.701 78.695 122.394 77.005 121.78 76.4993C121.113 75.9271 118.977 75.6477 115.387 75.6477C113.842 75.6068 112.296 75.6513 110.756 75.7808C110.305 75.8062 109.869 75.9499 109.491 76.1977C109.115 76.4453 108.809 76.7882 108.607 77.1913C108.171 78.6076 107.995 80.0907 108.087 81.5694C107.99 83.0282 108.175 84.4921 108.634 85.8809C108.844 86.2817 109.152 86.6228 109.53 86.8719C109.909 87.121 110.344 87.27 110.796 87.3047C112.323 87.4332 113.855 87.4776 115.387 87.4378C117.95 87.4378 119.471 87.4378 119.978 87.3314C120.432 87.2988 120.871 87.1509 121.252 86.9017C121.633 86.6524 121.943 86.3102 122.154 85.9075C122.609 84.5086 122.794 83.0369 122.701 81.5694ZM140.318 73.7448C143.264 73.7448 144.74 75.4082 144.749 78.7349C144.828 80.0164 144.439 81.283 143.655 82.3013C143.217 82.7658 142.68 83.1266 142.085 83.3569C141.489 83.5871 140.848 83.6812 140.211 83.632H129.895V89.3274H127.559V73.7315L140.318 73.7448ZM140.211 81.5428C141.679 81.5428 142.413 80.5979 142.413 78.7216C142.413 76.8453 141.679 75.8606 140.198 75.8606H129.895V81.5428H140.211ZM164.782 83.9114C164.908 85.3942 164.517 86.8751 163.674 88.1032C162.853 88.9213 161.751 89.3972 160.591 89.4339C160.03 89.5004 158.509 89.527 156.013 89.527C154.174 89.5988 152.332 89.4515 150.528 89.0879C149.941 88.954 149.393 88.6844 148.929 88.3007C148.466 87.917 148.099 87.43 147.859 86.8789C147.282 85.1662 147.038 83.3598 147.138 81.5561C147.039 79.7304 147.283 77.9024 147.859 76.1667C148.103 75.6179 148.47 75.133 148.933 74.7497C149.396 74.3665 149.942 74.0954 150.528 73.9577C152.332 73.5956 154.174 73.4481 156.013 73.5185C158.536 73.5185 160.017 73.5185 160.591 73.6117C161.749 73.6536 162.85 74.1287 163.674 74.9424C164.519 76.1746 164.91 77.6603 164.782 79.1475H162.499C162.499 77.4441 162.139 76.4195 161.418 76.0735C159.674 75.6445 157.872 75.4919 156.08 75.6211C154.644 75.5716 153.206 75.6428 151.782 75.834C151.366 75.902 150.976 76.0798 150.652 76.3488C150.329 76.6179 150.082 76.9686 149.941 77.3643C149.622 78.7329 149.495 80.1394 149.567 81.5428C149.495 82.93 149.63 84.3202 149.967 85.668C150.11 86.0655 150.358 86.4172 150.684 86.6865C151.011 86.9557 151.403 87.1324 151.822 87.1983C153.233 87.39 154.657 87.4612 156.08 87.4112C157.871 87.5356 159.67 87.392 161.418 86.9854C162.152 86.6261 162.513 85.5881 162.513 83.8848L164.782 83.9114Z"
                                      fill="white"/>
                            </g>
                            <defs>
                                <linearGradient id="paint0_linear_464:5654" x1="29.5365" y1="131.741" x2="45.1359"
                                                y2="116.698" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0"/>
                                    <stop offset="0.1526" stop-color="white" stop-opacity="0.17"/>
                                    <stop offset="0.8478" stop-color="white"/>
                                    <stop offset="1" stop-color="white"/>
                                </linearGradient>
                                <clipPath id="clip0_464:5654">
                                    <rect width="204" height="133" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
                <form class="b-header__search">
                    <div class="b-input b-input--search js-search"><input class="b-input__input-field" id="search"
                                                                          type="text" placeholder="Поиск"
                                                                          name="search"/>
                        <label class="b-input__label" for="search">
                        </label>
                    </div>
                </form>
                <?$APPLICATION->IncludeComponent("bitrix:menu","header",Array(
                        "ROOT_MENU_TYPE" => "left",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "top",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => ""
                    )
                );?>
                <div class="b-header__copyright"><span>&copy;&nbsp;Шейл Дорс.<?=date('Y')?>.</span>
                </div>
            </div>
        </div>
        <div class="b-authorization js-authorization">
            <div class="b-authorization__wrap">
                <button class="b-authorization__close js-close">Закрыть<i
                            class="b-icon b-icon--authorization icon-arrow-right"></i>
                </button>
                <div class="b-authorization__title">Войти
                </div>
                <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","auth_form",Array(
                        "REGISTER_URL" => "register.php",
                        "FORGOT_PASSWORD_URL" => "",
                        "PROFILE_URL" => "profile.php",
                        "SHOW_ERRORS" => "Y"
                    )
                );?>
            </div>
        </div>
    </header>