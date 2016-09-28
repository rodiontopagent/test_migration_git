<?php

class CurrencySeeder extends Seeder {
    public function run() {
        $table = [
            '0' => ['Dollar', 'דולר', 'USD', '3.94', '$'],
            '1' => ['GBP', 'לירה שטרלינג', 'GBP', '5.56', '&pound;'],
            '2' => ['Euro', 'יורו', 'EUR', '4.38', '&euro;'],
            '3' => ['Shekel', 'שקל', 'ILS', '1.00', '&#8362;']
        ];

        foreach ($table as $currency) {
            DB::table('currency')->insert([
                'name' => $currency['0'],
                'name_heb' => $currency['1'],
                'code' => $currency['2'],
                'rate' => $currency['3'],
                'symbol' => $currency['4']
            ]);
        }

    }

}