@extends('../welcome')

@section('title') @lang('headers.categories') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.category') {{ $category->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('category.index') }}">@lang('btn.return_to_categories')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id')</td>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name')</td>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.products')</td>
            <td>
                @foreach ($category->products as $product)
                    {{ $product->name }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection