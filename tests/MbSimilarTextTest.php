<?php

namespace Antalaron\MbSimilarText\Tests;

/**
 * @author Antal Áron <antalaron@antalaron.hu>
 *
 * @covers Antalaron\MbSimilarText\MbSimilarText::<!public>
 */
class MbSimilarTextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Antalaron\MbSimilarText\MbSimilarText::mb_similar_text
     */
    public function testMbSimilarText()
    {
        $this->assertSame(2, mb_similar_text('az', 'az'));
        $this->assertSame(9, mb_similar_text('Árvíztűrő', 'Árvíztűrő'));
        // $this->assertSame(similar_text('arviztuor', 'arvizturo'), mb_similar_text('arviztuor', 'arvizturo'));
        similar_text('arviztuor', 'arvizturo', $percent);
        $this->assertSame(800/9, $percent);
    }
}
