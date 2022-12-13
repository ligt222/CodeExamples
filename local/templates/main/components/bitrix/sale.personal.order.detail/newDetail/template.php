<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$APPLICATION->SetTitle("Информация о заказе");

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach ($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}

	$component = $this->__component;

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach ($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	?>
	<div class="container-fluid sale-order-detail">
		<div class="sale-order-detail-title-container">
            <h2 style="text-align: center">
                ОФОРМЛЕНИЕ ЗАКАЗА
            </h2>
			<p style="text-align: center">
                Заказ №<?=$arResult["ACCOUNT_NUMBER"]?> успешно создан!
                Спасибо за заказ!
			</p>
            <p style="text-align: center">
                Мы свяжемся с Вами в ближайшее время для уточнения деталей по заказу.
            </p>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 sale-order-detail-general" style="border-radius: 15px; border: 1px solid #393939;">
			<div class="row" style="border-radius: 15px;">
				<div class="col-md-12 cols-sm-12 col-xs-12 sale-order-detail-general-head" style="border-top-left-radius: 15px; border-top-right-radius: 15px; background-color: #393939; text-align: center">
					<span class="sale-order-detail-general-item">
						Информация о заказе
					</span>
				</div>
			</div>

			<div class="row sale-order-detail-payment-options-order-content">

				<div class="col-md-12 col-sm-12 col-xs-12 sale-order-detail-payment-options-order-content-container">
					<div class="row">
						<div class="sale-order-detail-order-section bx-active">
							<div class="sale-order-detail-order-section-content container-fluid">
								<div class="sale-order-detail-order-table-fade sale-order-detail-order-table-fade-right">
									<div style="width: 100%; overflow-x: auto; overflow-y: hidden;">
										<div class="sale-order-detail-order-item-table">
											<div class="sale-order-detail-order-item-tr hidden-sm hidden-xs">
												<div class="sale-order-detail-order-item-td" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_NAME')?>
													</div>
												</div>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_PRICE')?>
													</div>
												</div>
												<?
												if($arResult["SHOW_DISCOUNT_TAB"] <> '')
												{
													?>
													<div
														class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right"
														style="padding-bottom: 5px;">
														<div class="sale-order-detail-order-item-td-title">
															<?= Loc::getMessage('SPOD_DISCOUNT') ?>
														</div>
													</div>
													<?
												}
												?>
												<div class="sale-order-detail-order-item-nth-4p1"></div>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_QUANTITY')?>
													</div>
												</div>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_ORDER_PRICE')?>
													</div>
												</div>
											</div>
											<? foreach ( $arResult['ITEMS'] as $key => $basketItem ) : ?>
                                                <div class="sale-order-detail-order-item-tr sale-order-detail-order-basket-info sale-order-detail-order-item-tr-first">
													    <div class="sale-order-detail-order-item-td" style="min-width: 300px;">
														<div class="sale-order-detail-order-item-block">
															<div class="sale-order-detail-order-item-img-block">
																<a href="<?=$basketItem['DETAIL_PAGE_URL']?>" style="color: #393939;">
																	<?
																	if($basketItem['PICTURE']['SRC'] <> '')
																	{
																		$imageSrc = $basketItem['PICTURE']['SRC'];
																	}
																	else
																	{
																		$imageSrc = $this->GetFolder().'/images/no_photo.png';
																	}
																	?>
																	<div class="sale-order-detail-order-item-imgcontainer"
																		 style="background-image: url(<?=$imageSrc?>);
																			 background-image: -webkit-image-set(url(<?=$imageSrc?>) 1x,
																			 url(<?=$imageSrc?>) 2x)">
																	</div>
																</a>
															</div>
															<div class="sale-order-detail-order-item-content">
																<div class="sale-order-detail-order-item-title">
																	<a href="<?=$basketItem['DETAIL_PAGE_URL']?>" style="color: #393939;">
																		<?=htmlspecialcharsbx($basketItem['NAME'])?>
																	</a>
																</div>
																<?
																if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS']))
																{
																	foreach ($basketItem['PROPS'] as $itemProps)
																	{
																		?>
																		<div class="sale-order-detail-order-item-color">
																		<span class="sale-order-detail-order-item-color-name">
																			<?=htmlspecialcharsbx($itemProps['NAME'])?>:</span>
																			<span class="sale-order-detail-order-item-color-type">
																			<?=htmlspecialcharsbx($itemProps['VALUE'])?></span>
																		</div>
																		<?
																	}
																}
																?>
															</div>
														</div>
													</div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                <?= Loc::getMessage('SPOD_PRICE')?>
                                                            </div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                                <strong class="bx-price"><?=$basketItem['BASE_PRICE_FORMATED']?></strong>
                                                            </div>
                                                        </div>
                                                        <?
                                                        if($basketItem["DISCOUNT_PRICE_PERCENT_FORMATED"] <> '')
                                                        {
                                                            ?>
                                                            <div
                                                                class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
                                                                <div
                                                                    class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                    <?= Loc::getMessage('SPOD_DISCOUNT') ?>
                                                                </div>
                                                                <div class="sale-order-detail-order-item-td-text">
                                                                    <strong
                                                                        class="bx-price"><?= $basketItem['DISCOUNT_PRICE_PERCENT_FORMATED'] ?></strong>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        elseif(mb_strlen($arResult["SHOW_DISCOUNT_TAB"]))
                                                        {
                                                            ?>
                                                            <div
                                                                class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
                                                                <div
                                                                    class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                    <?= Loc::getMessage('SPOD_DISCOUNT') ?>
                                                                </div>
                                                                <div class="sale-order-detail-order-item-td-text">
                                                                    <strong class="bx-price"></strong>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
													    <div class="sale-order-detail-order-item-nth-4p1"></div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                <?= Loc::getMessage('SPOD_QUANTITY')?>
                                                            </div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                            <span><?=$basketItem['QUANTITY']?>&nbsp;
                                                                <?
                                                                if($basketItem['MEASURE_NAME'] <> '')
                                                                {
                                                                    echo htmlspecialcharsbx($basketItem['MEASURE_NAME']);
                                                                }
                                                                else
                                                                {
                                                                    echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
                                                                }
                                                                ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm"><?= Loc::getMessage('SPOD_ORDER_PRICE')?></div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                                <strong class="bx-price all"><?=$basketItem['FORMATED_SUM']?></strong>
                                                            </div>
                                                        </div>
												    </div>
                                                <? foreach ($arResult['ITEMS_KIT'][$key] as $basketItemKit) : ?>
                                                    <div class="sale-order-detail-order-item-tr sale-order-detail-order-basket-info sale-order-detail-order-item-tr-first">
                                                        <div class="" style="min-width: 300px;">
                                                            <div class="sale-order-detail-order-item-block">
                                                                <div class="sale-order-detail-order-item-img-block">
                                                                    <span style="color: #393939;">
                                                                        <?
                                                                        if($basketItemKit['PICTURE']['SRC'] <> '')
                                                                        {
                                                                            $imageSrc = $basketItemKit['PICTURE']['SRC'];
                                                                        }
                                                                        else
                                                                        {
                                                                            $imageSrc = $this->GetFolder().'/images/no_photo.png';
                                                                        }
                                                                        ?>
                                                                        <div class="sale-order-detail-order-item-imgcontainer"
                                                                             style="background-image: url(<?=$imageSrc?>);
                                                                                     background-image: -webkit-image-set(url(<?=$imageSrc?>) 1x,
                                                                                     url(<?=$imageSrc?>) 2x);
                                                                                     border: 0px solid #c0cfd9;">
                                                                        </div>
                                                                    </span>
                                                                </div>
                                                                <div class="sale-order-detail-order-item-content">
                                                                    <div class="sale-order-detail-order-item-title">
                                                                        <p style="color: #393939;">
                                                                            <?=htmlspecialcharsbx($basketItemKit['NAME'])?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="border-top: 0px">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                <?= Loc::getMessage('SPOD_PRICE')?>
                                                            </div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                                <strong class="bx-price"><?=$basketItemKit['BASE_PRICE_FORMATED']?></strong>
                                                            </div>
                                                        </div>
                                                        <?
                                                        if($basketItemKit["DISCOUNT_PRICE_PERCENT_FORMATED"] <> '')
                                                        {
                                                            ?>
                                                            <div
                                                                    class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="border-top: 0px">
                                                                <div
                                                                        class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                    <?= Loc::getMessage('SPOD_DISCOUNT') ?>
                                                                </div>
                                                                <div class="sale-order-detail-order-item-td-text">
                                                                    <strong
                                                                            class="bx-price"><?= $basketItemKit['DISCOUNT_PRICE_PERCENT_FORMATED'] ?></strong>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        elseif(mb_strlen($arResult["SHOW_DISCOUNT_TAB"]))
                                                        {
                                                            ?>
                                                            <div
                                                                    class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="border-top: 0px">
                                                                <div
                                                                        class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                    <?= Loc::getMessage('SPOD_DISCOUNT') ?>
                                                                </div>
                                                                <div class="sale-order-detail-order-item-td-text">
                                                                    <strong class="bx-price"></strong>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                        <div class="sale-order-detail-order-item-nth-4p1"></div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="border-top: 0px">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
                                                                <?= Loc::getMessage('SPOD_QUANTITY')?>
                                                            </div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                            <span><?=$basketItemKit['QUANTITY']?>&nbsp;
                                                                <?
                                                                if($basketItemKit['MEASURE_NAME'] <> '')
                                                                {
                                                                    echo htmlspecialcharsbx($basketItemKit['MEASURE_NAME']);
                                                                }
                                                                else
                                                                {
                                                                    echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
                                                                }
                                                                ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="border-top: 0px">
                                                            <div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm"><?= Loc::getMessage('SPOD_ORDER_PRICE')?></div>
                                                            <div class="sale-order-detail-order-item-td-text">
                                                                <strong class="bx-price all"><?=$basketItemKit['FORMATED_SUM']?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? endforeach; ?>
                                            <? endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row sale-order-detail-total-payment">
				<div class="col-md-7 col-md-offset-5 col-sm-12 col-xs-12 sale-order-detail-total-payment-container">
					<div class="row">
						<ul class="col-md-8 col-sm-6 col-xs-6 sale-order-detail-total-payment-list-left">
							<?
							if (floatval($arResult["ORDER_WEIGHT"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_TOTAL_WEIGHT')?>:
								</li>
								<?
							}

							if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED']))
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_COMMON_SUM')?>:
								</li>
								<?
							}

							if($arResult["PRICE_DELIVERY_FORMATED"] <> '')
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_DELIVERY') ?>:
								</li>
								<?
							}

							if ((float)$arResult["TAX_VALUE"] > 0)
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_TAX') ?>:
								</li>
								<?
							}
							?>
							<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_SUMMARY')?>:</li>
						</ul>
						<ul class="col-md-4 col-sm-6 col-xs-6 sale-order-detail-total-payment-list-right">
							<?
							if (floatval($arResult["ORDER_WEIGHT"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['ORDER_WEIGHT_FORMATED'] ?></li>
								<?
							}

							if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED']))
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item"><?=$arResult['PRODUCT_SUM_FORMATED']?></li>
								<?
							}

							if($arResult["PRICE_DELIVERY_FORMATED"] <> '')
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["PRICE_DELIVERY_FORMATED"] ?></li>
								<?
							}

							if ((float)$arResult["TAX_VALUE"] > 0)
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult["TAX_VALUE_FORMATED"] ?></li>
								<?
							}
							?>
							<li class="sale-order-detail-total-payment-list-right-item"><?=$arResult['PRICE_FORMATED']?></li>
						</ul>
					</div>
				</div>
			</div>
		</div><!--sale-order-detail-general-->
	</div>
<?
}
?>

