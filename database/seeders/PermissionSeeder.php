<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Table;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $table = Table::create([
            'name' => 'admins',
            'display_name' => 'Admins',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'admins-index',
            'display_name' => 'All Admins',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'admins-logs',
            'display_name' => 'Admins Logs',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'admins-create',
            'display_name' => 'Admins Create',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'admins-update',
            'display_name' => 'Admins Update',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'admins-delete',
            'display_name' => 'Admins Delete',
        ]);

        ///////////////////// Data Entry ////////////////////////////////////
        $table = Table::create([
            'name' => 'data_entries',
            'display_name' => 'Data Entries',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'data_entries-index',
            'display_name' => 'All Data Entry',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'data_entries-create',
            'display_name' => 'Create Data Entry',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'data_entries-update',
            'display_name' => 'Update Data Entry',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'data_entries-delete',
            'display_name' => 'Delete Data Entry',
        ]);

        ///////////////////// Specializations ////////////////////////////////////
        $table = Table::create([
            'name' => 'specializations',
            'display_name' => 'Specializations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'specializations-index',
            'display_name' => 'All Specializations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'specializations-create',
            'display_name' => 'Create Specializations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'specializations-update',
            'display_name' => 'Update Specializations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'specializations-delete',
            'display_name' => 'Delete Specializations',
        ]);

        ///////////////////// Branches ////////////////////////////////////
        $table = Table::create([
            'name' => 'branches',
            'display_name' => 'Branches',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'branches-index',
            'display_name' => 'All Branches',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'branches-create',
            'display_name' => 'Create Branches',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'branches-update',
            'display_name' => 'Update Branches',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'branches-delete',
            'display_name' => 'Delete Branches',
        ]);

        ///////////////////// doctors ////////////////////////////////////
        $table = Table::create([
            'name' => 'doctors',
            'display_name' => 'Doctors',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'doctors-index',
            'display_name' => 'All Doctors',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'doctors-view',
            'display_name' => 'Doctors Details',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'doctors-create',
            'display_name' => 'Create Doctors',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'doctors-update',
            'display_name' => 'Update Doctors',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'doctors-delete',
            'display_name' => 'Delete Doctors',
        ]);

        ///////////////////// Customers ////////////////////////////////////
        $table = Table::create([
            'name' => 'customers',
            'display_name' => 'Customers',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'customers-index',
            'display_name' => 'All Customers',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'customers-view',
            'display_name' => 'Customers Details',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'customers-create',
            'display_name' => 'Create Customers',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'customers-update',
            'display_name' => 'Update Customers',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'customers-delete',
            'display_name' => 'Delete Customers',
        ]);

        ///////////////////// Cases ////////////////////////////////////
        $table = Table::create([
            'name' => 'cases',
            'display_name' => 'Cases',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'cases-index',
            'display_name' => 'All Cases',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'cases-view',
            'display_name' => 'Cases Details',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'cases-create',
            'display_name' => 'Create Cases',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'cases-update',
            'display_name' => 'Update Cases',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'cases-delete',
            'display_name' => 'Delete Cases',
        ]);

        ///////////////////// Reservations ////////////////////////////////////
        $table = Table::create([
            'name' => 'reservations',
            'display_name' => 'Reservations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'reservations-index',
            'display_name' => 'All Reservations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'reservations-create',
            'display_name' => 'Create Reservations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'reservations-update',
            'display_name' => 'Update Reservations',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'reservations-delete',
            'display_name' => 'Delete Reservations',
        ]);

        ///////////////////// Insurance Companies ////////////////////////////////////
        $table = Table::create([
            'name' => 'insurance_companies',
            'display_name' => 'Insurance Companies',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'insurance_companies-index',
            'display_name' => 'All Insurance Companies',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'insurance_companies-financials',
            'display_name' => 'Insurance Companies Financials',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'insurance_companies-create',
            'display_name' => 'Create Insurance Companies',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'insurance_companies-update',
            'display_name' => 'Update Insurance Companies',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'insurance_companies-delete',
            'display_name' => 'Delete Insurance Companies',
        ]);

        ///////////////////// Expenses ////////////////////////////////////
        $table = Table::create([
            'name' => 'expenses',
            'display_name' => 'Expenses',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'expenses-index',
            'display_name' => 'All Expenses',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'expenses_types-index',
            'display_name' => 'Expenses Types',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'expenses-create',
            'display_name' => 'Create Expenses',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'expenses-update',
            'display_name' => 'Update Expenses',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'expenses-delete',
            'display_name' => 'Delete Expenses',
        ]);

        ///////////////////// Debts ////////////////////////////////////
        $table = Table::create([
            'name' => 'debts',
            'display_name' => 'Debts',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'debts-index',
            'display_name' => 'All Debts',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'debts-create',
            'display_name' => 'Add New Debt',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'debts-collection',
            'display_name' => 'Debts Collection',
        ]);

        ///////////////////// Reports ////////////////////////////////////
        $table = Table::create([
            'name' => 'reports',
            'display_name' => 'Reports',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'reports-index',
            'display_name' => 'All Reports',
        ]);

        ///////////////////// Payment Methods ////////////////////////////////////
        $table = Table::create([
            'name' => 'payment_methods',
            'display_name' => 'Payment Methods',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'payment_methods-index',
            'display_name' => 'All Payment Methods',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'payment_methods-create',
            'display_name' => 'Create Payment Methods',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'payment_methods-update',
            'display_name' => 'Update Payment Methods',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'payment_methods-financials',
            'display_name' => 'Payment Methods Financials',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'payment_methods-transfer',
            'display_name' => 'Payment Methods Transfer',
        ]);

        ///////////////////// Packages ////////////////////////////////////
        $table = Table::create([
            'name' => 'packages',
            'display_name' => 'Packages',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'packages-index',
            'display_name' => 'All Packages',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'packages-create',
            'display_name' => 'Create Packages',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'packages-update',
            'display_name' => 'Update Packages',
        ]);
        Permission::create([
            'table_id' => $table->id,
            'name' => 'packages-delete',
            'display_name' => 'Delete Packages',
        ]);
    }
}
