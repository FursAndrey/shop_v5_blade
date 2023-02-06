@extends('../welcome')

@section('title') @lang('headers.options') @endsection

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
    <h2>@lang('headers.options')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('option.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id')</th>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.property')</th>
            <th></th>
        </tr>
        @foreach ($options->data as $option)
            <tr>
                <td>{{ $option->id }}</td>
                <td><a href="{{ route('option.show', $option->id) }}" class="btn btn-info">{{ $option->name }}</a></td>
                <td>
                    {{ $option->property->name }}
                </td>
                <td>
                    <a href="{{ route('option.edit', $option->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('option.destroy', $option->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach ($options->meta->links as $link)
        @if (!is_null($link->url))
            <a href="{{ route('optionPage', substr($link->url, -1)) }}" style="border:1px solid silver; padding:4px; margin: 4px; border-radius:5px">
                {!! $link->label !!}
            </a>
        @endif
    @endforeach
@endsection