<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if ($arResult["isFormNote"] != "Y") { ?>
    <div class="b-order">
        <div class="b-order__wrapper">
            <div class="b-order__title">
                <?=$arResult['arForm']['NAME']?>
            </div>
            <form class="b-order__form js-form-validate" method="post" name="<?=$arResult['WEB_FORM_NAME']?>" action="<?=POST_FORM_ACTION_URI?>">
                <?=bitrix_sessid_post()?>
                <input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>">
                <div class="b-order__input-wrap">
                    <div class="b-input b-input--name js-input-wrapper"><input
                            class="b-input__input-field js-input js-regex" id="order-name" type="text" name="form_text_1"
                            value="" required="required"/>
                        <label class="b-input__label" for="order-name">
                            <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_985']['CAPTION']?>
                            <span class="b-input__required">*</span>
                        </label>
                    </div>
                    <div class="b-input b-input--email b-input--in-rows js-input-wrapper"><input
                            class="b-input__input-field b-input__input-field--in-rows js-input" id="order-email"
                            type="email" name="form_email_2" value="" required="required"/>
                        <label class="b-input__label" for="order-email">
                            <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_758']['CAPTION']?>
                            <span class="b-input__required">*</span>
                        </label>
                    </div>
                    <div class="b-input b-input--phone b-input--in-rows js-input-wrapper"><input
                            class="b-input__input-field b-input__input-field--in-rows js-input js-tel-input"
                            id="order-phone" type="tel" name="form_text_3" value="" required="required"/>
                        <label class="b-input__label" for="order-phone">
                            <?=$arResult['QUESTIONS']['SIMPLE_QUESTION_242']['CAPTION']?>
                            <span class="b-input__required">*</span>
                        </label>
                    </div>
                </div>
                <div class="b-checkbox b-checkbox--order">
                    <input class="b-checkbox__input js-class" type="checkbox"
                           name="box-test" id="order-check"
                           title="Даю согласие на&amp;nbsp;обработку персональных данных"
                           checked="checked" required="required"/>
                    <label class="b-checkbox__name b-checkbox__name--order" for="order-check"><span
                            class="b-checkbox__text">Даю согласие на&nbsp;обработку персональных данных</span>
                    </label>
                </div>
            </form>
        </div>
    </div>
    <button class="b-button b-button--with-icon" name="web_form_submit" type="submit"><span><?=$arResult['arForm']['BUTTON']?></span><i class="b-icon icon-basket"></i>
    </button>
<? } ?>