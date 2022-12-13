<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<? if (!empty($arResult["ITEMS"])): ?>
<?foreach($arResult["ITEMS"] as $key => $arItem):?>

<?
echo "Начало вывода:";
echo "<pre>";
print_r($arItem);
echo "</pre>";

break;
?>

<? endforeach; ?>
<? endif ?>
