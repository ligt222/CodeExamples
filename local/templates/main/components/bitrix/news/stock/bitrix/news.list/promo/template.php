<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
<div class="b-stock">

    <? $i = 0;
    foreach($arResult["ITEMS"] as $arItem):?>
        <a class="b-stock-card b-stock-card--<?if($i % 6 == 0):?>big<?else:?>third<?endif;?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
                    class="b-stock-card__image js-image-wrapper"
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                    loading="lazy"
                    role="presentation"/>
            <div class="b-stock-card__text-wrap b-stock-card__text-wrap--big">
                <p class="b-stock-card__title">
                    <?=$arItem['NAME']; ?>
                </p>
                <p class="b-stock-card__text"><?=$arItem['PREVIEW_TEXT']?></p>
            </div>
        </a>

    <? $i++;
    endforeach;?>
</div>
