<?php

class DeliveryCalculator
{
    public static function calc($total)
    {
        if ($total >= 90) {
            return 0;
        }

        if ($total >= 50) {
            return 2.95;
        }

        return 4.95;
    }
}
