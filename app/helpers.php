<?php

function formatCurrency($number)
{
    return number_format($number, 2, ',', ' ');
}
