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

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");

?>
<form class="b-constructor js-constructor js-form-validate" method="post"
      name="form-feedback_form"
      action="<?= $arResult["FORM_ACTION"] ?>">
    <input type="hidden" name="set_filter" value="Y">
    <? foreach ($arResult["HIDDEN"] as $arItem): ?>
        <input type="hidden" name="<?= $arItem["CONTROL_NAME"] ?>" id="<?= $arItem["CONTROL_ID"] ?>"
               value="<?= $arItem["HTML_VALUE"] ?>"/>
    <? endforeach; ?>
    <div class="b-constructor__inner">
        <div class="b-constructor__breadcrumbs">
            <nav class="b-breadcrumbs b-breadcrumbs--light js-backcrumbs">
                <ul class="b-breadcrumbs__list">
                    <li class="b-breadcrumbs__item"><a class="b-breadcrumbs__link js-constructor-back"
                                                       title="Конструктор">Конструктор</a>
                    </li>
                    <li class="b-breadcrumbs__item hidden"><span
                                class="b-breadcrumbs__link js-backcrumbs-item"></span>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="b-constructor__list">
            <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                if (
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                )
                    continue;

                if (
                    $arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                )
                    continue;
                ?>
                <? if ($arItem['IBLOCK_ID'] == 4): ?>

                    <div class="b-constructor__item">
                        <a class="b-constructor__link js-constructor-link"
                           href="javascript:void(0);">
                            <span><?= $arItem["NAME"] ?></span>
                            <i class="b-icon icon-bread-crumbs"></i>
                        </a>
                        <div class="b-constructor__current js-current-wrap">
                            <div class="b-constructor__current-inner">
                                <div class="b-constructor__current-el js-current-box">
                                </div>
                                <a class="b-constructor__link-clear js-constructor-clear"
                                   href="javascript:void(0);">
                                    <i class="b-icon icon-rotate"></i>
                                    <span>сбросить</span>
                                </a>
                            </div>
                        </div>
                        <div class="b-constructor__filter-list js-constructor-filter">
                            <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                <div class="b-radio-button">
                                    <input class="b-radio-button__input js-radio-button"
                                           type="radio" name="<?= $ar["CONTROL_NAME"] ?>"
                                           id="<?= $ar["CONTROL_ID"] ?>"
                                           data-target="<?= $ar['FILE']['SRC'] ?>"
                                           value="<?= $ar['HTML_VALUE']; ?>"/>
                                    <label class="b-radio-button__label" for="<?= $ar["CONTROL_ID"] ?>">
                                    <span class="b-radio-button__wrap js-current-el">
                                        <span class="b-radio-button__image">
                                            <span style="background: linear-gradient(0deg, #948C85, #948C85), url(<?= $ar['FILE']['SRC'] ?>) center center/cover no-repeat;"></span>
                                        </span>
                                        <span class="b-radio-button__text-label"><?= $ar["VALUE"] ?></span>
                                    </span>
                                        <span class="b-radio-button__status b-radio-button__status--select">
                                        <span>Выбрать</span>
                                    </span>
                                        <span class="b-radio-button__status b-radio-button__status--selected">
                                        <i class="b-icon icon-check-mark"></i>
                                        <span>Выбрано</span>
                                    </span>
                                    </label>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>

                <? endif; ?>
            <? } ?>
        </div>
    </div>
    <div class="b-constructor__buttons">
        <button class="b-button b-button--back js-constructor-back"><i class="b-icon icon-arrow-left"></i>
        </button>
        <div class="b-constructor__buttons-box">
            <button class="b-button b-button--canceled js-button-edit">Отмена
            </button>
            <button class="b-button b-button--save js-button-edit">Сохранить
            </button>
        </div>
    </div>

</form>