@extends('layouts.app')

@section('content')

    <div class="bg-light p-4 rounded">
        <h1 class="mb-3">Menu</h1>
        <form method="GET" action="/menu" class="form-inline">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-4">
                <input type="search" name="search" class="form-control form-control" placeholder="Search..." aria-label="Search" value="{{ request()->get('search') }}">
            </div>
            <div class="col-md-4">
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" name="sort">
                                <option value="">Sort</option>
                                <option value="n-asc" {{ request()->get('sort') == 'n-asc'  ? 'selected' : ''}}>A - Z</option>
                                <option value="n-desc" {{ request()->get('sort') == 'n-desc'  ? 'selected' : ''}}>Z - A</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mb-2">Go</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="lead">
            <a href="{{ route('menu.create') }}" class="btn btn-primary btn-sm float-right">Add Menu</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Name</th>
             <th>Price</th>
             <th>Stock</th>
             <th>Image</th>
             <th width="3%" colspan="3">Action</th>
          </tr>
            @foreach ($menu as $item)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $item['name'] }}</td>
                <td>@currency($item['price'])</td>
                <td>{{ $item['stock'] }}</td>
                <td><img width="250" src="{{ url('/uploads/images/'.$item['image']) }}"></td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('menu.edit', $item->id) }}">Edit</a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE','route' => ['menu.delete', $item['id']],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                </td>
            </tr>
            @endforeach
        </table>

    </div>
@endsection
