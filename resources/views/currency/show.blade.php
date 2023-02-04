@extends('../welcome')

@section('title') @lang('headers.currencies') @endsection

@section('header_styles')
@endsection

@section('content')
    <h2>@lang('headers.currency') {{ $currency->code }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('currency.index') }}">@lang('btn.return_to_currencies')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id')</td>
            <td>{{ $currency->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.code')</td>
            <td>{{ $currency->code }}</td>
        </tr>
        <tr>
            <td>@lang('tables.rate')</td>
            <td>{{ $currency->rate }}</td>
        </tr>
    </table>
@endsection