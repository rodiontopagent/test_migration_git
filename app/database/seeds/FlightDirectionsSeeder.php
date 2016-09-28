<?php

class FlightDirectionsSeeder extends Seeder {
    public function run() {
        $table = [
            "הלוך",
            "חזור",
            "ביניים"
        ];

        foreach ($table as $direction) {
            DB::table('flight_directions')->insert([
                'direction' => $direction
            ]);
        }
    }
}