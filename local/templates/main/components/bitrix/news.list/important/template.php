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
?>


<div class="b-container b-container--cooperation">
    <?$i = 0;
    foreach ($arResult['ITEMS'] as $item):?>
        <div class="b-content-block b-content-block--important <?if($i == 0):?> active<?endif;?> js-tab-body" data-tab="list_<?=$item['IBLOCK_SECTION_ID']?>">
            <?if($item['PROPERTIES']['TEXT_EXP']['VALUE']):?>
                <p><?=htmlspecialchars_decode($item['PROPERTIES']['TEXT_EXP']['VALUE'])?></p>
            <?endif;?>
            <?if($item['PROPERTIES']['LIST']['VALUE']):?>
            <ul>
                <?foreach ($item['PROPERTIES']['LIST']['VALUE'] as $str):?>
                    <li><?=htmlspecialchars_decode($str);?></li>
                <?endforeach;?>

            </ul>
            <?endif;?>
            <?if($item['PROPERTIES']['TEXT']['VALUE']):?>
            <p>
                <?=htmlspecialchars_decode($item['PROPERTIES']['TEXT']['VALUE'])?>
            </p>
            <?endif;?>
            <?if($item['PROPERTIES']['TEXT2']['VALUE']):?>
                <p>
                    <?=htmlspecialchars_decode($item['PROPERTIES']['TEXT2']['VALUE'])?>
                </p>
            <?endif;?>
            <?if($item['DETAIL_TEXT']):?>

                    <?=htmlspecialchars_decode($item[DETAIL_TEXT])?>

            <?endif;?>
            <?if($item['PROPERTIES']['LIST2']['VALUE']):?>
                <ul>
                    <?foreach ($item['PROPERTIES']['LIST2']['VALUE'] as $str):?>
                        <li><?=htmlspecialchars_decode($str);?></li>
                    <?endforeach;?>

                </ul>
            <?endif;?>

        </div>
    <?$i++;
    endforeach;?>
</div>