<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productinvoice extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function invoices()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
