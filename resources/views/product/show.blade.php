@extends('../welcome')

@section('title') @lang('headers.products') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.product') {{ $product->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.index') }}">@lang('btn.return_to_products')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id')</td>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name')</td>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.description')</td>
            <td>{{ $product->description }}</td>
        </tr>
        <tr>
            <td>@lang('tables.category')</td>
            <td>{{ $product->category->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.properties')</td>
            <td>
                @foreach ($product->properties as $property)
                    {{ $property->name }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection