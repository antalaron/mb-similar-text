<?php

/*
 * (c) Antal Áron <antalaron@antalaron.hu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Antalaron\MbSimilarText;

/**
 * Implementation od mb_similat_text.
 *
 * @author Antal Áron <antalaron@antalaron.hu>
 */
final class MbSimilarText
{
    /**
     * Implementation of `mb_similar_text`.
     *
     * @see http://php.net/manual/en/function.similar-text.php
     * @see https://gist.github.com/soderlind/74a06f9408306cfc5de9
     *
     * @param string $str1
     * @param string $str2
     * @param float  &$percent
     *
     * @return int
     */
    public static function mb_similar_text($str1, $str2, &$percent = null)
    {
        $array1 = self::splitString($str1);
        $array2 = self::splitString($str2);

        $similarity = count($array2) - count(array_diff($array2, $array1));
        $percent = ($similarity * 200) / (mb_strlen($str1) + mb_strlen($str2));

        return $similarity;
    }

    private static function splitString($str)
    {
        preg_match_all('/./u', $str, $array);

        return $array[0];
    }
}
