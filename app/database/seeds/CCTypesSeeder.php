<?php

class CCTypesSeeder extends Seeder {
    public function run() {
        $table = [
            "ויזה כאל",
            "ויזה לאומי",
            "ישראכרט",
            "מסטרכרט",
            "אמריקן אקספרס"
        ];

        foreach ($table as $name) {
            DB::table('cc_types')->insert([
                'name' => $name
            ]);
        }
    }
}