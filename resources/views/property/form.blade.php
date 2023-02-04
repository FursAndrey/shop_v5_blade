@extends('../welcome')

@section('title') @lang('headers.create_update_property') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($property))
        <h2>@lang('headers.update_property') {{ $property->name }}</h2>
        <form action="{{ route('property.update', $property->id) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_property')</h2>
        <form action="{{ route('property.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">@lang('tables.name')</label>
            @error('name')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name" name="name" @isset($property) value="{{ $property->name }}" @endisset>
        </div>
        @csrf
        
        @if (isset($property))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('property.index') }}">@lang('btn.return_to_properties')</a>
    </form>
@endsection