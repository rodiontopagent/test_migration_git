<?php

class OrderStatusesSeeder extends Seeder {
    public function run() {
        $table = [
            "פתוחה",
            "סגורה",
            "בעייתית"
        ];

        foreach ($table as $status) {
            DB::table('order_statuses')->insert([
                'status_name' => $status
            ]);
        }
    }
}