<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<a class="b-stock-card b-stock-card--promotions" href="javascript:void(0);">
    <? if ($arResult["DETAIL_PICTURE"]["SRC"]): ?>
        <img class="b-stock-card__image js-image-wrapper" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" loading="lazy" alt="" role="presentation"/>
    <? endif; ?>
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
            <h2 class="b-title b-title--h2 b-title--promotions"><?=$arResult['PROPERTIES']['TERMS']['NAME']?></h2>
            <div class="b-promotions__conditions-text">
                <?=htmlspecialcharsBack($arResult['PROPERTIES']['TERMS']['VALUE']['TEXT'])?>
            </div>
        </div>
    <? endif; ?>
</div>
