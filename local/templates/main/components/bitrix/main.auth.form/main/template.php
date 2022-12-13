<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if (isset($_POST['AUTH_ACTION']))
{
    $APPLICATION->RestartBuffer();
    header('Content-Type: application/json');

    if ($arResult['ERRORS'])
       echo json_encode(['success' => false, 'error' => str_replace('<br>', '', $arResult['ERRORS']['ERROR_PROCESSING'])]);
    elseif ($USER->IsAuthorized())
        echo json_encode(['success' => true]);

    die;
}
?>

<form class="b-authorization__form js-form-validate" method="post" name="form-authorization" autocomplete="off" action="<?=$arResult['CURR_URI']?>">

    <input type="hidden" name="AUTH_ACTION" value="ok">

    <div class="b-input b-input--name b-input--authorization b-input--authorization-name js-input-wrapper">
        <input class="b-input__input-field js-input js-regex js-input-login" id="authorization" type="text" name="<?= $arResult['FIELDS']['login'];?>" value="" required="required"/>
        <label class="b-input__label" for="authorization">Логин<span class="b-input__required">*</span></label>
    </div>
    <div class="b-authorization__password-wrap">
        <div class="b-input b-input--password b-input--authorization-password b-input--authorization js-input-wrapper">
            <input class="b-input__input-field js-input js-input-password" id="authorization-password" type="password" placeholder="" name="<?= $arResult['FIELDS']['password'];?>" value="" required="required"/>
            <label class="b-input__label" for="authorization-password">Пароль<span class="b-input__required">*</span></label>
        </div>
        <button class="b-authorization__eye js-button-password"></button>
    </div>
    <div class="b-checkbox b-checkbox--order b-checkbox--authorization">
        <input class="b-checkbox__input js-class" type="checkbox" name="<?= $arResult['FIELDS']['remember'];?>" id="authorization-check" title="Запомнить" checked="checked"/>
        <label class="b-checkbox__name b-checkbox__name--order b-checkbox__name--authorization" for="authorization-check">
            <span class="b-checkbox__text">Запомнить</span>
        </label>
    </div>
    <button class="b-button b-button--authorization js-button-login" disabled="disabled">Войти</button>
</form>
