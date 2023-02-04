@extends('../welcome')

@section('title') @lang('headers.currencies') @endsection

@section('header_styles')
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('warning'))
        <div class="alert alert-warning ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="alert alert-danger ">
            <p class="text-center">{{ $message }}</p>
        </div>
    @endif
    <h2>@lang('headers.currencies')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('currency.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id')</th>
            <th>@lang('tables.code')</th>
            <th>@lang('tables.rate')</th>
            <th></th>
        </tr>
        @foreach ($currencies->data as $currency)
            <tr>
                <td>{{ $currency->id }}</td>
                <td><a href="{{ route('currency.show', $currency->id) }}" class="btn btn-info">{{ $currency->code }}</a></td>
                <td>{{ $currency->rate }}</td>
                <td>
                    <a href="{{ route('currency.edit', $currency->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('currency.destroy', $currency->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach ($currencies->meta->links as $link)
        @if (!is_null($link->url))
            <a href="{{ route('currencyPage', substr($link->url, -1)) }}" style="border:1px solid silver; padding:4px; margin: 4px; border-radius:5px">
                {!! $link->label !!}
            </a>
        @endif
    @endforeach
@endsection