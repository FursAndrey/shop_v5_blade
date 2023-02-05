@extends('../welcome')

@section('title') @lang('headers.create_update_option') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($option))
        <h2>@lang('headers.update_option') {{ $option->name }}</h2>
        <form action="{{ route('option.update', $option->id) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_option')</h2>
        <form action="{{ route('option.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">@lang('tables.name')</label>
            @error('name')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name" name="name" @isset($option) value="{{ $option->name }}" @endisset>
        </div>
        <div class="mb-3">
            <label for="property_id" class="form-label">@lang('tables.name')</label>
            <select name="property_id" class="form-select" id="property_id">
                @foreach ($properties as $property)
                    <option value="{{ $property->id }}" {{ (isset($option) && $option->property->id == $property->id)? 'selected': '' }}>{{ $property->name }}</option>
                @endforeach
            </select>
            @error('property_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        @csrf
        
        @if (isset($option))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('option.index') }}">@lang('btn.return_to_options')</a>
    </form>
@endsection