<?php
use Appizy\WebApp\OpenFormulaParser;

/**
 * Created by PhpStorm.
 * User: nicolashefti
 * Date: 06/07/2016
 * Time: 18:46
 */
class OpenFormulaParserTest extends PHPUnit_Framework_TestCase
{

    public function testFormulaWithLegacyFunction()
    {
        $formula = OpenFormulaParser::parse('of:=LEGACY.FINV(0.05;-1)', 0, ['test'], [0, 0, 0]);
        $this->assertEquals($formula->getElements(), [
            'Formula.FINV',
            '(',
            '0.05',
            ',',
            '-',
            '1',
            ')'
        ]);
    }

    public function testThrowErrorForUnknownTokenFunction()
    {
        $formula = OpenFormulaParser::parse('of:=YOLO(4,5,"WEIRD FUNCTION SIGNATURE?")', 0, ['test'], [0, 0, 0]);
        $this->assertEquals($formula->getElements(), []);
    }

    public function testThrowErrorForPowerTokenFunction()
    {
        $formula = OpenFormulaParser::parse('of:=2^3', 0, ['test'], [0, 0, 0]);
        $this->assertEquals($formula->getElements(), []);
    }
}
