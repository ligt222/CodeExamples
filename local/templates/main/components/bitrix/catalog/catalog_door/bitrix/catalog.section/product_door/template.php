<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
    $APPLICATION->SetTitle("Конфигуратор дверей модели серии" . $arResult['NAME']);
?>

<div class="b-constructor-slider__slider-wrap">
    <div class="b-constructor-slider__series-name">Модели серии:&nbsp;
        <mark class="b-constructor-slider__mark"><?=$arResult['NAME']?></mark>
    </div>
    <div class="b-constructor-slider__slider-control">
        <button class="b-button b-button--prev b-button--constructor-slider js-constructor-prev">
        </button>
        <button class="b-button b-button--next b-button--constructor-slider js-constructor-next">
        </button>
    </div>
    <div class="b-constructor-slider__inner-wrap">

<div class="b-constructor-slider__slider js-constructor-slider">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <? foreach ($arItem['OFFERS'] as $item): ?>
        <?
            $image = ( $item['PREVIEW_PICTURE'] ? $item['PREVIEW_PICTURE']['SRC']: $item['DETAIL_PICTURE']['SRC']);
            $image = ( $image  ? $image : $arItem['DETAIL_PICTURE']['SRC']);
            $srcImage = CFile::GetPath($arItem['PROPERTIES']['IMG_M']['VALUE']);
            $srcImageHover = CFile::GetPath($arItem['PROPERTIES']['IMG_H']['VALUE']);
        ?>
        <? $detailPicture = ($image ?: '/upload/image_not_found.png'); ?>

        <a class="b-constructor-slider__slide js-door-btn" href="javascript:void(0);" title=""
           data-id="<?=$arItem['ID'];?>"
           data-target="<?//=$detailPicture;?>"><?//TODO заглушка картинки?>
            <span class="b-constructor-slider__img-wrap">
                <? if ($srcImage): ?>
                    <img class="b-constructor-slider__slide-img js-image-wrapper" src="<?=$srcImage?>" alt="" loading="lazy" role="presentation"/>
                    <img class="b-constructor-slider__slide-img b-constructor-slider__slide-img--active js-image-wrapper" src="<?=$srcImageHover?>" alt="" loading="lazy" role="presentation">
                <? else : ?>
                    <img class="b-constructor-slider__slide-img js-image-wrapper" src="/upload/model_no_image.png" alt="" loading="lazy" role="presentation"/>
                    <!-- <img class="b-constructor-slider__slide-img b-constructor-slider__slide-img--active js-image-wrapper" src="/images/content/doors/prague_active.svg" alt="" loading="lazy" role="presentation"> -->
                <? endif; ?>
            </span>
            <span class="b-constructor-slider__door-name"><?=$arItem['NAME']?></span>
        </a>

        <?endforeach;?>
    <?endforeach;?>
</div>

    </div>
</div>