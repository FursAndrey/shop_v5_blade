@extends('../welcome')

@section('title') @lang('headers.products') @endsection

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
    <h2>@lang('headers.products')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('product.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id')</th>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.description')</th>
            <th>@lang('tables.category')</th>
            <th>@lang('tables.property')</th>
            <th></th>
        </tr>
        @foreach ($products->data as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="{{ route('product.show', $product->id) }}" class="btn btn-info">{{ $product->name }}</a></td>
                <td>
                    {{ $product->description }}
                </td>
                <td>
                    {{ $product->category->name }}
                </td>
                <td>
                    @foreach ($product->properties as $property)
                        {{ $property->name }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach ($products->meta->links as $link)
        @if (!is_null($link->url))
            <a href="{{ route('productPage', substr($link->url, -1)) }}" style="border:1px solid silver; padding:4px; margin: 4px; border-radius:5px">
                {!! $link->label !!}
            </a>
        @endif
    @endforeach
@endsection