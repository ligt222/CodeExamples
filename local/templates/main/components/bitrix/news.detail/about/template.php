<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<main class="b-main" role="main">
        <div class="b-container b-container--cooperation">
          <div class="b-content-block b-content-block--about">
              <?foreach ($arResult['PROPERTIES']['TITLE_SUBTITILE_1']['VALUE'] as $item):?>
                  <p>
                    <?=htmlspecialchars_decode($item);?>
                  </p>
              <?endforeach;?>
            <p>
                <?=htmlspecialchars_decode($arResult['PROPERTIES']['DESC_1']['VALUE']['TEXT']);?>
            </p>
            <div class="b-video b-video--about-new">
              <div class="b-video__title"><?=htmlspecialchars_decode($arResult['PROPERTIES']['TITLE_VIDEO']['VALUE']);?>
              </div>
              <video class="b-video__ourVideo js-video js-video--about-new" loading="lazy" poster="<?=CFile::GetPath($arResult['PROPERTIES']['POSTER_VIDEO']['VALUE'])?>" controls="controls" preload="metadata" muted="muted"><source src="<?=CFile::GetPath($arResult['PROPERTIES']['VIDEO_LINK']['VALUE'])?>" type="video/mp4"/>
              </video>
              <button class="b-button b-button--about-new js-play-video">
              </button>
            </div>
              <?foreach ($arResult['PROPERTIES']['TITLE_SUBTITILE_2']['VALUE'] as $item):?>
                  <p><strong><?=htmlspecialchars_decode($item)?></strong></p>
              <?endforeach;?>
            <ul>
                <?foreach ($arResult['PROPERTIES']['LIST_1']['VALUE'] as $item):?>
              <li><?=htmlspecialchars_decode($item);?></li>
                <?endforeach;?>
            </ul>
            <div class="b-gray-block">
              <?=htmlspecialchars_decode($arResult['PROPERTIES']['DESC_2']['VALUE']['TEXT']);?>
            </div>
            <?=htmlspecialchars_decode($arResult['PROPERTIES']['DESC_3']['VALUE']['TEXT']);?>
          </div>
          <div class="b-certificates">
              <? $i = 0;
              foreach ($arResult['PROPERTIES']['CERTIFICATE']['VALUE'] as $value):?>
            <div class="b-certificates__item">
                <a class="b-certificates__link js-open-popup js-open-feedback" href="javascript:void(0);" title="" data-popup="gallery" data-idx="<?=$i?>">
                    <span class="b-images b-images--certificates">
                        <img class="b-images__image b-images__image--certificates" src="<?=CFile::GetPath($value)?>" loading="lazy" alt="" role="presentation"/>
                    </span>
                </a>
            </div>
              <? $i++;
              endforeach;?>
          </div>
        </div>
</main>



