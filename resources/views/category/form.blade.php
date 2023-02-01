@extends('../welcome')

@section('title') @lang('headers.create_update_category') @endsection

@section('header_styles')
@endsection

@section('content')
    @if (isset($category))
        <h2>@lang('headers.update_category') {{ $category->name }}</h2>
        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @method('PUT')
    @else
        <h2>@lang('headers.create_category')</h2>
        <form action="{{ route('category.store') }}" method="POST">
    @endif
        <div class="mb-3">
            <label for="name" class="form-label">@lang('tables.name')</label>
            @error('name')
                <div class="error alert-danger p-3">{{ $message }}</div>
            @enderror
            <input type="text" class="form-control" id="name" name="name" @isset($category) value="{{ $category->name }}" @endisset>
        </div>
        @csrf
        
        @if (isset($category))
            <button type="submit" class="btn btn-primary">@lang('btn.update')</button>
        @else
            <button type="submit" class="btn btn-primary">@lang('btn.create')</button>
        @endif
        <a class="btn btn-success" href="{{ route('category.index') }}">@lang('btn.return_to_categories')</a>
    </form>
@endsection