<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//$templateData = array(
//    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
//    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
//);
//
//if (isset($templateData['TEMPLATE_THEME'])) {
//    $this->addExternalCss($templateData['TEMPLATE_THEME']);
//}
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
//$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>

<div class="b-filter__filter">
    <h2 class="b-title">Параметры фильтрации</h2>
    <form class="b-filter__form" name="<?= $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $arResult["FORM_ACTION"] ?>" method="get" data-template="/src/build/json/filter-home.mustache">
        <input type="hidden" name="set_filter" value="Y">

<!--        --><?// foreach ($arResult["HIDDEN"] as $arItem): ?>
<!--            <input type="hidden" name="--><?//= $arItem["CONTROL_NAME"] ?><!--" id="--><?//= $arItem["CONTROL_ID"] ?><!--" value="--><?//= $arItem["HTML_VALUE"] ?><!--"/>-->
<!--        --><?// endforeach; ?>

        <? foreach ($arResult["ITEMS"] as $key => $arItem)
        {
            if (!$arItem["VALUES"])
                continue;

            if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
                continue;
            ?>
            <?if ($arItem['IBLOCK_ID'] == 3): ?>
            <div class="b-filter__box">
                <h4 class="b-title"><?= $arItem["NAME"] ?></h4>
                <div class="b-filter__list">
                    <? foreach ($arItem["VALUES"] as $val => $ar): ?>

                        <div class="b-checkbox">
                            <input class="b-checkbox__input"
                                   type="checkbox"
                                   name="<?= $ar["CONTROL_NAME"] ?>"
                                   id="<?= $ar["CONTROL_ID"] ?>"
                                   value="<?= $ar["HTML_VALUE"] ?>"
                                <?= $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                            <label class="b-checkbox__name"
                                   for="<?= $ar["CONTROL_ID"] ?>"
                                   data-role="label_<?=$ar["CONTROL_ID"]?>">
                                <span class="b-checkbox__text"><?= $ar["VALUE"] ?></span>
                            </label>
                        </div>

                    <? endforeach; ?>
                </div>
            </div>
            <?endif;?>
        <? } ?>
        <button class="b-button" type="reset">Сбросить фильтр</button>
    </form>
</div>
