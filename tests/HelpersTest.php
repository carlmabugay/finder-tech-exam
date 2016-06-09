<?php

namespace FinderTests;

class HelpersTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;
    public function setUp()
    {
        $this->helper = new \Finder\Helpers();
    }

    public function testSingleMonth()
    {
        $this->assertEquals("1 month", $this->helper->months(1));
    }

    public function testMultipleMonth()
    {
        $this->assertEquals("5 months", $this->helper->months(5));
    }

    public function testInvalidMonths()
    {
        $this->assertEquals("", $this->helper->months('abds'));
    }

    public function testYesNoInvalid()
    {
        $this->assertEquals("", $this->helper->yesNo('hasd'));
    }

    public function testYesNoYes()
    {
        $this->assertEquals("Yes", $this->helper->yesNo(1));
        $this->assertEquals("Yes", $this->helper->yesNo("yes"));
    }

    public function testYesNoNo()
    {
        $this->assertEquals("No", $this->helper->yesNo(0));
        $this->assertEquals("No", $this->helper->yesNo("no"));
    }

    public function testMoneyNoDecimals()
    {
        $this->assertEquals("$10.00", $this->helper->money(10));
    }

    public function testMoneyDecimals()
    {
        $this->assertEquals("$10.50", $this->helper->money(10.5, 2));
    }

    public function testMoneyRounding()
    {
        $this->assertEquals("$10.51", $this->helper->money(10.5093, 2));
    }

    public function testDateOnlyDateNoFormat()
    {
        $this->assertEquals("2015-04-29", $this->helper->date('2015-04-29'));
    }

    public function testDateDateFormat()
    {
        $this->assertEquals("29 04 2015", $this->helper->date('2015-04-29', 'd m Y'));
    }

    public function testDateDateTimeFormat()
    {
        $this->assertEquals("14:02 29 04 2015", $this->helper->date('2015-04-29 14:02:31', 'H:i d m Y'));
    }

    // Not matched
    // public function testDateWithTimezone()
    // {
    //     $this->assertEquals("12:02 29 04 2015", $this->helper->date('2015-04-29 12:02:31', 'h:i d m Y', 'Asia/Manila'));
    // }


    public function testUnitPluralize()
    {
        $this->assertEquals("2 cars", $this->helper->pluralize(2, 'car'));
    }

    public function testPluralizeInvalid() {
        $this->assertEquals("", $this->helper->pluralize('asd', 'car'));
        $this->assertEquals("", $this->helper->pluralize('asd', 1));
        $this->assertEquals("", $this->helper->pluralize(1, 1));
    }
    
    public function testCurrencyFormatterUSD()
    {
        $this->assertEquals("$50.00", $this->helper->currency(50, 'USD'));
    }

    public function testCurrencyFormatterEUR()
    {
        $this->assertEquals("€50.00", $this->helper->currency(50, 'EUR'));
    }

    public function testCurrencyFormatterGBP()
    {
        $this->assertEquals("£50.00", $this->helper->currency(50, 'GBP'));
    }

    public function testCurrencyFormatterRounding()
    {
        $this->assertEquals("$50.64", $this->helper->currency(50.638, 'USD'));
    }
    
    public function testCurrencyFormatterFormat()
    {
        $this->assertEquals("$50,250.00", $this->helper->currency(50250, 'USD'));
    }

    public function testCurrencyInvalid()
    {
        $this->assertEquals("", $this->helper->currency('asd', 'USD'));
        $this->assertEquals("", $this->helper->currency('asd', 1));
        $this->assertEquals("", $this->helper->currency(50250, 1));
    }
    
    public function testListOneElement()
    {
        $this->assertEquals("orange", $this->helper->lists(['orange']));
    }

    public function testListTwoElements()
    {
        $this->assertEquals("orange and green", $this->helper->lists(['orange', 'green']));
    }

    public function testListSeveralElements()
    {
        $this->assertEquals("orange, red, yellow and green", $this->helper->lists(['orange', 'red', 'yellow', 'green']));
    }

    public function testListsInvalid()
    {
        $this->assertEquals("", $this->helper->lists('asd'));
    }
    
}
