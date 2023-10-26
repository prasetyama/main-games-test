@extends('layouts.app')

@section('content')
    <div class="bg-light p-4 rounded">

        <div class="container mt-4">
            <h2>Edit Menu</h2>
            @if(count($errors) > 0)
				<div class="alert alert-danger">
					@foreach ($errors->all() as $error)
					{{ $error }} <br/>
					@endforeach
				</div>
            @endif

            <form method="POST" action="{{ route('menu.update', $menu['id']) }}" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $menu['name'] }}" 
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
                    <input value="{{ $menu['price'] }}" 
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
                    <input value="{{ $menu['stock'] }}" 
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
						<img width="250" src="{{ url('/uploads/images/'.$menu['image']) }}"><br><br>
						<input type="file" name="file">
					</div>
                </div>
                

                <button type="submit" class="btn btn-primary">Save changes</button>
                <a href="{{ route('menu.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection