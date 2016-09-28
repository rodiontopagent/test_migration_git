<?php

class NationalitySeeder extends Seeder {
    public function run() {
        $table = [
            "1" => ["Israel", "ישראל", "ISR"],
            "2" => ["Argentina", "ארגנטינה"],
            "3" => ["Australia", "אוסטרליה"],
            "4" => ["Austria", "אוסטריה"],
            "5" => ["Belgium", "בלגיה"],
            "6" => ["Brazil", "ברזיל"],
            "7" => ["Bulgaira", "בולגריה"],
            "8" => ["Canada", "קנדה"],
            "9" => ["Canary Islands", "האיים הקנריים"],
            "10" => ["Chile", "צ'ילי"],
            "11" => ["China", "סין"],
            "12" => ["Cyprus", "קפריסין"],
            "13" => ["CZECH REPUBLIC", "צכיה"],
            "14" => ["Denmark", "דנמרק"],
            "15" => ["Egypt", "מצרים"],
            "16" => ["Finland", "פינלנד"],
            "17" => ["France", "צרפת"],
            "18" => ["Germany", "גרמניה"],
            "19" => ["Greece", "יוון"],
            "20" => ["Hong Kong", "הונג קונג"],
            "21" => ["Hungary", "הונגריה"],
            "22" => ["India", "הודו"],
            "23" => ["Ireland", "אירלנד"],
            "24" => ["Italy", "איטליה"],
            "25" => ["Japan", "יפן"],
            "26" => ["Jeguslavia", "יוגוסלביה"],
            "27" => ["Jordan", "ירדן"],
            "28" => ["Kenya", "קניה"],
            "29" => ["Korea Rep. of", "קוריאה"],
            "30" => ["Lichtenstein", "ליכטנשטיין"],
            "31" => ["Luxembourg", "לוקסמבורג"],
            "32" => ["Macedonia", "מקדוניה"],
            "33" => ["MALAYSIA", "מלזיה"],
            "34" => ["Mexico", "מקסיקו"],
            "35" => ["MONACO", "מונקו"],
            "36" => ["Netherlands", "הולנד"],
            "37" => ["New Zealand", "ניו זילנד"],
            "38" => ["PALESTINIAN TERRITORY", "הרשות הפלסטינית"],
            "39" => ["Philippines", "פיליפינים"],
            "40" => ["Poland", "פולין"],
            "41" => ["Portugal", "פורטוגל"],
            "42" => ["Puerto Rico", "פורטו רוקו"],
            "43" => ["Rumania", "רומניה"],
            "44" => ["Russia", "רוסיה"],
            "45" => ["SENEGAL", "סנגל"],
            "46" => ["Singapore", "סינגפור"],
            "47" => ["SLOVAKIA", "סלובקיה"],
            "48" => ["South Africa", "דרום אפריקה"],
            "49" => ["Spain", "ספרד"],
            "50" => ["Sweden", "שוודיה"],
            "51" => ["Switzerland", "שוויץ"],
            "52" => ["TANZANIA", "טנזניה"],
            "53" => ["Thailand", "תאילנד"],
            "54" => ["Turkey", "טוקיה"],
            "55" => ["U.S.A.", "ארה\"ב"],
            "56" => ["Uganda", "אוגנדה"],
            "57" => ["Ukraine", "אוקרינה"],
            "58" => ["United Kingdom", "בריטניה"],
            "59" => ["Venezuela", "ונצואלה"],
            "60" => ["Morocco", "מרוקו"],
        ];

        foreach ($table as $nationality) {
            DB::table('nationality')->insert([
                'name' => $nationality['0'],
                'name_heb' => $nationality['1'],
                'code' => (isset($nationality['2'])) ? $nationality['2'] : DB::raw('NULL')
            ]);
        }
    }
}