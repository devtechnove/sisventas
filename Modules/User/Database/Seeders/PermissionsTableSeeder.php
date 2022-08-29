<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
     private $permissions_admin , $user_permissions, $vendedor_permissions, $encargado_permissions,$super_admin_permissions;

    /**
     * Run the database seeds.
     *
     * @return void
     */

      public function __construct()
    {
      /*
        set the default permissions
        */
        $this->super_admin_permissions =  [
                                 //User Mangement
                                'edit_own_profile',
                                'access_user_management',
                                //Dashboard
                                'show_total_stats',
                                'show_month_overview',
                                'show_weekly_sales_purchases',
                                'show_monthly_cashflow',
                                'show_notifications',
                                //Accounts
                                'access_accounts',
                                'create_accounts',
                                'show_accounts',
                                'edit_accounts',
                                'delete_accounts',
                                //Products
                                'access_products',
                                'create_products',
                                'show_products',
                                'edit_products',
                                'delete_products',
                                //Product Categories
                                'access_product_categories',
                                //Barcode Printing
                                'print_barcodes',
                                //Adjustments
                                'access_adjustments',
                                'create_adjustments',
                                'show_adjustments',
                                'edit_adjustments',
                                'delete_adjustments',
                                //Quotaions
                                'access_quotations',
                                'create_quotations',
                                'show_quotations',
                                'edit_quotations',
                                'delete_quotations',
                                //Create Sale From Quotation
                                'create_quotation_sales',
                                //Send Quotation On Email
                                'send_quotation_mails',
                                //Expenses
                                'access_expenses',
                                'create_expenses',
                                'edit_expenses',
                                'delete_expenses',
                                //Expense Categories
                                'access_expense_categories',
                                //Customers
                                'access_customers',
                                'create_customers',
                                'show_customers',
                                'edit_customers',
                                'delete_customers',
                                //Suppliers
                                'access_suppliers',
                                'create_suppliers',
                                'show_suppliers',
                                'edit_suppliers',
                                'delete_suppliers',
                                //Sales
                                'access_sales',
                                'create_sales',
                                'show_sales',
                                'edit_sales',
                                'delete_sales',
                                //POS Sale
                                'create_pos_sales',
                                //Sale Payments
                                'access_sale_payments',
                                //Sale Returns
                                'access_sale_returns',
                                'create_sale_returns',
                                'show_sale_returns',
                                'edit_sale_returns',
                                'delete_sale_returns',
                                //Sale Return Payments
                                'access_sale_return_payments',
                                //Purchases
                                'access_purchases',
                                'create_purchases',
                                'show_purchases',
                                'edit_purchases',
                                'delete_purchases',
                                //Purchase Payments
                                'access_purchase_payments',
                                //Purchase Returns
                                'access_purchase_returns',
                                'create_purchase_returns',
                                'show_purchase_returns',
                                'edit_purchase_returns',
                                'delete_purchase_returns',
                                //Purchase Return Payments
                                'access_purchase_return_payments',
                                //Reports
                                'access_reports',
                                //Currencies
                                'access_currencies',
                                'create_currencies',
                                'edit_currencies',
                                'delete_currencies',
                                //Settings
                                'access_settings',

                                //Caja
                                'access_caja',
                                'create_caja',
                                'edit_caja',
                                'delete_caja',

                                 //Personal
                                'access_personal',
                                'create_personal',
                                'show_personal',
                                'edit_personal',
                                'delete_personal',

                                 //Tarea
                                 'access_tarea',
                                 'create_tarea',
                                 'show_tarea',
                                 'edit_tarea',
                                 'delete_tarea',

                                   /* Empresas */
                                'acceso_empresa',
                                'Ver Empresa',
                                'Registrar Empresa',
                                'Editar Empresa',
                                'Eliminar Empresa',


                                /* Planes */
                                'acceso_planes',
                                'Ver Planes',
                                'Registrar Planes',
                                'Editar Planes',
                                'Eliminar Planes',




                              ];




        $this->permissions_admin =  [


//User Mangement
                                'edit_own_profile',
                                'access_user_management',
                                //Dashboard
                                'show_total_stats',
                                'show_month_overview',
                                'show_weekly_sales_purchases',
                                'show_monthly_cashflow',
                                'show_notifications',
                                //Products
                                'access_products',
                                'create_products',
                                'show_products',
                                'edit_products',
                                'delete_products',
                                //Product Categories
                                'access_product_categories',
                                //Barcode Printing
                                'print_barcodes',
                                //Adjustments
                                'access_adjustments',
                                'create_adjustments',
                                'show_adjustments',
                                'edit_adjustments',
                                'delete_adjustments',
                                //Quotaions
                                'access_quotations',
                                'create_quotations',
                                'show_quotations',
                                'edit_quotations',
                                'delete_quotations',
                                //Create Sale From Quotation
                                'create_quotation_sales',
                                //Send Quotation On Email
                                'send_quotation_mails',
                                //Expenses
                                'access_expenses',
                                'create_expenses',
                                'edit_expenses',
                                'delete_expenses',
                                //Expense Categories
                                'access_expense_categories',
                                //Customers
                                'access_customers',
                                'create_customers',
                                'show_customers',
                                'edit_customers',
                                'delete_customers',
                                //Suppliers
                                'access_suppliers',
                                'create_suppliers',
                                'show_suppliers',
                                'edit_suppliers',
                                'delete_suppliers',
                                //Sales
                                'access_sales',
                                'create_sales',
                                'show_sales',
                                'edit_sales',
                                'delete_sales',
                                //POS Sale
                                'create_pos_sales',
                                //Sale Payments
                                'access_sale_payments',
                                //Sale Returns
                                'access_sale_returns',
                                'create_sale_returns',
                                'show_sale_returns',
                                'edit_sale_returns',
                                'delete_sale_returns',
                                //Sale Return Payments
                                'access_sale_return_payments',
                                //Purchases
                                'access_purchases',
                                'create_purchases',
                                'show_purchases',
                                'edit_purchases',
                                'delete_purchases',
                                //Purchase Payments
                                'access_purchase_payments',
                                //Purchase Returns
                                'access_purchase_returns',
                                'create_purchase_returns',
                                'show_purchase_returns',
                                'edit_purchase_returns',
                                'delete_purchase_returns',
                                //Purchase Return Payments
                                'access_purchase_return_payments',
                                //Reports
                                'access_reports',
                                //Currencies
                                'access_currencies',
                                'create_currencies',
                                'edit_currencies',
                                'delete_currencies',
                                //Settings
                                'access_settings',

                                //Caja
                                'access_caja',
                                'create_caja',
                                'edit_caja',
                                'delete_caja',

                                 //Personal
                                'access_personal',
                                'create_personal',
                                'show_personal',
                                'edit_personal',
                                'delete_personal',

                                 //Tarea
                                 'access_tarea',
                                 'create_tarea',
                                 'show_tarea',
                                 'edit_tarea',
                                 'delete_tarea',

                                 /* Empresas */
                                'acceso_empresa',
                                'Ver Empresa',
                                'Editar Empresa',


                                /* Planes */
                                'acceso_planes',
                                'Ver Planes',

                                'Editar Planes',

                                //Accounts
                                'access_accounts',
                                'create_accounts',
                                'show_accounts',
                                'edit_accounts',
                                'delete_accounts',


                              ];



        $this->encargado_permissions =  [



                                //User Mangement
                                'edit_own_profile',
                                'access_user_management',
                                //Dashboard
                                'show_total_stats',
                                'show_month_overview',
                                'show_weekly_sales_purchases',
                                'show_monthly_cashflow',
                                'show_notifications',
                                //Products
                                'access_products',
                                'create_products',
                                'show_products',
                                'edit_products',
                                'delete_products',
                                //Product Categories
                                'access_product_categories',
                                //Barcode Printing
                                'print_barcodes',
                                //Adjustments
                                'access_adjustments',
                                'create_adjustments',
                                'show_adjustments',
                                'edit_adjustments',
                                'delete_adjustments',
                                //Quotaions
                                'access_quotations',
                                'create_quotations',
                                'show_quotations',
                                'edit_quotations',
                                'delete_quotations',
                                //Create Sale From Quotation
                                'create_quotation_sales',
                                //Send Quotation On Email
                                'send_quotation_mails',
                                //Expenses
                                'access_expenses',
                                'create_expenses',
                                'edit_expenses',
                                'delete_expenses',
                                //Expense Categories
                                'access_expense_categories',
                                //Customers
                                'access_customers',
                                'create_customers',
                                'show_customers',
                                'edit_customers',
                                'delete_customers',
                                //Suppliers
                                'access_suppliers',
                                'create_suppliers',
                                'show_suppliers',
                                'edit_suppliers',
                                'delete_suppliers',
                                //Sales
                                'access_sales',
                                'create_sales',
                                'show_sales',
                                'edit_sales',
                                'delete_sales',
                                //POS Sale
                                'create_pos_sales',
                                //Sale Payments
                                'access_sale_payments',
                                //Sale Returns
                                'access_sale_returns',
                                'create_sale_returns',
                                'show_sale_returns',
                                'edit_sale_returns',
                                'delete_sale_returns',
                                //Sale Return Payments
                                'access_sale_return_payments',
                                //Purchases
                                'access_purchases',
                                'create_purchases',
                                'show_purchases',
                                'edit_purchases',
                                'delete_purchases',
                                //Purchase Payments
                                'access_purchase_payments',
                                //Purchase Returns
                                'access_purchase_returns',
                                'create_purchase_returns',
                                'show_purchase_returns',
                                'edit_purchase_returns',
                                'delete_purchase_returns',
                                //Purchase Return Payments
                                //'access_purchase_return_payments',
                                //Reports
                                //'access_reports',
                                //Currencies
                                //'access_currencies',
                                //'create_currencies',
                                //'edit_currencies',
                                //'delete_currencies',
                                //Settings
                                //'access_settings',

                                //Caja
                                'access_caja',
                                'create_caja',
                                'edit_caja',
                                'delete_caja',

                                 //Tarea
                                 'access_tarea',
                                 'create_tarea',
                                 'show_tarea',
                                 'edit_tarea',
                                 'delete_tarea',




                                /*Empresa*/

                                'acceso_empresa',
                                'Editar Empresa',

                                  /* Planes */
                                'acceso_planes',
                                'Ver Planes',
                                'Editar Planes',

                                //Accounts
                                'access_accounts',
                                'create_accounts',
                                'show_accounts',
                                'edit_accounts',
                                'delete_accounts',





                              ];


        /*
        set the permissions for the user role, by default
        role admin we will assign all the permissions
        */
        $this->supervisor_permissions = [

                              //User Mangement
                                'edit_own_profile',
                                'access_user_management',
                                //Dashboard
                                'show_total_stats',
                                'show_month_overview',
                                'show_weekly_sales_purchases',
                                'show_monthly_cashflow',
                                'show_notifications',
                                //Products
                                'access_products',
                                'create_products',
                                'show_products',
                                'edit_products',
                                'delete_products',
                                //Product Categories
                                'access_product_categories',
                                //Barcode Printing
                                'print_barcodes',
                                //Adjustments
                                'access_adjustments',
                                'create_adjustments',
                                'show_adjustments',
                                'edit_adjustments',
                                'delete_adjustments',
                                //Quotaions
                                'access_quotations',
                                'create_quotations',
                                'show_quotations',
                                'edit_quotations',
                                'delete_quotations',
                                //Create Sale From Quotation
                                'create_quotation_sales',
                                //Send Quotation On Email
                                'send_quotation_mails',
                                //Expenses
                                'access_expenses',
                                'create_expenses',
                                'edit_expenses',
                                'delete_expenses',
                                //Expense Categories
                                'access_expense_categories',
                                //Customers
                                'access_customers',
                                'create_customers',
                                'show_customers',
                                'edit_customers',
                                'delete_customers',
                                //Suppliers
                                'access_suppliers',
                                'create_suppliers',
                                'show_suppliers',
                                'edit_suppliers',
                                'delete_suppliers',
                                //Sales
                                'access_sales',
                                'create_sales',
                                'show_sales',
                                'edit_sales',
                                'delete_sales',
                                //POS Sale
                                'create_pos_sales',
                                //Sale Payments
                                'access_sale_payments',
                                //Sale Returns
                                'access_sale_returns',
                                'create_sale_returns',
                                'show_sale_returns',
                                'edit_sale_returns',
                                'delete_sale_returns',
                                //Sale Return Payments
                                'access_sale_return_payments',
                                //Purchases
                                'access_purchases',
                                'create_purchases',
                                'show_purchases',
                                'edit_purchases',
                                'delete_purchases',
                                //Purchase Payments
                                'access_purchase_payments',
                                //Purchase Returns
                                'access_purchase_returns',
                                'create_purchase_returns',
                                'show_purchase_returns',
                                'edit_purchase_returns',
                                'delete_purchase_returns',
                                //Purchase Return Payments
                                'access_purchase_return_payments',
                                //Reports
                                'access_reports',
                                //Currencies
                                'access_currencies',
                                'create_currencies',
                                'edit_currencies',
                                'delete_currencies',
                                //Settings
                                'access_settings',

                                //Caja
                                'access_caja',
                                'create_caja',
                                'edit_caja',
                                'delete_caja',

                                 //Personal
                                'access_personal',
                                'create_personal',
                                'show_personal',
                                'edit_personal',
                                'delete_personal',

                                 //Tarea
                                 'access_tarea',
                                 'create_tarea',
                                 'show_tarea',
                                 'edit_tarea',
                                 'delete_tarea',

                                  /*Empresa*/

                                'acceso_empresa',
                                'Editar Empresa',

                                  /* Planes */
                                'acceso_planes',
                                'Ver Planes',
                                'Editar Planes',

                                //Accounts
                                'access_accounts',
                                'create_accounts',
                                'show_accounts',
                                'edit_accounts',
                                'delete_accounts',




                              ];

            /*
        set the permissions for the user role, by default
        role admin we will assign all the permissions
        */
        $this->vendedor_permissions = [


                                'show_notifications',
                                //Products
                                'access_products',
                                'create_products',
                                'show_products',
                                'edit_products',
                                'delete_products',
                                //Product Categories
                                'access_product_categories',
                                //Barcode Printing
                                //'print_barcodes',
                                //Adjustments
                                //'access_adjustments',
                                //'create_adjustments',
                                //'show_adjustments',
                                //'edit_adjustments',
                                //'delete_adjustments',
                                //Quotaions
                                //'access_quotations',
                                //'create_quotations',
                                //'show_quotations',
                                //'edit_quotations',
                                //'delete_quotations',
                                //Create Sale From Quotation
                                //'create_quotation_sales',
                                //Send Quotation On Email
                                //'send_quotation_mails',
                                //Expenses
                                //'access_expenses',
                                //'create_expenses',
                                //'edit_expenses',
                                //'delete_expenses',
                                //Expense Categories
                                //'access_expense_categories',
                                //Customers
                                'access_customers',
                                'create_customers',
                                'show_customers',
                                'edit_customers',
                                'delete_customers',
                                //Suppliers
                                //'access_suppliers',
                                //'create_suppliers',
                                //'show_suppliers',
                                //'edit_suppliers',
                                //'delete_suppliers',
                                //Sales
                                'access_sales',
                                'create_sales',
                                'show_sales',
                                'edit_sales',
                                //'delete_sales',
                                //POS Sale
                                'create_pos_sales',
                                //Sale Payments
                                'access_sale_payments',
                                //Sale Returns
                                'access_sale_returns',
                                'create_sale_returns',
                                'show_sale_returns',
                                'edit_sale_returns',
                                'delete_sale_returns',
                                //Sale Return Payments
                                'access_sale_return_payments',
                                //Purchases
                                //'access_purchases',
                                //'create_purchases',
                                //'show_purchases',
                                //'edit_purchases',
                                //'delete_purchases',
                                //Purchase Payments
                                //'access_purchase_payments',
                                //Purchase Returns
                                //'access_purchase_returns',
                                //'create_purchase_returns',
                                //'show_purchase_returns',
                                //'edit_purchase_returns',
                                //'delete_purchase_returns',
                                //Purchase Return Payments
                                //'access_purchase_return_payments',
                                //Reports
                                //'access_reports',
                                //Currencies
                                //'access_currencies',
                                //'create_currencies',
                                //'edit_currencies',
                                //'delete_currencies',
                                //Settings
                                //'access_settings',

                                //Caja
                                //'access_caja',
                                //'create_caja',
                                //'edit_caja',
                                //'delete_caja',
                              ];

    }






    public function run()
    {


         // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        foreach ($this->super_admin_permissions as $permission)
        {
            Permission::create(['name' => $permission]);
        }


        // create the admin role and set all default permissions
        $role = Role::create(['name' => 'Super Administrador']);
        $role->givePermissionTo($this->super_admin_permissions);


        // create the admin role and set all default permissions
        $role = Role::create(['name' => 'Administrador']);
        $role->givePermissionTo($this->permissions_admin);

        // create the user role and set all user permissions
        $role = Role::create(['name' => 'Supervisor']);
        $role->givePermissionTo($this->supervisor_permissions);

         // create the user role and set all user permissions
        $role = Role::create(['name' => 'Vendedor']);
        $role->givePermissionTo($this->vendedor_permissions);

         // create the user role and set all user permissions
        $role = Role::create(['name' => 'Encargado']);
        $role->givePermissionTo($this->encargado_permissions);
    }
}
