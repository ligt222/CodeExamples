<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

?>
<main class="b-main" role="main">
    <div class="b-container b-container--fluid">
        <section class="b-about">
            <div class="b-images b-images--about js-image-wrapper">
                <picture class="b-images__picture">
                    <source class="b-images__image" srcset="<?= SITE_TEMPLATE_PATH ?>/images/content/about-mobile.jpg"
                            media="(max-width: 1024px)" type="image/jpg"/>
                    <img class="b-images__image b-images__image--about js-image-wrapper"
                         src="<?= SITE_TEMPLATE_PATH ?>/images/content/about-desktop.jpg" loading="lazy" alt="" role="presentation"/>
                </picture>
            </div>
            <div class="b-about__content">
                <div class="b-about__interna">
                    <h1 class="b-title b-title--h1 b-title--red b-title--interna">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/name_company.php",
                                "COMPONENT_TEMPLATE" => ".default"
                            ),
                            false
                        ); ?>
                    </h1>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        ".default",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/desc_company.php",
                            "COMPONENT_TEMPLATE" => ".default"
                        ),
                        false
                    ); ?>
                </div>
                <div class="b-about__info">
                    <div class="b-about__contacts">
                        <h2 class="b-title b-title--h2 b-title--contacts">КОНТАКТЫ
                        </h2>
                        <ul class="b-about__contacts-list">
                            <li class="b-about__contacts-item">
                                <div class="b-about__icon"><i class="b-icon icon-map-marker"></i>
                                </div>
                                <a class="b-about__contacts-link" href="#" title="#">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        ".default",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/address.php",
                                            "COMPONENT_TEMPLATE" => ".default"
                                        ),
                                        false
                                    ); ?>
                                </a>
                            </li>
                            <li class="b-about__contacts-item">
                                <div class="b-about__icon"><i class="b-icon icon-phone-call"></i>
                                </div>
                                <div>
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        ".default",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/phones.php",
                                            "COMPONENT_TEMPLATE" => ".default"
                                        ),
                                        false
                                    ); ?>

                                </div>
                            </li>
                            <li class="b-about__contacts-item">
                                <div class="b-about__icon"><i class="b-icon icon-mail"></i>
                                </div>
                                <a class="b-about__contacts-link" href="#" title="#">
                                    <? $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        ".default",
                                        array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/mail.php",
                                            "COMPONENT_TEMPLATE" => ".default"
                                        ),
                                        false
                                    ); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="b-about__requisites">
                        <h2 class="b-title b-title--h2 b-title--contacts">РЕКВИЗИТЫ
                        </h2>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            ".default",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH . "/include/contacts/requisites.php",
                                "COMPONENT_TEMPLATE" => ".default"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>
<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>
