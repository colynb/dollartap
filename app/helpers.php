<?php

function to_pennies($value)
{
    return intval(floatval(preg_replace("/[^0-9.]/", "", $value)) * 100);
}
