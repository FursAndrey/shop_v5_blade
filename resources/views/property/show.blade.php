@extends('../welcome')

@section('title') @lang('headers.properties') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.property') {{ $property->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property.index') }}">@lang('btn.return_to_properties')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id')</td>
            <td>{{ $property->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name')</td>
            <td>{{ $property->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.products')</td>
            <td>
                @foreach ($property->products as $product)
                    {{ $product->name }}<br/>
                @endforeach
            </td>
        </tr>
        <tr>
            <td>@lang('tables.options')</td>
            <td>
                @foreach ($property->options as $option)
                    {{ $option->name }}<br/>
                @endforeach
            </td>
        </tr>
    </table>
@endsection