<?php
function saveImage($fieldName)
{
    global $imagePath;
    $path = $_FILES["$fieldName"]['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $img = $imagePath . uniqid().".".$ext;

    move_uploaded_file($_FILES["$fieldName"]['tmp_name'], $img);
    return $img;
}

//generate selected text by reference
function getSelectedText(&$variable, $textToCheck)
{
    if (isset($variable) && $variable == $textToCheck)
        return "selected";
    return "";
}

function getDisabledTextArray(&$variable, $arrayToCheck)
{
    for($i=0;$i<count($arrayToCheck);$i++){
        if($variable==$arrayToCheck[$i])
            return true;
    }
    return false;
}
function getSelectedTextBoolean(&$variable, $textToCheck)
{
    if (isset($variable) && $variable == $textToCheck)
        return "true";
    return "";
}
function dateToStr($datestr):string{
    $date = new DateTime($datestr);
    return $date->format('d/m/Y');
}
function datetimeToStr($datestr):string{
    $date = new DateTime($datestr);
    return $date->format('d/m/Y H:i:s');
}
?>
