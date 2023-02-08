@extends('../welcome')

@section('title') @lang('headers.create_update_sku') @endsection

@section('content')
    @if (isset($sku))
        <h2>@lang('headers.update_sku') {{ $sku->id }}</h2>
        <form action="{{ route('sku.update', $sku->id) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_sku')</h2>
        <form action="{{ route('sku.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="product_id" class="form-label">@lang('tables.product')</label>
            <select name="product_id" class="form-select" id="product_id">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (isset($sku) && $sku->product->id == $product->id)? 'selected': '' }}>{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">@lang('tables.price_for_once')</label>
            @error('price')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="price" name="price" @isset($sku) value="{{ $sku->price }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="count" class="form-label">@lang('tables.count_in_stoke')</label>
            @error('count')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="count" name="count" @isset($sku) value="{{ $sku->count }}" @endisset>
        </div>
        @isset($sku)
            @php
                $options = [];
                foreach ($sku->options as $option) {
                    $options[] = $option->id;
                }
            @endphp

            @foreach ($props as $prop)
                <div class="mb-3">
                    <label for="option_id" class="form-label">@lang('tables.property') {{ $prop->name }}</label>
                    <select name="option_id[]" class="form-select" id="option_id">
                        @foreach ($prop->options as $option)
                            <option value="{{ $option->id }}" {{ (isset($sku) && in_array($option->id, $options))? 'selected': '' }}>{{ $option->name }}</option>
                        @endforeach
                    </select>
                    @error('option_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @endisset
        @csrf
        
        @if (isset($sku))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('sku.index') }}">@lang('btn.return_to_skus')</a>
    </form>
@endsection