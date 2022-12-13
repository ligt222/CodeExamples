<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (\Bitrix\Main\Loader::includeModule('iblock')) {
    $idBlock = 14;
    $idElement = 19158; //19047
    $res = CIBlockElement::GetProperty($idBlock, $idElement, array("sort" => "asc"), array("CODE" => "POLITC_POLICY"));
    $ob = $res->Fetch();
    $rsFile = CFile::GetByID($ob['VALUE']);
    $arFile = $rsFile->Fetch();
    $fileMobile = '/upload/' . $arFile['SUBDIR'] . '/' . $arFile['FILE_NAME'];
}

if ($arResult["isFormErrors"] == "Y")
{
    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode($arResult["FORM_ERRORS_TEXT"], JSON_UNESCAPED_UNICODE);
    die;
}

if ($arResult['FORM_RESULT'] === "addok")
{
    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
    die;
}
?>
<div class="b-popup__content">
    <div class="b-feedback-form js-feedback-form">
        <h2 class="b-title b-title--feedback-form">
            <?=$arResult['arForm']['NAME']?>
        </h2>
        <a class="b-popup__close b-popup__close--feedback js-close-popup" href="javascript:void(0);">
            <i class="b-icon b-icon--close-popup icon-close"></i>
        </a>
        <form class="b-feedback-form__form js-form-validate" method="post" name="<?=$arResult['WEB_FORM_NAME']?>" action="<?=SITE_DIR.'ajax/newFeedback.php'?>">
            <?=bitrix_sessid_post()?>
            <input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>">
            <input type="hidden" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>">
            <div class="b-input b-input--name b-input--feedback js-input-wrapper"><input class="b-input__input-field js-input" id="feedback-name" type="text" name="form_text_4" value=""/>
                <label class="b-input__label" for="feedback-name"><?=$arResult['QUESTIONS']['SIMPLE_QUESTION_486']['CAPTION']?><span class="b-input__required">*</span>
                </label>
            </div>
            <div class="b-input b-input--email b-input--feedback js-input-wrapper"><input class="b-input__input-field js-input" id="feedback-email" type="text" name="form_email_5" value=""/>
                <label class="b-input__label" for="feedback-email"><?=$arResult['QUESTIONS']['SIMPLE_QUESTION_751']['CAPTION']?><span class="b-input__required">*</span>
                </label>
            </div>
            <div class="b-input b-input--phone b-input--feedback js-input-wrapper"><input class="b-input__input-field js-input js-tel-input js-mask-tel js-tel-no-validation" id="feedback-phone" type="tel" name="form_text_6" value=""/>
                <label class="b-input__label" for="feedback-phone"><?=$arResult['QUESTIONS']['SIMPLE_QUESTION_761']['CAPTION']?><span class="b-input__required">*</span>
                </label>
            </div>
            <div class="b-textarea"><textarea class="b-textarea__textarea-field js-textarea" id="feedback-comment" name="form_textarea_7"></textarea>
                <label class="b-textarea__label" for="feedback-comment"><?=$arResult['QUESTIONS']['SIMPLE_QUESTION_589']['CAPTION']?><span class="b-input__required">*</span>
                </label>
            </div>
            <div class="b-checkbox b-checkbox--order b-checkbox--feedback"><input class="b-checkbox__input" type="checkbox" name="box-test" id="feedback-check" title="Даю согласие на&amp;nbsp;обработку персональных данных" checked="checked" required="required"/>
                <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--feedback" for="feedback-check"><span class="b-checkbox__text"><a href="<?=$fileMobile?>" target="_blank">Даю согласие на&nbsp;обработку персональных данных</a> </span>
                </label>
            </div>
            <button class="b-button b-button--feedback-form" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" disabled="disabled">Отправить
            </button>
        </form>
    </div>
    <div class="b-thanks-block js-hide hide">
        <div class="b-thanks-block__image-wrap"><img class="b-thanks-block__image js-image-wrapper" src="<?=SITE_TEMPLATE_PATH?>/images/inhtml/feed.svg" loading="lazy" alt="" role="presentation"/>
        </div>
        <div class="b-thanks-block__title">Благодарим за обратную связь!
        </div>
        <button class="b-button b-button--feedback-form js-close-popup">Закрыть
        </button>
    </div>
</div>

