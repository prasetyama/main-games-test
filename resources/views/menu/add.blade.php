@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">
        

        <div class="container mt-4">
            <h2>Add Menu</h2>

            @if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
            @endif
            <form method="POST" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="product_name" class="form-label">Name</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">price</label>
                    <input value="{{ old('price') }}" 
                        type="text" 
                        class="form-control" 
                        name="price" 
                        placeholder="Price" required>

                    @if ($errors->has('price'))
                        <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input value="{{ old('stock') }}" 
                        type="text" 
                        class="form-control" 
                        name="stock" 
                        placeholder="Stock" required>

                    @if ($errors->has('stock'))
                        <span class="text-danger text-left">{{ $errors->first('stock') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <div class="form-group">
						<b>Image</b><br/>
						<input type="file" name="file">
					</div>
                </div>

                <button type="submit" class="btn btn-primary">Add Menu</button>
                <a href="{{route('menu.index')}}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection