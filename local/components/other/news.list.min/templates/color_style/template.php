<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult['ITEMS']): ?>
<div class="b-constructor-slider__background-wrap">
    <?
    $isFirst = true;
    foreach ($arResult['ITEMS'] as $item): ?>

        <input class="b-constructor-slider__color-radio b-constructor-slider__color-radio--<?=$item['CODE'];?> js-color-radio-input"
               type="radio" name="background-colors" value="color-<?=$item['PROPERTY_COLOR_ONE_VALUE']?>"
               id="color-<?=$item['CODE'];?>"
               <? if($isFirst): ?>checked="checked"<? endif; ?>/>

        <img class="b-constructor-slider__background b-constructor-slider__background--<?=$item['CODE'];?> js-image-wrapper"
             src="<?=$item['PREVIEW_PICTURE']?>" alt="" loading="lazy" role="presentation"/>

    <? $isFirst = false; ?>
    <? endforeach; ?>
</div>
<? endif; ?>