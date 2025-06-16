@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Chief_Gear {{ $chief_gear->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/chief_-gear') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/chief_-gear/' . $chief_gear->id . '/edit') }}" title="Edit Chief_Gear"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('chief_gear' . '/' . $chief_gear->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Chief_Gear" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $chief_gear->id }}</td>
                                    </tr>
                                    <tr><th> Tier </th><td> {{ $chief_gear->Tier }} </td></tr><tr><th> Stars </th><td> {{ $chief_gear->Stars }} </td></tr><tr><th> Hardened Alloy </th><td> {{ $chief_gear->Hardened_Alloy }} </td></tr><tr><th> Polishing Solution </th><td> {{ $chief_gear->Polishing_Solution }} </td></tr><tr><th> Design Plans </th><td> {{ $chief_gear->Design_Plans }} </td></tr><tr><th> Lunar Amber </th><td> {{ $chief_gear->Lunar_Amber }} </td></tr><tr><th> Power </th><td> {{ $chief_gear->Power }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
