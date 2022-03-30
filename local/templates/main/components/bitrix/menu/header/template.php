<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="b-header__list">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
    <li class="b-header__item"><a href="<?=$arItem["LINK"]?>" class="b-link <?if($arItem["SELECTED"]):?>active<?endif;?>"><?=$arItem["TEXT"]?></a></li>
<?endforeach?>

</ul>
<?endif?>