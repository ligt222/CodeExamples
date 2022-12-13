<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

CModule::IncludeModule('iblock');

class CreatingPicture
{
    private $idProduct; // id Продукта
    private $codeProduct; // Код товара
    private $codeExec; // Код Варианта исполнения
    private $codeColor; // Код Цвета
    private $codeGlazing; // Код Остекления
    private $arrIdKit = [];

    public function __construct($id)
    {

        $resSku = CIBlockElement::GetList(
            [],
            ['IBLOCK_CODE' => 'offers', 'ID' => $id],
            false,
            false,
            []
        );

        if ($obSku = $resSku->GetNextElement()) {
            $arProp = $obSku->GetProperties();
            $this->arrIdKit = $arProp['KIT']['VALUE'];
            $this->idProduct = $arProp['CML2_LINK']['VALUE'];
            $this->codeExec = $arProp['EXECUTIONS']['VALUE'];
            $this->codeColor = $arProp['COLOR_REF']['VALUE'];
            $this->codeGlazing = $arProp['GLAZING']['VALUE'];
        }

        if ($this->idProduct) {
            $resProduct = CIBlockElement::GetList(
                ['LEFT_MARGIN' => 'ASC'],
                [
                    'IBLOCK_CODE' => 'catalog',
                    'ID' => $this->idProduct
                ],
                false, false,
                ['ID', 'CODE']
            );

            if ($arProduct = $resProduct->Fetch()) {
                $this->codeProduct = $arProduct['CODE'];
            }
        }


    }

    private function searchExec()
    {

        $arSectExecId = [];

        $resSectExec = CIBlockSection::GetList(
            ['SECTION_ID' => 'DESC'], ['IBLOCK_CODE' => 'sets_images', 'CODE' => $this->codeExec], false, ['ID']);

        while ($arSectExec = $resSectExec->Fetch()) {
            $arSectExecId[] = $arSectExec['ID'];
        }

        return $arSectExecId;

    }

    private function searchModel()
    {

        $arSectProdId = [];

        $resSectProd = CIBlockSection::GetList(
            ['SECTION_ID' => 'DESC'],
            ['IBLOCK_CODE' => 'sets_images', 'CODE' => $this->codeProduct, 'SECTION_ID' => $this->searchExec()],
            false,
            ['ID']
        );

        while ($arSectProd = $resSectProd->Fetch()) {
            $arSectProdId[] = $arSectProd['ID'];
        }

        return $arSectProdId;

    }

    public function getArrSrcImg($kitId = 0)
    {
        $arImgSrc = [];

        if ($kitId == 0) {
            $arPropKit = [
                'IBLOCK_CODE' => 'sets_images',
                //'IBLOCK_SECTION_ID' => $this->searchModel(),
                'PROPERTY_COLOR' => $this->codeColor,
                '>PROPERTY_KIT' => 0
            ];
        } else {
            $arPropKit = [
                'IBLOCK_CODE' => 'sets_images',
                //'IBLOCK_SECTION_ID' => $this->searchModel(),
                'PROPERTY_COLOR' => $this->codeColor,
                'PROPERTY_KIT' => $kitId,
            ];
        }

        $resImgKit = CIBlockElement::GetList(
            ['PROPERTY_KIT_VALUE' => 'ASC'],
            $arPropKit,
            false,
            false,
            ['PREVIEW_PICTURE', 'PROPERTY_DECORATION', 'PROPERTY_KIT']
        );
        $resImgEl = CIBlockElement::GetList(
            ['IBLOCK_SECTION_ID' => 'DESC'],
            [
                'IBLOCK_CODE' => 'sets_images',
                'IBLOCK_SECTION_ID' => $this->searchModel(),
                [
                    'LOGIC' => 'OR',
                    'PROPERTY_COLOR' => $this->codeColor,
                    'PROPERTY_GLAZING' => $this->codeGlazing,
                ],
                'PROPERTY_DECORATION' => null
            ],
            false,
            false,
            ['ID', 'IBLOCK_SECTION_ID', 'PREVIEW_PICTURE', 'PROPERTY_ACCESSORIES', 'PROPERTY_GLAZING', 'PROPERTY_DECORATION', 'PROPERTY_KIT']
        );
        while ($arImgKit = $resImgKit->Fetch()) {
            $arKit[] = CFile::GetPath($arImgKit['PREVIEW_PICTURE']);

        }
        while ($arImgEl = $resImgEl->Fetch()) {

            $codeType = '';
            $resParentSect = CIBlockSection::GetNavChain(false, $arImgEl['IBLOCK_SECTION_ID'], array('ID', 'CODE'));

            if ($arParentSect = $resParentSect->Fetch()) {
                $codeType = $arParentSect['CODE'];
            }
            if ($arImgEl['PREVIEW_PICTURE'] && !$arImgEl['PROPERTY_GLAZING_VALUE'] && !$arImgEl['PROPERTY_DECORATION_VALUE']) {

                if ($codeType == 'polotna') {

                    $arImgSrc['polotna'] = CFile::GetPath($arImgEl['PREVIEW_PICTURE']);

                }
            }

            if ($codeType == 'nalichnik' && count($arKit) > 1) {

                $arImgSrc['nalichnik'] = $arKit[0];

            }
            if ($arImgEl['PROPERTY_GLAZING_VALUE']) {

                if ($codeType == 'osteklenie') {

                    $arImgSrc['glazing'] = CFile::GetPath($arImgEl['PREVIEW_PICTURE']);

                }

            }
            if ($arImgEl['PROPERTY_ACCESSORIES_VALUE']) {

                $arImgSrc['accessories'] = CFile::GetPath($arImgEl['PROPERTY_ACCESSORIES_VALUE']);

            }

        }

        if (count($arKit) <= 1) {
            $arImgSrc['kit'] = $arKit[0];
        } else {
            $arImgSrc['kit'] = $arKit[0];
        }

        return $arImgSrc;

    }


}
