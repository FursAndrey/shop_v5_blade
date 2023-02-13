@extends('../welcome')

@section('title') viewProducts @endsection

@section('content')
    <main class="col ps-md-2 pt-2">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3 mb-3 mt-3">
                    <a href="{{ route('productPage', $product->id) }}" class="btn btn-info w-100">{{ $product->name }}</a>
                </div>
            @endforeach
        </div>
    </main>
@endsection