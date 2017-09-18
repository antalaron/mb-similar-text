<?php

/*
 * (c) Antal Áron <antalaron@antalaron.hu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Antalaron\MbSimilarText\MbSimilarText as p;

if (!function_exists('mb_similar_text')) {
    function mb_similar_text($str1, $str2, &$percent = null)
    {
        return p::mb_similar_text($str1, $str2, $percent);
    }
}
