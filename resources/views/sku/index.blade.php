@extends('../welcome')

@section('title') @lang('headers.skus') @endsection

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
    <h2>@lang('headers.skus')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('sku.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id_sku')</th>
            <th>@lang('tables.product')</th>
            <th>@lang('tables.price_for_once')</th>
            <th>@lang('tables.count_in_stoke')</th>
            <th>@lang('tables.property')</th>
            <th>@lang('tables.option')</th>
            <th></th>
        </tr>
        @foreach ($skus->data as $sku)
            <tr>
                <td><a href="{{ route('sku.show', $sku->id) }}" class="btn btn-info">{{ $sku->id }}</a></td>
                <td>{{ $sku->product->name }}</td>
                <td>{{ $sku->price }}</td>
                <td>{{ $sku->count }}</td>
                <td>
                    @foreach ($sku->product->properties as $property)
                        {{ $property->name }}<br/>
                    @endforeach
                </td>
                <td>
                    @foreach ($sku->product->properties as $property)
                        @if(isset($sku->options))
                            @foreach ($sku->options as $option)
                                @if ($option->property->id == $property->id)
                                    {{ $option->name }}
                                @endif
                            @endforeach
                        @else
                            -
                        @endif
                        <br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('sku.edit', $sku->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('sku.destroy', $sku->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach ($skus->meta->links as $link)
        @if (!is_null($link->url))
            <a href="{{ route('skuPage', substr($link->url, -1)) }}" style="border:1px solid silver; padding:4px; margin: 4px; border-radius:5px">
                {!! $link->label !!}
            </a>
        @endif
    @endforeach
@endsection