<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CurrencyService;

class CurrencyTest extends TestCase
{
	private $currencySrvices;

	public function __construct()
	{
		parent::__construct();
		$this->currencySrvices = new CurrencyService;
	}

    public function test_currency_btd_to_rupe()
    {
    	$bdt = 100;
    	$this->assertEquals(87.0, $this->currencySrvices->convert($bdt, 'bdt', 'rupe'));
    }


    public function test_currency_btd_to_ero()
    {
    	$bdt = 10000;
    	$this->assertEquals(97.0, $this->currencySrvices->convert($bdt, 'bdt', 'eru'));
    }


    public function test_currency_btd_to_usd()
    {
    	$bdt = 100;
    	$this->assertEquals(1.2, $this->currencySrvices->convert($bdt, 'bdt', 'usd'));
    }
}
