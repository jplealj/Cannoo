@extends('layouts.master')

@section("title", $data["title"])

@section('content')
<div class="container">
    <div class="row p-5">
        <div class="col-md-12">
            <ul id="errors">
                <div class="card">
                    <div class="card-header">{{ $data["product"]->getType() }}</div>
                    <div class="card-body">

                        <ul id="errors">
                            <b>@lang('messages.price'): </b> {{ $data["product"]->getPrice() }} <br/>
                            <b>@lang('messages.description'): </b> {{ $data["product"]->getDescription() }}
                        </ul>

                        <form  action="{{ url('product/delete/'.$data['product']->getId()) }}">
                            <input class="float-right" type="submit" value="@lang('messages.deleteProduct')"/>
                        </form>

                        <form  action="{{ url('product/updateDescription/'.$data['product']->getId()) }}">
                            <input class="float-right" type="submit" value="@lang('messages.changeDescription')" style="margin-right:5px;"/>
                        </form>

                    </div>
                </div>
                <br/>
            </ul>
        </div>
    </div>
</div>
@endsection