@extends('../welcome')

@section('title') @lang('headers.options') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.option') {{ $option->name }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('option.index') }}">@lang('btn.return_to_options')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id')</td>
            <td>{{ $option->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.name')</td>
            <td>{{ $option->name }}</td>
        </tr>
        <tr>
            <td>@lang('tables.property')</td>
            <td>{{ $option->property->name }}</td>
        </tr>
    </table>
@endsection