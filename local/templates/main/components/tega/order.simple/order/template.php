<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["ORDER_SUCCESSFULLY_CREATED"] == "Y") {
    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');
    echo json_encode(array("status" => "success"), JSON_UNESCAPED_SLASHES || JSON_NUMERIC_CHECK);
    die;
    return;
} else {
    ?>
    <script type="text/javascript">
        function submitTest(val, formId, validationID){
            BX(validationID).value = (val !== 'Y') ? "N" : "Y";
            var orderForm = BX(formId);
            let data = new FormData(orderForm);
            BX.ajax({
                url: '/cart/',
                data: data,
                method: 'POST',
                dataType: 'json',
                processData: false,
                preparePost: false,
                onsuccess: function(result){
                    let data = JSON.parse(result);
                        console.log(data);
                },
                onfailure: function(){
                    console.log('error');
                }
            });
        }
        function submitForm(val) {
            BX('<? echo $arParams["ENABLE_VALIDATION_INPUT_ID"]; ?>').value = (val !== 'Y') ? "N" : "Y";
            var orderForm = BX('<? echo $arParams["FORM_ID"]; ?>');
            BX.submit(orderForm);
            return true;
        }
    </script>
    <div class="b-order">
        <div class="b-order__wrapper">
            <div class="b-order__title">
                Оформление заказа
            </div>
            <form class="b-order__form js-form-validate"
                  method="post"
                  id="<?= $arParams["FORM_ID"] ?>"
                  name="<?= $arParams["FORM_NAME"] ?>"
                  action="<?= $arParams["FORM_ACTION"] ?>">
                <?= bitrix_sessid_post() ?>
                <input type="hidden"
                       name="<? echo $arParams["ENABLE_VALIDATION_INPUT_NAME"]; ?>"
                       id="<? echo $arParams["ENABLE_VALIDATION_INPUT_ID"]; ?>"
                       value="Y">
                <? if ($arResult["PAY_SYSTEM"]) { ?>
                    <div class="order-simple__block" style="display: none">
                        <div class="order-simple__block__title"><? echo GetMessage("PAY_SYSTEM"); ?></div>
                        <?
                        foreach ($arResult["PAY_SYSTEM"] as $arPaySystem) { ?>
                            <div class="order-simple__field">
                                <label for="pay_system_<?= $arPaySystem["ID"] ?>">
                                    <input type="radio"
                                           onchange="submitForm(); return false;"
                                           <? if ($arPaySystem["CHECKED"] == "Y"){ ?>checked<? } ?>
                                           id="pay_system_<?= $arPaySystem["ID"] ?>"
                                           name="<? echo $arParams["FORM_NAME"] ?>[PAY_SYSTEM]"
                                           value="<?= $arPaySystem["ID"] ?>"
                                           autocomplete="off"
                                    />
                                    <?= $arPaySystem["NAME"] ?>
                                </label>
                            </div>
                        <? } ?>
                    </div>
                <? } ?>
                <div class="b-order__input-wrap">
                    <div class="b-input b-input--name js-input-wrapper"><input
                                class="b-input__input-field js-input js-regex" id="<?= $arParams['FORM_NAME'] ?>_NAME"
                                type="text" name="<?= $arParams['FORM_NAME'] ?>[NAME]"
                                value="" required="required"/>
                        <label class="b-input__label" for="<?= $arParams['FORM_NAME'] ?>_NAME">
                            ФИО
                            <span class="b-input__required">*</span>
                        </label>
                    </div>
                    <div class="b-input b-input--email b-input--in-rows js-input-wrapper"><input
                                class="b-input__input-field b-input__input-field--in-rows js-input"
                                id="<?= $arParams['FORM_NAME'] ?>_EMAIL"
                                type="email" name="<?= $arParams['FORM_NAME'] ?>[EMAIL]" value="" required="required"/>
                        <label class="b-input__label" for="<?= $arParams['FORM_NAME'] ?>_EMAIL">
                            Почта
                            <span class="b-input__required">*</span>
                        </label>
                    </div>
                    <div class="b-input b-input--phone b-input--in-rows js-input-wrapper"><input
                                class="b-input__input-field b-input__input-field--in-rows js-input js-tel-input"
                                id="<?= $arParams['FORM_NAME'] ?>[PHONE]" type="tel"
                                name="<?= $arParams['FORM_NAME'] ?>[PHONE]" value="" required="required"/>
                        <label class="b-input__label" for="<?= $arParams['FORM_NAME'] ?>[PHONE]">
                            +7(___)___-__-__
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
                <!--<button class="b-button b-button--with-icon" onclick="submitForm('Y'); return false;"><span>Оформить заказ</span><i
                            class="b-icon icon-basket"></i>
                </button>-->
                <button class="b-button b-button--with-icon" onclick="submitTest('Y', <?=$arParams['FORM_ID']?>, <?=$arParams['ENABLE_VALIDATION_INPUT_ID']?>); return false;"><span>Оформить заказ</span><i
                            class="b-icon icon-basket"></i>
                </button>
            </form>
        </div>
    </div>
<? } ?>



