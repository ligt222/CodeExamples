<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>

    <a class="b-constructor-slider__slide js-door-btn" href="javascript:void(0);" title=""
       data-target="/images/content/doors/door_1.jpg">
        <span class="b-constructor-slider__img-wrap">
            <img class="b-constructor-slider__slide-img js-image-wrapper"
                 src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt=""
                 loading="lazy" role="presentation"/>
        </span>
        <span class="b-constructor-slider__door-name">
            <?=$item['NAME']?>
        </span>
    </a>