@extends('layouts.app')

@section('content')

    <div class="bg-light p-4 rounded">
        <h1 class="mb-3">Report</h1>
        <form method="GET" action="/report" class="form-inline">
        <div class="row" style="margin-bottom: 50px">
            <div class="col-md-8">
                <input type="search" name="search" class="form-control form-control mb-2" placeholder="Search..." aria-label="Search" value="{{ request()->get('search') }}">
                <div class="row mb-2">
                        <div class="col-md-5">
                            <label for="start_date" class="form-label">From Date</label>
                            <input value="{{ request()->get('from') }}" 
                                id="start-datepicker"
                                type="text" 
                                class="form-control date" 
                                name="from" 
                                placeholder="Start Date">
        
                            @if ($errors->has('from'))
                                <span class="text-danger text-left">{{ $errors->first('from') }}</span>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <label for="to_date" class="form-label">To Date</label>
                            <input value="{{ request()->get('to') }}" 
                                id="end-datepicker"
                                type="text" 
                                class="form-control date"  
                                name="to" 
                                placeholder="To Date">
        
                            @if ($errors->has('to'))
                                <span class="text-danger text-left">{{ $errors->first('to') }}</span>
                            @endif
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary mb-2">Go</button>
                    </div>
                </div>
                
            </div>
            </form>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-bordered">
          <tr>
             <th width="1%">No</th>
             <th>Receipt Number</th>
             <th>User</th>
             <th>Orders</th>
             <th>Created At</th>
          </tr>
            @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                <td>#{{ $item['id'] }}</td>
                <td>{{$item['user']['name']}}</td>
                <td>
                @foreach ($item['orders'] as $order)
                    {{ $loop->index + 1 }}. {{$order['menu']['name']}}<br>
                @endforeach
                </td>
                <td>{{ date('d M Y h:s', strtotime($item['created_at'])) }}</td>
            </tr>
            @endforeach
        </table>

        {{$data->appends(request()->query())->links()}}

    </div>
@endsection
