<?php

class FlightStatusesSeeder extends Seeder {
    public function run() {
        $table = [
            "ממתין לכרטוס",
            "נשלח לכרטוס",
            "התקבל",
            "ריפנד",
            "שינוי טיסה"
        ];

        foreach ($table as $name) {
            DB::table('flight_statuses')->insert([
                'status_name' => $name
            ]);
        }
    }
}