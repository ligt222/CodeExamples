<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult['ITEMS']): ?>
    <div class="b-constructor-slider__color-changer">
        <div class="b-constructor-slider__info">Выбор цвета интерьера:</div>
        <div class="b-constructor-slider__color-btn-wrap">
            <?
            $isFirst = true;
            foreach ($arResult['ITEMS'] as $item):
                $isActive = (($isFirst) ? ' active' : '');
                $colorOne = $item['PROPERTY_COLOR_ONE_VALUE'];
                $colorTwo = $item['PROPERTY_COLOR_TWO_VALUE'];
            ?>

                <label class="b-constructor-slider__color-btn<?=$isActive?>" style="background : linear-gradient(135deg,transparent 50%, <?=$colorOne?> 50%, <?=$colorOne?> 100%) <?=$colorTwo?>" for="color-<?=$item['CODE'];?>"></label>

            <? $isFirst = false; ?>
            <? endforeach; ?>
        </div>
    </div>
<? endif; ?>

