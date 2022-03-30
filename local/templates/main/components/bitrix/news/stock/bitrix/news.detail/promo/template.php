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
if ($arResult['DETAIL_PICTURE']){
    $img = $arResult["DETAIL_PICTURE"]["SRC"];
} else {
    $img = $arResult['PREVIEW_PICTURE']['SRC'];
}
?>

    <a class="b-stock-card b-stock-card--promotions" href="javascript:void(0);">
        <img class="b-stock-card__image js-image-wrapper"
             src="<?=$img?>" loading="lazy"
                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" role="presentation"/>
        <div class="b-stock-card__text-wrap b-stock-card__text-wrap--promotions">
            <p class="b-stock-card__title"><?=$arResult['NAME']?></p>
        </div>
    </a>
    <div class="b-promotions__content-wrap">
        <? if ($arResult['DETAIL_TEXT']): ?>
        <div class="b-promotions__description">
            <?=$arResult['DETAIL_TEXT']?>
        </div>
        <? endif; ?>
        <? if ($arResult['PROPERTIES']['TERMS']['VALUE']): ?>
        <div class="b-promotions__conditions">
            <h2 class="b-title b-title--h2 b-title--promotions">Условия акции
            </h2>
            <div class="b-promotions__conditions-text">
                <?=htmlspecialcharsBack($arResult['PROPERTIES']['TERMS']['VALUE']['TEXT'])?>
            </div>
        </div>
        <? endif; ?>
    </div>
