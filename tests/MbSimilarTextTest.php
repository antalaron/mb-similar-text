<?php

/*
 * (c) Antal Áron <antalaron@antalaron.hu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Antalaron\MbSimilarText\Tests;

/**
 * @author Antal Áron <antalaron@antalaron.hu>
 *
 * @covers \Antalaron\MbSimilarText\MbSimilarText::<!public>
 */
class MbSimilarTextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider plainValues
     * @covers \Antalaron\MbSimilarText\MbSimilarText::mb_similar_text
     */
    public function testMbSimilarTextIsSameAsSimilarText($str1, $str2)
    {
        $this->assertEquals(similar_text($str1, $str2, $percent1), mb_similar_text($str1, $str2, $percent2));
        $this->assertEquals($percent1, $percent2, '', 0.01);
    }

    /**
     * @dataProvider exactValues
     * @covers \Antalaron\MbSimilarText\MbSimilarText::mb_similar_text
     */
    public function testMbSimilarTextWithValues($str1, $str2, $similarity, $percent)
    {
        $this->assertEquals($similarity, mb_similar_text($str1, $str2, $gotPercent));
        $this->assertEquals($percent, $gotPercent, '', 0.01);
    }

    public function plainValues()
    {
        return [
            ['test', 'test'],
            ['foo', 'bar'],
            ['PHP IS GREAT', 'WITH MYSQL'],
        ];
    }

    public function exactValues()
    {
        return [
            ['', '', 0, 0.0],
            ['test', 'test', 4, 100.0],
            ['foo', 'bar', 0, 0.0],
            ['PHP IS GREAT', 'WITH MYSQL', 3, 27.2727272727],
            ['Árvíztűrő tükörfúrógép', 'Árvíztűrő tükörfúrógép', 22, 100.0],
        ];
    }
}
