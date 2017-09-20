<?php

/*
 * (c) Antal Áron <antalaron@antalaron.hu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Antalaron\MbSimilarText;

/**
 * Implementation of `mb_similar_text()`.
 *
 * @author Antal Áron <antalaron@antalaron.hu>
 */
final class MbSimilarText
{
    /**
     * Implementation of `mb_similar_text()`.
     *
     * @see http://php.net/manual/en/function.similar-text.php
     * @see http://locutus.io/php/strings/similar_text/
     *
     * @param string $str1
     * @param string $str2
     * @param float  &$percent
     *
     * @return int
     */
    public static function mb_similar_text($str1, $str2, &$percent = null)
    {
        if (0 === mb_strlen($str1) + mb_strlen($str2)) {
            $percent = 0.0;

            return 0;
        }

        $pos1 = $pos2 = $max = 0;
        $l1 = mb_strlen($str1);
        $l2 = mb_strlen($str2);

        for ($p = 0; $p < $l1; ++$p) {
            for ($q = 0; $q < $l2; ++$q) {
                for ($l = 0; ($p + $l < $l1) && ($q + $l < $l2) && mb_substr($str1, $p + $l, 1) === mb_substr($str2, $q + $l, 1); ++$l) {
                    // nothing to do
                }
                if ($l > $max) {
                    $max = $l;
                    $pos1 = $p;
                    $pos2 = $q;
                }
            }
        }

        $similarity = $max;
        if ($similarity) {
            if ($pos1 && $pos2) {
                $similarity += self::mb_similar_text(mb_substr($str1, 0, $pos1), mb_substr($str2, 0, $pos2));
            }
            if (($pos1 + $max < $l1) && ($pos2 + $max < $l2)) {
                $similarity += self::mb_similar_text(
                    mb_substr($str1, $pos1 + $max, $l1 - $pos1 - $max),
                    mb_substr($str2, $pos2 + $max, $l2 - $pos2 - $max)
                );
            }
        }

        $percent = ($similarity * 200.0) / ($l1 + $l2);

        return $similarity;
    }
}
