<?php
namespace App\Services;

class CurrencyService{
	const RATE = [
		'bdt' => [
			'usd' => '0.012',
			'eru' => '0.0097',
			'rupe' => '0.87',
		]
	];


	public function convert($amount, $from, $to)
	{
		$rate = 0;

		if(self::RATE[$from]){
			$rate = self::RATE[$from][$to] ?? 0;
		}

		return round($amount * $rate, 2);
	}

}