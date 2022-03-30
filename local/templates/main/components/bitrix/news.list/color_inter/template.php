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
<div class="b-constructor-slider__color-changer">
    <div class="b-constructor-slider__info">Выбор цвета интерьера:
    </div>
    <div class="b-constructor-slider__color-btn-wrap">
        <?$i = 0;
            foreach ($arResult['ITEMS'] as $item): ?>

            <label class="b-constructor-slider__color-btn <?if($i == 0):?>active<?endif;?>"
                   style="background : linear-gradient(135deg,transparent 50%, <?=$item['PROPERTIES']['COLOR_ONE']['VALUE'];?> 50%, <?=$item['PROPERTIES']['COLOR_ONE']['VALUE'];?> 100%) <?=$item['PROPERTIES']['COLOR_TWO']['VALUE'];?>;"
                   for="color-<?=$item['CODE'];?>">
            </label>

        <? $i++;
            endforeach; ?>
    </div>
</div>
<!--<div class="b-constructor-slider__color-changer">
    <div class="b-constructor-slider__info">Выбор цвета интерьера:
    </div>
    <div class="b-constructor-slider__color-btn-wrap">
        <label class="b-constructor-slider__color-btn active"
               style="background : linear-gradient(135deg,transparent 50%, #D4D4D6 50%, #D4D4D6 100%) #F0F1F3;"
               for="color-gr">
        </label>
        <label class="b-constructor-slider__color-btn"
               style="background : linear-gradient(135deg,transparent 50%, #E5E781 50%, #E5E781 100%) #FDFFAB;"
               for="color-yeow">
        </label>
        <label class="b-constructor-slider__color-btn"
               style="background : linear-gradient(135deg,transparent 50%, #65A7F5 50%, #65A7F5 100%) #81BBFE;"
               for="color-bue">
        </label>
        <label class="b-constructor-slider__color-btn"
               style="background : linear-gradient(135deg,transparent 50%, #F39D8A 50%, #F39D8A 100%) #FFB3A3;"
               for="color-rd">
        </label>
        <label class="b-constructor-slider__color-btn"
               style="background : linear-gradient(135deg,transparent 50%, #D4B2EF 50%, #D4B2EF 100%) #E7C8FF;"
               for="color-pple">
        </label>
    </div>
</div>-->

