<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>




<div class="b-popup b-popup--gallery" data-popup="gallery">
    <div class="b-popup__content">
        <div class="b-gallery">
            <a class="b-popup__close b-popup__close--feedback js-close-popup" href="javascript:void(0);">
                <i class="b-icon b-icon--close-popup icon-close"></i>
            </a>
            <div class="b-gallery__list js-gallery">
                <?foreach ($arResult['PROPERTIES']['CERTIFICATE']['VALUE'] as $val):?>
                <div class="b-gallery__item">
                    <div class="b-images b-images--gallery">
                        <img class="b-images__image b-images__image--gallery" src="<?=CFile::GetPath($val)?>" loading="lazy" alt="" role="presentation"/>
                    </div>
                </div>
                <?endforeach;?>

            </div>
            <div class="b-gallery__control">
                <button class="b-button b-button--prev b-button--constructor-slider b-button--gallery js-gallery-prev">
                </button>
                <button class="b-button b-button--next b-button--constructor-slider b-button--gallery js-gallery-next">
                </button>
            </div>
        </div>
    </div>
</div>