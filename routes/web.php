<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\ManageStockController;
use App\Http\Controllers\AccountMasterController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PurchaseOrderController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'login'])->name('new_login');

Auth::routes();

// ___________________________ Admin Route ____________________________
Route::group(['middleware' => ['auth']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('website-setting', [WebsiteController::class, 'index'])->name('website.setting');
        Route::post('website-setting/insert', [WebsiteController::class, 'insert'])->name('website.setting.insert');

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('dashboard/datatable', [DashboardController::class, 'datatable'])->name('dashboard.datatable');
        Route::get('dashboard/get_wdiget', [DashboardController::class, 'get_wdiget'])->name('dashboard.widget');

        Route::resource('category', CategoryController::class);
        Route::get('categories/datatable', [CategoryController::class, 'datatable'])->name('category.datatable');
        Route::get('categories/edit_modal/{id}', [CategoryController::class, 'edit_modal'])->name('category.edit_modal');
        Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
        Route::get('categories/change_status/{id}', [CategoryController::class, 'change_status'])->name('category.change_status');
        Route::get('categories/list/', [CategoryController::class, 'category_list'])->name('category.list');

        Route::resource('season', SeasonController::class);
        Route::get('seasons/datatable', [SeasonController::class, 'datatable'])->name('season.datatable');
        Route::get('seasons/edit_modal/{id}', [SeasonController::class, 'edit_modal'])->name('season.edit_modal');
        Route::get('seasons/delete/{id}', [SeasonController::class, 'delete'])->name('season.delete');
        Route::get('seasons/change_status/{id}', [SeasonController::class, 'change_status'])->name('season.change_status');

        Route::resource('brand',BrandController::class);
        Route::get('brands/datatable', [BrandController::class, 'datatable'])->name('brand.datatable');
        Route::get('brands/edit_modal/{id}', [BrandController::class, 'edit_modal'])->name('brand.edit_modal');
        Route::get('brands/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');
        Route::get('brands/change_status/{id}', [BrandController::class, 'change_status'])->name('brand.change_status');
        Route::get('brands/list/', [BrandController::class, 'brand_list'])->name('brand.list');

        Route::resource('item',ItemController::class);
        Route::get('items/datatable', [ItemController::class, 'datatable'])->name('item.datatable');
        Route::get('items/delete/{id}', [ItemController::class, 'delete'])->name('item.delete');
        Route::get('items/change_status/{id}', [ItemController::class, 'change_status'])->name('item.change_status');
        Route::get('items/add_article', [ItemController::class, 'add_article'])->name('item.add_article');
        Route::get('items/add_more', [ItemController::class, 'add_more'])->name('item.add_more');
        Route::get('items/remove_more', [ItemController::class, 'remove_more'])->name('item.remove_more');
        Route::get('items/remove_article', [ItemController::class, 'remove_article'])->name('item.remove_article');
        Route::get('items/get_barcode', [ItemController::class, 'get_barcode'])->name('item.get_barcode');

        Route::resource('manage_stock',ManageStockController::class);
        Route::get('manage_stocks/datatable',[ManageStockController::class,'datatable'])->name('manage_stock.datatable');
        Route::get('manage_stocks/edit_modal/{id}',[ManageStockController::class,'edit_modal'])->name('manage_stock.edit_modal');
        Route::get('manage_stocks/delete/{id}',[ManageStockController::class,'delete'])->name('manage_stock.delete');
        Route::get('manage_stocks/get_quantity',[ManageStockController::class,'get_quantity'])->name('manage_stock.get_quantity');
        Route::get('manage_stocks/average/',[ManageStockController::class,'average'])->name('manage_stock.average');
        Route::get('manage_stocks/average/datatable',[ManageStockController::class,'average_datatable'])->name('average_stock.datatable');
        Route::get('view_statement/{id}',[ManageStockController::class , 'view_statement'])->name('view_statement');
        Route::get('manage_stocks/report',[ManageStockController::class,'report'])->name('manage_stock.report');
        Route::get('manage_stocks/report/datatable',[ManageStockController::class,'report_datatable'])->name('manage_stock.report_datatable');

        Route::get('barcode/print',[ManageStockController::class,'barcode_print'])->name('barcode.print.index');
        Route::get('barcode/get_result',[ManageStockController::class,'barcode_get_result'])->name('barcode.get_result');
        Route::get('get_item_list',[ManageStockController::class,'get_item_list'])->name('barcode.get_item_list');
        Route::get('get-barcode',[ManageStockController::class,'get_barcode'])->name('barcode.get');
        Route::get('get-barcode-print',[ManageStockController::class,'get_barcode_print'])->name('barcode.get.print');

        Route::resource('account_master',AccountMasterController::class);
        Route::get('account_masters/datatable',[AccountMasterController::class,'datatable'])->name('account_master.datatable');
        Route::get('account_masters/edit_modal/{id}',[AccountMasterController::class,'edit_modal'])->name('account_master.edit_modal');
        Route::get('account_masters/delete/{id}',[AccountMasterController::class,'delete'])->name('account_master.delete');
        Route::get('account_masters/change_status/{id}',[AccountMasterController::class,'change_status'])->name('account_master.change_status');
        Route::get('vendor/list',[AccountMasterController::class,'vendor_list'])->name('vendor.list');
        Route::get('customer/list',[AccountMasterController::class,'customer_list'])->name('customer.list');
        Route::get('income/list',[AccountMasterController::class,'income_list'])->name('income.list');
        Route::get('expense/list',[AccountMasterController::class,'expense_list'])->name('expense.list');

        Route::resource('payment_master',PaymentMethodController::class);
        Route::get('payment_masters/datatable',[PaymentMethodController::class,'datatable'])->name('payment_master.datatable');
        Route::get('payment_masters/edit_modal/{id}',[PaymentMethodController::class,'edit_modal'])->name('payment_master.edit_modal');
        Route::get('payment_masters/delete/{id}',[PaymentMethodController::class,'delete'])->name('payment_master.delete');
        Route::get('payment_masters/change_status/{id}',[PaymentMethodController::class,'change_status'])->name('payment_master.change_status');
        Route::get('payment_masters/list',[PaymentMethodController::class,'payment_list'])->name('payment_master.list');

        Route::resource('ledger',LedgerController::class);
        Route::get('ledgers/datatable',[LedgerController::class,'datatable'])->name('ledger.datatable');
        Route::get('ledgers/edit_modal/{id}',[LedgerController::class,'edit_modal'])->name('ledger.edit_modal');
        Route::get('ledgers/delete/{id}',[LedgerController::class,'delete'])->name('ledger.delete');
        Route::get('ledgers/change_status/{id}',[LedgerController::class,'change_status'])->name('ledger.change_status');

        Route::resource('purchase',PurchaseOrderController::class);
        Route::get('purchases/datatable',[PurchaseOrderController::class,'datatable'])->name('purchase.datatable');
        Route::get('purchases/edit_modal/{id}',[PurchaseOrderController::class,'edit_modal'])->name('purchase.edit_modal');
        Route::get('purchases/delete/{id}',[PurchaseOrderController::class,'delete'])->name('purchase.delete');
        Route::get('purchases/change_status/{id}',[PurchaseOrderController::class,'change_status'])->name('purchase.change_status');
        Route::get('purchases/add_article_list',[PurchaseOrderController::class,'add_article_list'])->name('purchase.add_article_list');
        Route::get('purchases/remove_article',[PurchaseOrderController::class,'remove_article'])->name('purchase.remove_article');
        Route::get('purchases/report/index',[PurchaseOrderController::class,'report_index'])->name('purchase.report');
        Route::get('purchases/report/datatable',[PurchaseOrderController::class,'report_datatable'])->name('purchase.report.datatable');

        Route::get('expense/index',[LedgerController::class,'expense_index'])->name('expense.index');
        Route::get('expense/datatable',[LedgerController::class,'expense_datatable'])->name('expense.datatable');
        Route::post('expense/store',[LedgerController::class,'expense_store'])->name('expense.store');
        Route::get('expense/edit_modal/{id}',[LedgerController::class,'expense_edit_modal'])->name('expense.edit_modal');
        Route::get('expense/delete/{id}',[LedgerController::class,'expense_delete'])->name('expense.delete');

        Route::get('income/index',[LedgerController::class,'income_index'])->name('income.index');
        Route::get('income/datatable',[LedgerController::class,'income_datatable'])->name('income.datatable');
        Route::post('income/store',[LedgerController::class,'income_store'])->name('income.store');
        Route::get('income/edit_modal/{id}',[LedgerController::class,'income_edit_modal'])->name('income.edit_modal');
        Route::get('income/delete/{id}',[LedgerController::class,'income_delete'])->name('income.delete');

        Route::resource('sale',SaleOrderController::class);
        Route::get('sales/datatable',[SaleOrderController::class,'datatable'])->name('sale.datatable');
        Route::get('sales/delete/{id}',[SaleOrderController::class,'delete'])->name('sale.delete');
        Route::get('sales/add_item',[SaleOrderController::class,'add_item'])->name('sale.add_item');
        Route::get('sales/pos/{id}',[SaleOrderController::class,'pos'])->name('sale.pos');
        Route::get('sales/report',[SaleOrderController::class,'report_index'])->name('sale.report');

        Route::get('transaction/report',[LedgerController::class,'transaction_index'])->name('transaction.report');
        Route::get('transaction/report/datatable',[LedgerController::class,'transaction_datatable'])->name('transaction.report.datatable');

        Route::get('stock/report',[LedgerController::class,'stock_index'])->name('stock.report');
        Route::get('stock/report/datatable',[LedgerController::class,'stock_datatable'])->name('stock.report.datatable');
        Route::get('profit/report',[LedgerController::class,'profit_index'])->name('profit.report');
        Route::get('profit/report/datatable',[LedgerController::class,'profit_datatable'])->name('profit.report.datatable');

        // Employee Routes
        Route::get('user', [EmployeeController::class, 'index'])->name('user.index');
        Route::post('user/store', [EmployeeController::class, 'store'])->name('user.store');
        Route::get('user/datatable', [EmployeeController::class, 'datatable'])->name('user.datatable');
        Route::get('user/edit_modal/{id}', [EmployeeController::class, 'edit_modal'])->name('user.edit_modal');
        Route::get('user/delete/{id}', [EmployeeController::class, 'delete'])->name('user.delete');
        Route::get('user/change_status/{id}', [EmployeeController::class, 'change_status'])->name('user.change_status');
        Route::get('sub_user/index/{id}',[EmployeeController::class,'sub_user_index'])->name('sub_user.index');
        Route::get('sub_user/datatable/{id}',[EmployeeController::class,'sub_user_datatable'])->name('sub_user.datatable');
    });
});

// ___________________________ Admin & User Route ____________________________
Route::group(['middleware' => ['auth','is_User']], function () {
   

});