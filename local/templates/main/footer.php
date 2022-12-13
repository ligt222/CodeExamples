<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

</div>
<? $APPLICATION->IncludeFile(
    SITE_DIR."include/add_basket_popap.php",
    array(),
    array()
);?>

<? if ($USER->IsAuthorized()) {
    $APPLICATION->IncludeFile(
        SITE_DIR."include/log_out_popap.php",
        array(),
        array()
    );
}?>

<? $APPLICATION->IncludeFile(
    SITE_DIR."include/feedback_popap.php",
    array(),
    array()
);?>

<?
if ($APPLICATION->GetCurPage() == '/about/')
$APPLICATION->IncludeFile(
    SITE_DIR."include/about_certificates_popap.php",
    array(),
    array()
);?>


<?
if ($APPLICATION->GetProperty('showPopupConstructor') == 'Y')
$APPLICATION->IncludeFile(
    SITE_DIR."include/constructor_popap.php",
   array(),
    array()
);?>

</body>
</html>

<?
use Bitrix\Main\Page\Asset;
Asset::getInstance()->addJs(SITE_DIR . 'src/build/js/jquery/jquery.min.js');
Asset::getInstance()->addJs(SITE_DIR . 'src/build/js/external.js');
Asset::getInstance()->addJs(SITE_DIR . 'src/build/js/internal.js');
Asset::getInstance()->addJs(SITE_DIR . 'src/build/js/filter.js');
?>