<?php

namespace tubalmartin\CssMin\Tests;

use tubalmartin\CssMin\Minifier;
use PHPUnit_Framework_TestCase;

class MinifierTest extends PHPUnit_Framework_TestCase
{
    protected $cssmin;

    protected function setUp()
    {
        $this->cssmin = new Minifier;
        $this->cssmin->setChunkLength(rand(100, 200));
    }

    protected function getExpectation($name)
    {
        return file_get_contents(__DIR__ .'/expectations/'. $name .'.css');
    }

    protected function getFixture($name)
    {
        return file_get_contents(__DIR__ .'/fixtures/'. $name .'.css');
    }

    protected function execTest($expectationName, $fixtureName = null, $linebreakPos = null, $keepSourceMap = null)
    {
        $fixtureName = is_null($fixtureName) ? $expectationName : $fixtureName;

        $this->assertEquals(
            $this->getExpectation($expectationName),
            $this->cssmin->run($this->getFixture($fixtureName), $linebreakPos, $keepSourceMap)
        );
    }

    public function testAtRules()
    {
        $this->execTest('at-rules');
    }

    public function testAttributeSelectors()
    {
        $this->execTest('attribute-selectors');
    }

    public function testBackgroundProperty()
    {
        $this->execTest('background');
    }

    public function testBackgroundPositionProperty()
    {
        $this->execTest('background-position');
    }

    public function testBorderProperty()
    {
        $this->execTest('border');
    }

    public function testCalcFunction()
    {
        $this->execTest('calc');
    }

    public function testColors()
    {
        $this->execTest('colors');
    }

    public function testComments()
    {
        $this->execTest('comments');
    }

    public function testDataUrlBase64DoubleQuotes()
    {
        $this->execTest('dataurl-base64-doublequotes');
    }

    public function testDataUrlBase64Eof()
    {
        $this->execTest('dataurl-base64-eof');
    }

    public function testDataUrlBase64LineBreakInData()
    {
        $this->execTest('dataurl-base64-linebreakindata');
    }

    public function testDataUrlBase64NoQuotes()
    {
        $this->execTest('dataurl-base64-noquotes');
    }

    public function testDataUrlBase64SingleQuotes()
    {
        $this->execTest('dataurl-base64-singlequotes');
    }

    public function testDataUrlBase64TwoUrls()
    {
        $this->execTest('dataurl-base64-twourls');
    }

    public function testDataUrlDbQuoteFont()
    {
        $this->execTest('dataurl-dbquote-font');
    }

    public function testDataUrlInlineSvg()
    {
        $this->execTest('dataurl-inline-svg');
    }

    public function testDataUrlNonBase64DoubleQuotes()
    {
        $this->execTest('dataurl-nonbase64-doublequotes');
    }

    public function testDataUrlNonBase64NoQuotes()
    {
        $this->execTest('dataurl-nonbase64-noquotes');
    }

    public function testDataUrlNonBase64SingleQuotes()
    {
        $this->execTest('dataurl-nonbase64-singlequotes');
    }

    public function testDataUrlNoQuoteMultilineFont()
    {
        $this->execTest('dataurl-noquote-multiline-font');
    }

    public function testDataUrlRealDataDoubleQuotes()
    {
        $this->execTest('dataurl-realdata-doublequotes');
    }

    public function testDataUrlRealDataNoQuotes()
    {
        $this->execTest('dataurl-realdata-noquotes');
    }

    public function testDataUrlRealDataSingleQuotes()
    {
        $this->execTest('dataurl-realdata-singlequotes');
    }

    public function testDataUrlRealDataYuiApp()
    {
        $this->execTest('dataurl-realdata-yuiapp');
    }

    public function testDataUrlSingleQuoteFont()
    {
        $this->execTest('dataurl-singlequote-font');
    }

    public function testEmptyRules()
    {
        $this->execTest('empty-rules');
    }

    public function testFlexProperty()
    {
        $this->execTest('flex');
    }

    public function testFontWeightProperty()
    {
        $this->execTest('font-weight');
    }

    public function testImportantRule()
    {
        $this->execTest('important');
    }

    public function testKeepSourcemapCommentArgument()
    {
        $this->cssmin->keepSourceMap(false);
        $this->execTest('sourcemap-preserve', 'sourcemap', null, true);
    }

    public function testKeepSourcemapCommentSetter()
    {
        $this->cssmin->keepSourceMap();
        $this->execTest('sourcemap-preserve', 'sourcemap');
    }

    public function testLinebreakPositionArgument()
    {
        $this->cssmin->setLineBreakPosition(30);
        $this->execTest('linebreak-position', null, 10);
    }

    public function testLinebreakPositionSetter()
    {
        $this->cssmin->setLineBreakPosition(10);
        $this->execTest('linebreak-position');
    }

    public function testLinebreakPositionDoubleNewline()
    {
        $this->cssmin->setLineBreakPosition(1);
        $this->cssmin->keepSourceMap();
        $this->execTest('sourcemap-preserve', 'sourcemap');
    }

    public function testLowercasing()
    {
        $this->execTest('lowercasing');
    }

    public function testNestedAtRules()
    {
        $this->execTest('nested-at-rules');
    }

    public function testNumbers()
    {
        $this->execTest('numbers');
    }

    public function testOldIeFilters()
    {
        $this->execTest('old-ie-filters');
    }

    public function testPreserveCase()
    {
        $this->execTest('preserve-case');
    }

    public function testPseudoClasses()
    {
        $this->execTest('pseudo-classes');
    }

    public function testPseudoElements()
    {
        $this->execTest('pseudo-elements');
    }

    public function testRemoveSourcemapComment()
    {
        $this->execTest('sourcemap-remove', 'sourcemap');
    }

    public function testSemicolons()
    {
        $this->execTest('semicolons');
    }

    public function testShortenableProperties()
    {
        $this->execTest('shortenable-properties');
    }

    public function testStarUnderscoreHacks()
    {
        $this->execTest('star-underscore-hacks');
    }

    public function testStrings()
    {
        $this->execTest('strings');
    }

    public function testTextShadowProperty()
    {
        $this->execTest('text-shadow');
    }

    public function testUnitMs()
    {
        $this->execTest('unit-ms');
    }

    public function testWebkitTransformOrigin()
    {
        $this->execTest('webkit-transform-origin');
    }

    // Frameworks

    public function testBootstrap()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('bootstrap');
    }

    public function testBulma()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('bulma');
    }

    public function testFoundation()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('foundation');
    }

    public function testKube()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('kube');
    }

    public function testMaterialize()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('materialize');
    }

    public function testMui()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('mui');
    }

    public function testPure()
    {
        $this->cssmin->setChunkLength(rand(3000, 6000));
        $this->execTest('pure');
    }

}
