<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>

<div class="bx-auth">
<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>

	<form onsubmit="setTimeout(function(){location.reload();}, 2000);" class="b-authorization__form js-form-validate" name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<?if ($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>

        <div class="b-input b-input--name b-input--authorization b-input--authorization-name js-input-wrapper">
            <input class="bx-auth-input b-input__input-field js-input js-regex js-input-login" id="authorization"
                   type="text" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" required="required"/>
            <label class="b-input__label" for="authorization"><?=GetMessage("AUTH_LOGIN")?><span class="b-input__required">*</span>
            </label>
        </div>
        <div class="b-authorization__password-wrap">
            <div class="b-input b-input--password b-input--authorization-password b-input--authorization js-input-wrapper">
                <input class="bx-auth-input b-input__input-field js-input js-input-password" id="authorization-password"
                       type="password" placeholder="" name="USER_PASSWORD" value="" required="required"/>
                <label class="b-input__label" for="authorization-password"><?=GetMessage("AUTH_PASSWORD")?><span
                            class="b-input__required">*</span>
                </label>
            </div>
            <button class="b-authorization__eye js-button-password">
            </button>
        </div>
        <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
        <div class="b-checkbox b-checkbox--order b-checkbox--authorization"><input
                    class="b-checkbox__input js-class" type="checkbox" name="USER_REMEMBER" id="USER_REMEMBER"
                    title="<?=GetMessage("AUTH_REMEMBER_ME")?>" checked="checked" value="Y"/>
            <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--authorization"
                   for="authorization-check"><span class="b-checkbox__text"><?=GetMessage("AUTH_REMEMBER_ME")?></span>
            </label>
        </div>
        <?endif;?>
        <button class="b-button b-button--authorization js-button-login" disabled="disabled">Войти
        </button>
		<!--<table class="bx-auth-table">
			<tr>
				<td class="bx-auth-label"><?/*=GetMessage("AUTH_LOGIN")*/?></td>
				<td><input class="bx-auth-input form-control" type="text" name="USER_LOGIN" maxlength="255" value="<?/*=$arResult["LAST_LOGIN"]*/?>" /></td>
			</tr>
			<tr>
				<td class="bx-auth-label"><?/*=GetMessage("AUTH_PASSWORD")*/?></td>
				<td><input class="bx-auth-input form-control" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
<?/*if($arResult["SECURE_AUTH"]):*/?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?/*echo GetMessage("AUTH_SECURE_NOTE")*/?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?/*echo GetMessage("AUTH_NONSECURE_NOTE")*/?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?/*endif*/?>
				</td>
			</tr>
			<?/*if($arResult["CAPTCHA_CODE"]):*/?>
				<tr>
					<td></td>
					<td><input type="hidden" name="captcha_sid" value="<?/*echo $arResult["CAPTCHA_CODE"]*/?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?/*echo $arResult["CAPTCHA_CODE"]*/?>" width="180" height="40" alt="CAPTCHA" /></td>
				</tr>
				<tr>
					<td class="bx-auth-label"><?/*echo GetMessage("AUTH_CAPTCHA_PROMT")*/?>:</td>
					<td><input class="bx-auth-input form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" autocomplete="off" /></td>
				</tr>
			<?/*endif;*/?>
<?/*if ($arResult["STORE_PASSWORD"] == "Y"):*/?>
			<tr>
				<td></td>
				<td><input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><label for="USER_REMEMBER">&nbsp;<?/*=GetMessage("AUTH_REMEMBER_ME")*/?></label></td>
			</tr>
<?/*endif*/?>
			<tr>
				<td></td>
				<td class="authorize-submit-cell"><input type="submit" class="btn btn-primary" name="Login" value="<?/*=GetMessage("AUTH_AUTHORIZE")*/?>" /></td>
			</tr>
		</table>-->

<?/*if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</p>
		</noindex>
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<p>
				<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a><br />
				<?=GetMessage("AUTH_FIRST_ONE")?>
			</p>
		</noindex>
<?endif*/?>

	</form>
</div>

<script type="text/javascript">

<?if ($arResult["LAST_LOGIN"] <> ''):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
