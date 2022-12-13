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
    <ul class="b-header-tabs">
        <?foreach($arResult['SECTIONS'] as $section):?>
            <li class="b-header-tabs__item <?if ($section['SORT'] == '1'):?>active<?endif;?>">
                <button class="b-header-tabs__btn js-tab-btn" type="button" data-tab="list_<?=$section['ID']?>"><?=$section['NAME']?>
                </button>
            </li>
        <?endforeach;?>
    </ul>
