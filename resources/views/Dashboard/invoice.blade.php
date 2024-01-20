@extends('layouts.master')
@section('css')
    {{-- @toastr_css --}}
@section('title')
Invoices
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Invoices
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">
            <div class="col-12">
                @if (session()->has('add'))
                    <div class="alert alert-success text-center">{{session()->get('add')}}</div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-danger text-center">{{session()->get('error')}}</div>
                    @endif
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
Add Invoice
            </button>
            <br><br>
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quanyity</th>
                            <th>Total</th>
                            <th>All Total</th>
                        </tr>
                    </thead>
                    <?php $i = 0;?>
                    <tbody>
                        @foreach ($Invoices as $Invoice)
                        <?php $i++?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $Invoice->client->name }}</td>
                            <td>{{ $Invoice->date }}</td>
                            <td>
                                @foreach ($Productinvoices as $p)
                                @if($Invoice->id == $p->invoice_id)
                                {{$p->product->product_name}}<br> 
                               @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($Productinvoices as $p)
                                @if($Invoice->id == $p->invoice_id)
                                {{$p->price}}<br> 
                               @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($Productinvoices as $p)
                                @if($Invoice->id == $p->invoice_id)
                                {{$p->quantity}}<br> 
                               @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($Productinvoices as $p)
                                @if($Invoice->id == $p->invoice_id)
                                {{$p->total}}<br> 
                               @endif
                                @endforeach
                            </td>
                               <td>{{ $Invoice->all_total }}</td> 
                        </tr>                        
@endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
Add Invoice
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="row mb-30" action="{{route('addinvoices','test')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label  class="mr-sm-2">Client</label>
                                <select  class="form-control" name="client_id">
                                    <option value="">-- Choose --</option>
                                    @foreach ($Clients as $Client)
                                        <option value="{{ $Client->id }}">{{ $Client->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="date" class="mr-sm-2">Date</label>
                                <input class="form-control" type="date" name="date" required/>
                            </div>
                        </div>
                        <div class="repeater">
                            <div data-repeater-list="List_Products">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="col">
                                            <label  class="mr-sm-2">Product</label>
                                            <select  class="form-control" name="product_id">
                                                <option value="">-- Choose --</option>
                                                @foreach ($Products as $Product)
                                                    <option value="{{ $Product->id }}">{{ $Product->product_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <label for="quantity"
                                                class="mr-sm-2">Quantity
                                                </label>
                                            <input class="form-control" type="number" name="quantity" required />
                                        </div>
                                        <div class="col">
                                            <label for="delete"
                                                class="mr-sm-2">Delete Row</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="Delete Row" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="Add Product'" />
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit"
                                    class="btn btn-success">Submit</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

</div>
</div>

<!-- row closed -->
@endsection
@section('js')
{{-- @toastr_js
@toastr_render --}}

@endsection
