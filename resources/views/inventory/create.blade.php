@extends('layouts.app')


@section('content')

<div class="row ">


    <div class="col-12 ">
        <div class="box-content card white">
            <h4 class="box-title">Create A Inventory</h4>
            <!-- /.box-title -->
            <div class="card-content">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal" method="post" action="{{ route('inventory.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div id="invoceWrapper">
                                    <div class="form-group">
                                        <!-- <label for="select_manufacturer" class="col-md-3
                                            col-12 control-label">Select Manufacturer<span
                                                class="mdi mdi-multiplication"></span></label> -->
                                                <label for="select_manufacturer" class="col-md-3
                                            col-12 control-label">Select Manufacturer<span class="mdi mdi-multiplication"></span></label>
                                        <div class="col-md-9 col-12">
                                            <select class="form-control"
                                                id="select_manufacturer" name="manufacturer_id" onchange="fetch_model($(this).val());">
                                                <option value=''>Select Manufacturer</option>
                                                @php
                                                foreach($manufacturer as $k=>$manufac){
                                                @endphp
                                                <option value="{{$manufac->id}}">{{$manufac->manufacturer_name}}</option>
                                                @php
                                                }
                                                @endphp
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="select_model" class="col-md-3
                                            col-12 control-label">Select Model<span class="mdi mdi-multiplication"></span></label>
                                        <div class="col-md-9 col-12">
                                            <select class="form-control"
                                                id="select_model" name="model_id" onchange="fetch_supplier($(this).val();">
                                                <option value=''>Select Model</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="select_supplier" class="col-md-3
                                            col-12 control-label">Select Responsible Supplier<span class="mdi mdi-multiplication"></span></label>
                                        <div class="col-md-9 col-12">
                                            <select class="form-control"
                                                id="select_supplier" name="supplier_id">
                                                <option value=''>Select Supplier</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pallet_num"
                                            class="col-md-3
                                            col-12 control-label">Pallet Number (optional)</label>
                                        <div class="col-md-9 col-12">
                                            <input type="text"
                                                class="form-control"
                                                id="pallet_num" value="{{ old('pallet_number')}}" name="pallet_number"
                                                placeholder="Pallet Number (optional)">
                                                <p class="help-block">This is a way to group your panels which then can be easily assigned to jobs in the future.</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="inp-type-5" class="col-md-3
                                        col-12 control-label">Unverified Panel Serials<span class="mdi mdi-multiplication"></span></label>
                                        <div class="col-md-9 col-12">
                                            <textarea class="form-control" id="inp-type-5" name="unverified_panel_serials" placeholder="Write your meassage">{{old('unverified_panel_serials')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="enter_wattage"
                                            class="col-md-3
                                            col-12 control-label">Enter Wattage<span class="mdi mdi-multiplication"></span></label>
                                        <div class="col-md-9 col-12">
                                            <input type="number"
                                                class="form-control"
                                                id="enter_wattage" value="{{ old('wattage')}}" name="wattage">
                                                <p class="help-block">Enter value in kW</p>
                                        </div>
                                    </div> 
                
                                    <div class="form-group margin-bottom-0 Add_Panel">
                                        <div class="col-12 text-center">
                                            <a class="btn btn-primary" href="{{ route('inventory.index') }}"> Back</a> &nbsp;
                                            <button type="submit" class="btn
                                                btn-info btn-sm waves-effect
                                                waves-light">Add as unverified panels</button>
                                        </div>
                                    </div>
                                </div>
                    
                </form>
            </div>
            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>

    <!-- /.col-lg-6 col-xs-12 -->
</div>


@endsection