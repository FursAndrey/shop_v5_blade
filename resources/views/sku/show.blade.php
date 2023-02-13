@extends('../welcome')

@section('title') @lang('headers.sku') @endsection

@section('content')
    <h2>@lang('headers.sku') {{ $sku->id }}</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('sku.index') }}">@lang('btn.return_to_skus')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.value')</th>
        </tr>
        <tr>
            <td>@lang('tables.id_sku')</td>
            <td>{{ $sku->id }}</td>
        </tr>
        <tr>
            <td>@lang('tables.price_for_once')</td>
            <td>{{ $sku->price }}</td>
        </tr>
        <tr>
            <td>@lang('tables.count_in_stoke')</td>
            <td>{{ $sku->count }}</td>
        </tr>
        <tr>
            <td>@lang('tables.product')</td>
            <td>{{ $sku->product->name }}</td>
        </tr>
        <tr>
            <td><b>@lang('tables.property')</b></td>
            <td><b>@lang('tables.option')</b></td>
        </tr>
        @foreach ($sku->product->properties as $property)
            <tr>
                <td>{{ $property->name }}</td>
                <td>
                    @if(isset($sku->options))
                        @foreach ($sku->options as $option)
                            @if ($option->property->id == $property->id)
                                {{ $option->name }}
                            @endif
                        @endforeach
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    
    {{-- @dump($sku)
    @if(count($sku->images) > 0)
    @endif --}}
@endsection