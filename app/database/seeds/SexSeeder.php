<?php

class SexSeeder extends Seeder {
    public function run() {
        $table = [
            '0' => ['Male', 'זכר', 'M'],
            '1' => ['Female', 'נקבה', 'F']
        ];

        foreach ($table as $sex) {
            DB::table('sex')->insert([
                'name' => $sex[0],
                'name_heb' => $sex[1],
                'code' => $sex[2]
            ]);
        }

    }

}