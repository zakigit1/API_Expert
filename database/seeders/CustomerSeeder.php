<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedCustomers(3);
        $this->seedCustomers(5, 3);
        $this->seedCustomers(7, 5);
        $this->seedCustomers(10, 10);
        
    }

    private function seedCustomers(int $customerNumber, int $invoiceNumber = 0): void
    {
        if($invoiceNumber == 0) {
            Customer::factory()
                ->count($customerNumber)
                ->create();
        } else {
            Customer::factory()
                ->count($customerNumber)
                ->hasInvoices($invoiceNumber) // Create X invoices for each customer
                ->create();
        }
        
        // Customer::factory()
        // ->count($customerNumber)
        // ->hasInvoices($invoiceNumber) // Create X invoices for each customer
        // ->create();
    }
}
