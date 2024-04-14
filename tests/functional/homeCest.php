<?php


namespace Functional;

use \FunctionalTester;

class homeCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Escrow');
    }
}
