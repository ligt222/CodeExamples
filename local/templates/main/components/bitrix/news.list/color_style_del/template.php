<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="b-constructor-slider__background-wrap">
    <? foreach ($arResult['ITEMS'] as $key => $item): ?>
    <input class="b-constructor-slider__color-radio b-constructor-slider__color-radio--<?=$item['CODE'];?> js-color-radio-input"
           type="radio" name="background-colors" value="color-<?=$item['PROPERTIES']['COLOR_ONE']['VALUE']?>"
           id="color-<?=$item['CODE'];?>"
           <? if($i == 0): ?>checked="checked"<? endif; ?>/>
    <img class="b-constructor-slider__background b-constructor-slider__background--<?=$item['CODE'];?> js-image-wrapper"
         src="<?=$item['PREVIEW_PICTURE']['SRC'];?>" alt="" loading="lazy" role="presentation"/>
    <? endforeach; ?>
</div>
