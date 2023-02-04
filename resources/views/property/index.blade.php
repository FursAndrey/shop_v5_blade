@extends('../welcome')

@section('title') @lang('headers.properties') @endsection

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
    <h2>@lang('headers.properties')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('property.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id')</th>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.products')</th>
            <th>@lang('tables.options')</th>
            <th></th>
        </tr>
        @foreach ($properties->data as $property)
            <tr>
                <td>{{ $property->id }}</td>
                <td><a href="{{ route('property.show', $property->id) }}" class="btn btn-info">{{ $property->name }}</a></td>
                <td>
                    @foreach ($property->products as $product)
                        {{ $product->name }}<br/>
                    @endforeach
                </td>
                <td>
                    @foreach ($property->options as $option)
                        {{ $option->name }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('property.edit', $property->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('property.destroy', $property->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach ($properties->meta->links as $link)
        @if (!is_null($link->url))
            <a href="{{ route('propertyPage', substr($link->url, -1)) }}" style="border:1px solid silver; padding:4px; margin: 4px; border-radius:5px">
                {!! $link->label !!}
            </a>
        @endif
    @endforeach
@endsection