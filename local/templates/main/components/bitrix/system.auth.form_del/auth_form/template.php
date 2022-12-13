<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);

$GLOBALS['APPLICATION']->RestartBuffer();

?>

<!--<div class="bx-auth">-->
<?//if($arResult["AUTH_SERVICES"]):?>
<!--	<div class="bx-auth-title">--><?//echo GetMessage("AUTH_TITLE")?><!--</div>-->
<?//endif?>
<!---->
<!--	<form onsubmit="setTimeout(function(){location.reload();}, 2000);" class="b-authorization__form js-form-validate" name="form_auth" method="post" target="_top" action="--><?//=$arResult["AUTH_URL"]?><!--">-->
<!---->
<!--		<input type="hidden" name="AUTH_FORM" value="Y" />-->
<!--		<input type="hidden" name="TYPE" value="AUTH" />-->
<!--		--><?//if ($arResult["BACKURL"] <> ''):?>
<!--		<input type="hidden" name="backurl" value="--><?//=$arResult["BACKURL"]?><!--" />-->
<!--		--><?//endif?>
<!--		--><?//foreach ($arResult["POST"] as $key => $value):?>
<!--		<input type="hidden" name="--><?//=$key?><!--" value="--><?//=$value?><!--" />-->
<!--		--><?//endforeach?>
<!---->
<!--        <div class="b-input b-input--name b-input--authorization b-input--authorization-name js-input-wrapper">-->
<!--            <input class="bx-auth-input b-input__input-field js-input js-regex js-input-login" id="authorization"-->
<!--                   type="text" name="USER_LOGIN" value="--><?//=$arResult["LAST_LOGIN"]?><!--" required="required"/>-->
<!--            <label class="b-input__label" for="authorization">--><?//=GetMessage("AUTH_LOGIN")?><!--<span class="b-input__required">*</span>-->
<!--            </label>-->
<!--        </div>-->
<!--        <div class="b-authorization__password-wrap">-->
<!--            <div class="b-input b-input--password b-input--authorization-password b-input--authorization js-input-wrapper">-->
<!--                <input class="bx-auth-input b-input__input-field js-input js-input-password" id="authorization-password"-->
<!--                       type="password" placeholder="" name="USER_PASSWORD" value="" required="required"/>-->
<!--                <label class="b-input__label" for="authorization-password">--><?//=GetMessage("AUTH_PASSWORD")?><!--<span-->
<!--                            class="b-input__required">*</span>-->
<!--                </label>-->
<!--            </div>-->
<!--            <button class="b-authorization__eye js-button-password">-->
<!--            </button>-->
<!--        </div>-->
<!--        --><?//if ($arResult["STORE_PASSWORD"] == "Y"):?>
<!--        <div class="b-checkbox b-checkbox--order b-checkbox--authorization"><input-->
<!--                    class="b-checkbox__input js-class" type="checkbox" name="USER_REMEMBER" id="USER_REMEMBER"-->
<!--                    title="--><?//=GetMessage("AUTH_REMEMBER_ME")?><!--" checked="checked" value="Y"/>-->
<!--            <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--authorization"-->
<!--                   for="authorization-check"><span class="b-checkbox__text">--><?//=GetMessage("AUTH_REMEMBER_ME")?><!--</span>-->
<!--            </label>-->
<!--        </div>-->
<!--        --><?//endif;?>
<!--        <button class="b-button b-button--authorization js-button-login" disabled="disabled">Войти-->
<!--        </button>-->
<!--	</form>-->
<!--</div>-->


<form class="b-authorization__form js-form-validate" method="post" name="form-authorization" action="">
    <div class="b-input b-input--name b-input--authorization b-input--authorization-name js-input-wrapper">
        <input class="b-input__input-field js-input js-regex js-input-login" id="authorization" type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" required="required"/>
        <label class="b-input__label" for="authorization">Логин<span class="b-input__required">*</span></label>
    </div>
    <div class="b-authorization__password-wrap">
        <div class="b-input b-input--password b-input--authorization-password b-input--authorization js-input-wrapper">
            <input class="b-input__input-field js-input js-input-password" id="authorization-password" type="password" placeholder="" name="USER_PASSWORD" value="" required="required"/>
            <label class="b-input__label" for="authorization-password">Пароль<span class="b-input__required">*</span></label>
        </div>
        <button class="b-authorization__eye js-button-password"></button>
    </div>
    <div class="b-checkbox b-checkbox--order b-checkbox--authorization">
        <input class="b-checkbox__input js-class" type="checkbox" name="USER_REMEMBER" id="authorization-check" title="Запомнить" checked="checked"/>
        <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--authorization" for="authorization-check">
            <span class="b-checkbox__text">Запомнить</span>
        </label>
    </div>
    <button class="b-button b-button--authorization js-button-login" disabled="disabled">Войти</button>
</form>


























<script type="text/javascript">

<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>
