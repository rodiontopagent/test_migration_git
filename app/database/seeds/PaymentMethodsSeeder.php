<?php

class PaymentMethodsSeeder extends Seeder {
    public function run() {
        $table = [
            "אשראי",
            "אשראי חול",
            "המחאה",
            "הפקדה",
            "מזומן",
            "העברה",
            "אשראי קרדיט"
        ];

        foreach ($table as $method) {
            DB::table('payment_methods')->insert([
                'name' => $method
            ]);
        }
    }
}