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


if (\Bitrix\Main\Loader::includeModule('iblock')) {

    $arSelect = array("PREVIEW_PICTURE", "DETAIL_PICTURE");
    $arFilter = array("IBLOCK_CODE" => "main_page_setting", "CODE" => "backgruond_main_slider");
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nPageSize" => 50), $arSelect);
    $ob = $res->Fetch();
    $rsFile = CFile::GetByID($ob["DETAIL_PICTURE"]);
    $arFile = $rsFile->Fetch();
    $fileDesctop = '/upload/'.$arFile['SUBDIR'] .'/'.$arFile['FILE_NAME'];
    $rsFile = CFile::GetByID($ob["PREVIEW_PICTURE"]);
    $arFile = $rsFile->Fetch();
    $fileMobile = '/upload/'.$arFile['SUBDIR'] .'/'.$arFile['FILE_NAME'];

}
?>

<div class="b-images b-images--slider-back b-images--tablet">
    <img class="b-images__image b-images__image--slider-back b-images__image--tablet"
         src="<?=$fileDesctop?>" loading="lazy" alt=""
         role="presentation"/>
</div>
<div class="b-slider__wrapper">
    <div class="b-images b-images--slider-back b-images--mobile">
        <img class="b-images__image b-images__image--slider-back b-images__image--mobile" src="<?=$fileMobile?>" loading="lazy" alt="" role="presentation"/>
    </div>
    <div class="b-slider__list js-slider">
        <?foreach ($arResult['ITEMS'] as $item):?>
        <div class="b-slider__item">
            <div class="b-images b-images--slider">
                <?if($item['PROPERTIES']['LINK_CATALOG']['VALUE']) {?>
                 <a href="<?=$item['PROPERTIES']['LINK_CATALOG']['VALUE']?>">
                    <img class="b-images__image b-images__image--slider" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" loading="lazy" alt="" role="presentation"/>
                 </a>
                <?} else {?>
                   <img class="b-images__image b-images__image--slider" src="<?=$item['PREVIEW_PICTURE']['SRC']?>" loading="lazy" alt="" role="presentation"/>
                <?}?>
            </div>
        </div>
        <?endforeach;?>
    </div>
    <div class="b-slider__control">
        <button class="b-button b-button--arrow b-button--arrow-prev b-button--slider js-slider-prev">
        </button>
        <button class="b-button b-button--arrow b-button--arrow-next b-button--slider js-slider-next">
        </button>
    </div>
</div>
<div class="b-slider__wrapper b-slider__wrapper--second js-slider-second">
    <?foreach ($arResult['ITEMS'] as $item):?>
    <div class="b-slider__item">
        <div class="b-slider__content">
            <h1 class="b-title b-title--slider"><?=$item['NAME']?>
            </h1>
            <div class="b-slider__text"><?=$item['PREVIEW_TEXT']?>
            </div>
        </div>
    </div>
    <?endforeach;?>
</div>