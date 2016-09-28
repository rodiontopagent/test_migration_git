<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('CCTransationErrorsSeeder');
        $this->call('CCTypesSeeder');
        $this->call('CurrencySeeder');
        $this->call('FlightDirectionsSeeder');
        $this->call('FlightStatusesSeeder');
        $this->call('NationalitySeeder');
        $this->call('OrderStatusesSeeder');
        $this->call('PaymentMethodsSeeder');
        $this->call('PermissionsSeeder');
        $this->call('SexSeeder');
	}

}


