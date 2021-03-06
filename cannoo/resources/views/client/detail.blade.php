@extends('layouts.master')

@section('content')
<div class="container">
    <a class="btn btn-info" href="{{ route('client.show') }}">
        @lang('messages.showClients')
    </a>
</div>
<br/>

<div class="container">
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">@lang('messages.name')</th>
                    <th scope="col">@lang('messages.email_address')</th>
                    <th scope="col">@lang('messages.address')</th> 
                    <th scope="col">@lang('messages.phone')</th> 
                    <th scope="col">@lang('messages.actions')</th> 
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td scope="row">{{ $client->getId() }}</td>
                    <td>{{ $client->getName() }}</td>
                    <td>{{ $client->getEmail() }}</td>
                    <td>{{ $client->getAddress()}}</td>
                    <td>{{ $client->getPhone()}}</td>  
                    <td>
                        <form method=POST action="{{ route('client.delete', $client->getId()) }}">
                            @csrf
                            <input class="btn btn-danger" type="submit" value="@lang('messages.deleteClient')"/>
                        </form>
                        <form method=POST action="{{ route('client.makeAdmin', $client->getId()) }}"> <br/>
                            @csrf
                            <input class="btn btn-info" type="submit" value="@lang('messages.makeAdmin')"/>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection