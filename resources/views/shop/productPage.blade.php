@extends('../welcome')

@section('title') @lang('headers.products') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.product') {{ $product->name }}</h2>
    <table class="table table-striped table-hover">
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
            <td>@lang('tables.skus')</td>
            <td>
                @foreach ($product->skus as $sku)
                    <p class="mb-0">
                        <a href="{{ route('skuPage', $sku->id) }}">
                            №{{ $sku->id }}
                        </a>
                    </p>
                    <p class="mb-0">{{ $sku->price }}BYN</p>
                    <p class="mb-0">{{ $sku->count }}ШТ</p>
                    @foreach ($sku->options as $option)
                        <p class="mb-0 text-center">{{ $option->property->name }}: {{ $option->name }}</p>
                    @endforeach
                @endforeach
            </td>
        </tr>
    </table>
@endsection