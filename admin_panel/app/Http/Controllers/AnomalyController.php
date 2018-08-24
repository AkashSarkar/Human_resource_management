<?php
/**
 * Created by PhpStorm.
 * User: jamil
 * Date: 5/9/18
 * Time: 11:52 AM
 */

namespace App\Http\Controllers;


use App\Models\CartModel;
use App\Models\CustomerTypesModel;
use App\Models\ErrorR;
use App\Models\Modules;
use App\Models\OrderModel;
use App\Models\PackageModel;
use App\Models\PackageProductModel;
use App\Models\ProductModel;
use App\Models\ProductPriceModel;
use App\Models\UserModel;
use App\Modules\Accounting\Models\EntryModel;
use App\Modules\Accounting\Models\GroupModel;
use App\Modules\Accounting\Models\LedgerModel;

class AnomalyController extends Controller
{

    public function index()
    {
        $responseData = [];
        $responseData['danger'] = 0;
        $responseData['warning'] = 0;
        $responseData['info'] = 0;
        $responseData['errorr_back'] = ErrorR::where('source', 'back')->count();
        $responseData['errorr_front'] = ErrorR::where('source', 'front')->count();
        $responseData['modules'] = [];
        $modules = Modules::all();
        foreach ($modules as $idx => $module) {
            $msg = [];
            $msg['danger'] = [];
            $msg['warning'] = [];
            $msg['info'] = [];
            $responseData['modules'][$module->tag]['name'] = $module->name;
            switch ($module->tag) {
                case "user":
                    $count = UserModel::whereRaw('LENGTH(primary_phone) > 11')->orWhereRaw('LENGTH(primary_phone) < 11')->count();
                    if ($count) {
                        $m['note'] = $count . " users primary phone number is invalid";
                        $m['ids'] = UserModel::whereRaw('LENGTH(primary_phone) > 11')->orWhereRaw('LENGTH(primary_phone) < 11')->pluck('id');
                        $msg['warning'][] = $m;
                    }
                    $count = CustomerTypesModel::count();
                    if (!$count) {
                        $m['note'] = $count . " customer type is empty";
                    } else {
                        $count = UserModel::where('customer_type_id', CustomerTypesModel::where('type', 'wholesaler')->first()->id)->whereNull('ledger_id')->count();
                        if ($count) {
                            $m['note'] = $count . " wholesale customer do not have ledger";
                            $m['ids'] = UserModel::where('customer_type_id', CustomerTypesModel::where('type', 'wholesaler')->first()->id)->whereNull('ledger_id')->pluck('id');
                            $msg['danger'][] = $m;
                        }
                    }

                    break;
                case "package":
                    $count = PackageModel::whereNotIn('id', function ($query) {
                        $query->select('package_id')->from(with(new PackageProductModel())->getTable());
                    })->count();
                    if ($count) {
                        $m['note'] = $count . " package without product";
                        $m['ids'] = PackageModel::whereNotIn('id', function ($query) {
                            $query->select('package_id')->from(with(new PackageProductModel())->getTable());
                        })->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = PackageModel::where('original_price_total', 0.00)->count();
                    if ($count) {
                        $m['note'] = $count . " product with 0.00 original price";
                        $m['ids'] = PackageModel::where('original_price_total', 0.00)->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = PackageModel::where('package_price_total', 0.00)->count();
                    if ($count) {
                        $m['note'] = $count . " package with 0.00 price";
                        $m['ids'] = PackageModel::where('package_price_total', 0.00)->pluck('id');
                        $msg['danger'][] = $m;
                    }

                    $count = PackageModel::whereIn('id', function ($query) {
                        $query->select('package_id')->from(with(new PackageProductModel())->getTable())->where('price', 0.00);
                    })->count();
                    if ($count) {
                        $m['note'] = $count . " package product with 0.00 price";
                        $m['ids'] = PackageModel::whereIn('id', function ($query) {
                            $query->select('package_id')->from(with(new PackageProductModel())->getTable())->where('price', 0.00);
                        })->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = PackageModel::whereIn('id', function ($query) {
                        $query->select('package_id')->from(with(new PackageProductModel())->getTable())->where('quantity', 0);
                    })->count();
                    if ($count) {
                        $m['note'] = $count . " package product with 0 quantity";
                        $m['ids'] = PackageModel::whereIn('id', function ($query) {
                            $query->select('package_id')->from(with(new PackageProductModel())->getTable())->where('quantity', 0);
                        })->pluck('id');
                        $msg['warning'][] = $m;
                    }
                    break;
                case "product":
                    $count = ProductModel::whereNull('manufacture_id')->count();
                    if ($count) {
                        $m['note'] = $count . " product without manufacturer";
                        $m['ids'] = ProductModel::whereNull('manufacture_id')->pluck('id');
                        $msg['warning'][] = $m;
                    }
                    $count = ProductModel::whereNull('shipment_id')->count();
                    if ($count) {
                        $m['note'] = $count . " product without shipment";
                        $m['ids'] = ProductModel::whereNull('shipment_id')->pluck('id');
                        $msg['warning'][] = $m;
                    }
                    $count = ProductModel::whereNull('supplier_id')->count();
                    if ($count) {
                        $m['note'] = $count . " product without supplier";
                        $m['ids'] = ProductModel::whereNull('supplier_id')->pluck('id');
                        $msg['warning'][] = $m;
                    }
                    $count = ProductModel::whereNull('barcode')->orWhere('barcode', "")->count();
                    if ($count) {
                        $m['note'] = $count . " product without barcode";
                        $m['ids'] = ProductModel::whereNull('barcode')->orWhere('barcode', "")->pluck('id');
                        $msg['danger'][] = $m;
                    }

                    $count = ProductModel::whereNotIn('id', function ($query) {
                        $query->select('product_id')->from(with(new ProductPriceModel)->getTable());
                    })->count();
                    if ($count) {
                        $m['note'] = $count . " product without price";
                        $m['ids'] = ProductModel::whereNotIn('id', function ($query) {
                            $query->select('product_id')->from(with(new ProductPriceModel)->getTable());
                        })->pluck('id');
                        $msg['danger'][] = $m;
                    }

                    $count = ProductPriceModel::where('purchase_price', 0.00)->count();
                    if ($count) {
                        $m['note'] = $count . " product with 0.00 purchase price";
                        $m['ids'] = ProductPriceModel::where('purchase_price', 0.00)->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = ProductPriceModel::where('wholesale_price', 0.00)->count();
                    if ($count) {
                        $m['note'] = $count . " product with 0.00 wholesale price";
                        $m['ids'] = ProductPriceModel::where('wholesale_price', 0.00)->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = ProductPriceModel::where('retail_price', 0.00)->count();
                    if ($count) {
                        $m['note'] = $count . " product with 0.00 retail price";
                        $m['ids'] = ProductPriceModel::where('retail_price', 0.00)->pluck('id');
                        $msg['danger'][] = $m;
                    }

                    $count = ProductPriceModel::whereIn('id', function ($query) {
                        $query->select('id')->from(with(new ProductPriceModel)->getTable())->groupBy('product_id')->havingRaw('count(*) > 1');
                    })
                        ->count();
                    if ($count) {
                        $m['note'] = $count . " product have multiple price details";
                        $m['ids'] = ProductPriceModel::whereIn('id', function ($query) {
                            $query->select('id')->from(with(new ProductPriceModel)->getTable())->groupBy('product_id')->havingRaw('count(*) > 1');
                        })
                            ->pluck('id');
                        $msg['warning'][] = $m;
                    }

                    break;
                case "order":
                    $count = CartModel::whereNull('order_id')->count();
                    if ($count) {
                        $m['note'] = $count . " cart have no order";
                        $m['ids'] = CartModel::whereNull('order_id')->pluck('id');
                        $msg['warning'][] = $m;
                    }

                    $count = CartModel::whereIn('id', function ($query) {
                        $query->select('id')->from(with(new CartModel)->getTable())->groupBy('customer_id')->havingRaw('count(*) > 1');
                    })->whereNull('order_id')
                        ->count();
                    if ($count) {
                        $m['note'] = $count . " user have multiple empty ordered cart";
                        $m['ids'] = CartModel::whereIn('id', function ($query) {
                            $query->select('id')->from(with(new CartModel)->getTable())->groupBy('customer_id')->havingRaw('count(*) > 1');
                        })->whereNull('order_id')->pluck('id');
                        $msg['warning'][] = $m;
                    }

                    $count = OrderModel::whereNotNull('complete_date')->whereNull('ledger_id')->count();
                    if ($count) {
                        $m['note'] = $count . " completed order do not have ledger";
                        $m['ids'] = OrderModel::whereNotNull('complete_date')->whereNull('ledger_id')->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    $count = OrderModel::whereNotNull('complete_date')->whereNull('entry_id')->count();
                    if ($count) {
                        $m['note'] = $count . " completed order do not have entry in account";
                        $m['ids'] = OrderModel::whereNotNull('complete_date')->whereNull('entry_id')->pluck('id');
                        $msg['danger'][] = $m;
                    }
                    break;
                case "accounting":
                    $count = EntryModel::count();
                    if (!$count) {
                        $m['note'] = $count . " entry type is empty";
                        $m['ids'] = [];
                        $msg['danger'][] = $m;
                    }
                    $count = GroupModel::count();
                    if (!$count) {
                        $m['note'] = $count . " group is empty";
                        $m['ids'] = [];
                        $msg['danger'][] = $m;
                    }
                    $count = LedgerModel::count();
                    if (!$count) {
                        $m['note'] = $count . " ledger is empty";
                        $m['ids'] = [];
                        $msg['danger'][] = $m;
                    }
                    break;
            }
            $responseData['info'] += count($msg['info']);
            $responseData['warning'] += count($msg['warning']);
            $responseData['danger'] += count($msg['danger']);
            $responseData['modules'][$module->tag]['anomaly'] = $msg;
        }

        return view('anomalies.list')->with(['data' => $responseData]);
    }
}