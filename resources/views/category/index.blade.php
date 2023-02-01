@extends('../welcome')

@section('title') @lang('headers.categories') @endsection

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
    <h2>@lang('headers.categories')</h2>
    <a class="btn btn-success mt-2 mb-2" href="{{ route('category.create') }}">@lang('btn.create')</a>
    <table class="table table-striped table-hover">
        <tr>
            <th>@lang('tables.id')</th>
            <th>@lang('tables.name')</th>
            <th>@lang('tables.products')</th>
            <th></th>
        </tr>
        @foreach ($categories->data as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('category.show', $category->id) }}" class="btn btn-info">{{ $category->name }}</a></td>
                <td>
                    @foreach ($category->products as $product)
                        {{ $product->name }}<br/>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning d-inline-block">@lang('btn.update')</a>
                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">@lang('btn.delete')</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- {{ $categories->links() }} --}}
@endsection