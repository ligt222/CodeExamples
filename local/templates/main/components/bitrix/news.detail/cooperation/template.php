<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="b-container b-container--cooperation">
    <div class="b-content-block">
        <?foreach ($arResult['PROPERTIES']['TITLE_SUBTITLE']['VALUE'] as $item):?>
            <p>
                <strong>
                    <?=$item?>
                </strong>
            </p>
        <?endforeach;?>
        <p>
            <?=htmlspecialchars_decode($arResult['PROPERTIES']['DESC_1']['VALUE']['TEXT'])?>
        </p>
        <h2>
            <?=$arResult['PROPERTIES']['NAME_LIST_1']['VALUE']?>
        </h2>
        <ul>
            <?foreach ($arResult['PROPERTIES']['LIST']['VALUE'] as $item):?>
                <li><?=$item?></li>
            <?endforeach;?>
        </ul>
        <p>
            <strong>
                <?=$arResult['PROPERTIES']['NAME_LIST_CITIES']['VALUE'];?>
            </strong>
        </p>
    </div>
    <div class="b-regions">
        <div class="b-regions__info">
            <?=$arResult['PROPERTIES']['NAME_LIST_2']['VALUE']?>
        </div>
        <ul class="b-regions__list">
            <?foreach ($arResult['CITIES_LIST'] as $list):?>
            <li class="b-regions__item">
                <?if($list['LINK']):?>
                    <a class="b-regions__link" href="<?=$list['LINK']?>" title="<?=$list['NAME'];?>" target="_blank">
                <?else:?>
                    <div class="b-regions__link b-regions__link--no-link">
                <?endif;?>
                        <?if($list['FILE_SRC']):?>
                            <span class="b-regions__flag">
                                <img class="b-regions__flag-image js-image-wrapper" src="<?=$list['FILE_SRC']?>" alt="" loading="lazy" width="50" height="24" role="presentation"/>
                            </span>
                        <?endif;?>
                        <i class="b-icon b-icon--region icon-pin"></i>
                        <span class="b-regions__name">
                            <?=$list['NAME'];?>
                        </span>
                <?if($list['LINK']):?>
                    </a>
                <?else:?>
                    </div>
                <?endif;?>
            </li>
            <?endforeach;?>
        </ul>
    </div>

    <div class="b-content-block">
        <p>
                <?=htmlspecialchars_decode($arResult['PROPERTIES']['FOOTER_TEXT']['VALUE'])?>
        </p>
    </div>


</div>