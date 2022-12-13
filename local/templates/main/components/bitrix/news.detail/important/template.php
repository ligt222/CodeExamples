<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="b-container b-container--cooperation">
    <div class="b-content-block b-content-block--important active js-tab-body" data-tab="transportation">
        <ul>
            <?foreach ($arResult['PROPERTIES']['LIST_TRANSPORTATION']['VALUE'] as $item):?>
            <li><?=htmlspecialchars_decode($item);?></li>
            <?endforeach;?>

        </ul>
    </div>
    <div class="b-content-block b-content-block--important js-tab-body" data-tab="storage">
        <ul>
            <?foreach ($arResult['PROPERTIES']['LIST_STORAGE']['VALUE'] as $item):?>
                <li><?=htmlspecialchars_decode($item);?></li>
            <?endforeach;?>

        </ul>
    </div>
    <div class="b-content-block b-content-block--important js-tab-body" data-tab="installation">
        <ul>
            <?foreach ($arResult['PROPERTIES']['LIST_INSTALLATION']['VALUE'] as $item):?>
                <li><?=htmlspecialchars_decode($item);?></li>
            <?endforeach;?>

        </ul>
    </div>
    <div class="b-content-block b-content-block--important js-tab-body" data-tab="exploitation">
        <p><?=htmlspecialchars_decode($arResult['PROPERTIES']['TEXT_EXPLOITATION']['VALUE'])?></p>
        <ul>
            <?foreach ($arResult['PROPERTIES']['LIST_EXPLOITATION']['VALUE'] as $item):?>
                <li><?=htmlspecialchars_decode($item);?></li>
            <?endforeach;?>

        </ul>
    </div>
    <div class="b-content-block b-content-block--important js-tab-body" data-tab="guarantee">
        <p>
            <?=htmlspecialchars_decode($arResult['PROPERTIES']['TEXT_GUARANTEE']['VALUE'])?>
        </p>
    </div>
</div>