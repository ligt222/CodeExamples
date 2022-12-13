<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<? if ($arResult["ITEMS"]): ?>
<div class="b-stock">
    <? foreach($arResult["ITEMS"] as $key => $arItem): ?>
        <a class="b-stock-card b-stock-card--<?if($key % 6 == 0):?>big<?else:?>third<?endif;?>" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
            <img class="b-stock-card__image js-image-wrapper" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" loading="lazy" alt="" role="presentation"/>
            <div class="b-stock-card__text-wrap b-stock-card__text-wrap--big">
                <p class="b-stock-card__title"><?=$arItem['NAME']; ?></p>
                <p class="b-stock-card__text"><?=$arItem['PREVIEW_TEXT']?></p>
            </div>
        </a>
    <? endforeach; ?>
</div>
<? endif; ?>