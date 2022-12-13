<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<div class="b-top-aside__item b-top-aside__item--cart">
    <a class="b-link-cart" href="<?=$arParams['PATH_TO_BASKET']?>">
        <span class="b-link-cart__icon">
            <i class="b-icon icon-basket"></i>
            <span class="b-link-cart__counter">
                <span>
                    <?=$arResult['CNT_PRODUCT'];?>
                </span>
            </span>
        </span>
        <span class="b-link-cart__text">Корзина</span>
    </a>
</div>
