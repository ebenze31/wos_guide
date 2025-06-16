@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Chief_gear</div>
                    <div class="card-body">
                        <a href="{{ url('/chief_-gear/create') }}" class="btn btn-success btn-sm" title="Add New Chief_Gear">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/chief_-gear') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Tier</th><th>Stars</th><th>Hardened Alloy</th><th>Polishing Solution</th><th>Design Plans</th><th>Lunar Amber</th><th>Power</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($chief_gear as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->Tier }}</td><td>{{ $item->Stars }}</td><td>{{ $item->Hardened_Alloy }}</td><td>{{ $item->Polishing_Solution }}</td><td>{{ $item->Design_Plans }}</td><td>{{ $item->Lunar_Amber }}</td><td>{{ $item->Power }}</td>
                                        <td>
                                            <a href="{{ url('/chief_-gear/' . $item->id) }}" title="View Chief_Gear"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/chief_-gear/' . $item->id . '/edit') }}" title="Edit Chief_Gear"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/chief_-gear' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Chief_Gear" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $chief_gear->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
