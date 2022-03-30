<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

?>

    <div class="b-constructor-slider__slider js-constructor-slider">
        <? foreach ($arResult['ITEMS'] as $item):?>
        <a class="b-constructor-slider__slide js-door-btn" href="javascript:void(0);" title=""
           data-id="<?=$item['ID'];?>"
           data-target="<?=$item['DETAIL_PICTURE_URL'];?>">
            <span class="b-constructor-slider__img-wrap">
                <img class="b-constructor-slider__slide-img js-image-wrapper"
                     src="<?=$item['PREV_PICTURE_URL']?>" alt="" loading="lazy" role="presentation"/>
            </span>
            <span class="b-constructor-slider__door-name">
                <?=$item['NAME']?>
            </span>
        </a>
        <?endforeach;?>
    </div>

