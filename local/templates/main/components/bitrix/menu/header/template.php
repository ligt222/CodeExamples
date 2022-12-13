<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? if (!empty($arResult)): ?>

<ul class="b-header__list">

<? foreach($arResult as $arItem):

    $isActive = ($arItem["SELECTED"] ? ' active' : '');
?>

    <li class="b-header__item">
        <a href="<?=$arItem["LINK"]?>" class="b-link<?=$isActive?>"><?=$arItem["TEXT"]?></a>
    </li>

<?endforeach?>

</ul>

<?endif?>