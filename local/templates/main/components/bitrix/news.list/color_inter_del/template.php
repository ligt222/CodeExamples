<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if ($arResult['ITEMS']): ?>
    <div class="b-constructor-slider__color-changer">
        <div class="b-constructor-slider__info">Выбор цвета интерьера:</div>
        <div class="b-constructor-slider__color-btn-wrap">
            <? foreach ($arResult['ITEMS'] as $key => $item):
                $isActive = (($key === 0) ? ' active' : '');
                ?>

                <label class="b-constructor-slider__color-btn<?=$isActive?>" style="background : linear-gradient(135deg,transparent 50%, <?=$item['PROPERTIES']['COLOR_ONE']['VALUE'];?> 50%, <?=$item['PROPERTIES']['COLOR_ONE']['VALUE'];?> 100%) <?=$item['PROPERTIES']['COLOR_TWO']['VALUE'];?>;" for="color-<?=$item['CODE'];?>"></label>

            <? endforeach; ?>
        </div>
    </div>
<? endif; ?>

