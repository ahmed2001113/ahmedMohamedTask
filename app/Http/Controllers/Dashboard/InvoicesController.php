<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Productinvoice;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    public function index()
    {
        $Clients = Client::all();
        $Products = Product::all();
        $Invoices = Invoice::all();
        $Productinvoices = Productinvoice::all();
        return view('Dashboard.invoice', compact('Clients', 'Products','Invoices','Productinvoices'));
    }

    public function store(Request $request)
    {
        $rules=[
            'client_id'=>['required'],
            'date'=>['required'],
        ];
        $request->validate($rules);
        $all = 0;
        $List_Products = $request->List_Products;
        if($List_Products){
        foreach ($List_Products as $List_Product) {
            if($List_Product['product_id']){   
                $all += Product::where('id',$List_Product['product_id'])->first()->price *  $List_Product['quantity'];
            }else{
                return redirect()->back()->with('error','Product Is requierd');
            }
        } }else{
            return redirect()->back()->with('error','Product Is requierd');            
        }  

        $Invoices = new Invoice();
        $Invoices->client_id =  $request->client_id;
        $Invoices->date =  $request->date;
        $Invoices->all_total = $all;
        $Invoices->save();

        $ss = Invoice::latest()->first()->id;
        
        foreach ($List_Products as $List_Product) {
                $productInvoices = new Productinvoice();
                $productInvoices->invoice_id =  $ss;
                $productInvoices->product_id =  $List_Product['product_id'];
                $productInvoices->price =  Product::where('id',$List_Product['product_id'])->first()->price;
                $productInvoices->quantity = $List_Product['quantity'];
                $productInvoices->total= Product::where('id',$List_Product['product_id'])->first()->price *  $List_Product['quantity'];
                $productInvoices->save();
            }
            return redirect()->back()->with('add','Invoice Added Successfully');
    }
}


