<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";
$strReturn = '';

$strReturn .= '<ul class="bx-breadcrumb b-breadcrumbs__list">';
$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++)
{
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if ($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
    {
        $strReturn .= '
        <li class="b-breadcrumbs__item">
        <a class="b-breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" title="Главная">
        '.$title.'
        </a>
        </li>
        ';
    } else {
        $strReturn .= '
        <li class="b-breadcrumbs__item">
        <span class="b-breadcrumbs__link">
        '.$title.'
        </span>
        </li>
        ';
    }
}
return $strReturn;
