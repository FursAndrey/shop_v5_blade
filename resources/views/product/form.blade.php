@extends('../welcome')

@section('title') @lang('headers.create_update_product') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($product))
        <h2>@lang('headers.update_product') {{ $product->name }}</h2>
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_product')</h2>
        <form action="{{ route('product.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">@lang('tables.name')</label>
            @error('name')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name" name="name" @isset($product) value="{{ $product->name }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">@lang('tables.description')</label>
            @error('description')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <textarea class="form-control" id="description" name="description" rows="3">@isset($product) {{ $product->description }} @endisset</textarea>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Категория</label>
            <select name="category_id" class="form-select" id="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (isset($product) && $product->category->id == $category->id)? 'selected': '' }}>{{ $category->id }} - {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="property_id" class="form-label">@lang('tables.property')</label>
            @php
                $oldProperties = [];
                if (null !== $product->properties) {
                    if (is_array($product->properties)) {
                        foreach ($product->properties as $property) {
                            $oldProperties[] = $property->id;
                        }
                    }
                }
            @endphp
            <select name="property_id[]" class="form-select" id="property_id" multiple size="5">
                @foreach ($properties as $property)
                <option value="{{ $property->id }}"
                    @if(null !== $product->properties)
                        @if(is_array($product->properties))
                            @selected(in_array($property->id, $oldProperties))
                        @endif
                    @endif 
                    >{{ $property->id }} - {{ $property->name }}</option>
                @endforeach
            </select>
            @error('property_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        @if (isset($product))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('product.index') }}">@lang('btn.return_to_products')</a>
    </form>
@endsection