<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult["ITEMS"]): ?>
<h2 class="b-title b-title--h2 b-title--promo">Другие новости</h2>
<div class="b-promotions-slider js-promo-slider">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <a class="b-stock-card b-stock-card--promotions b-stock-card--promo b-stock-card--promo-slide" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <img class="b-stock-card__image js-image-wrapper" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" loading="lazy" alt="" role="presentation"/>
            <div class="b-stock-card__text-wrap b-stock-card__text-wrap--promotions b-stock-card__text-wrap--promo b-stock-card__text-wrap--promo-slide">
                <p class="b-stock-card__title"><?=$arItem['NAME']?></p>
                <p class="b-stock-card__text"><?=$arItem['PREVIEW_TEXT']?></p>
            </div>
        </a>
    <? endforeach; ?>
</div>
<?endif;?>
