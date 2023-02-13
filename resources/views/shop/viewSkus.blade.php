@extends('../welcome')

@section('title') viewProducts @endsection

@section('content')
    <main class="col ps-md-2 pt-2">
        <div class="row">
            @foreach ($skus->data as $sku)
                <div class="col-3 mb-3 mt-3">
                    <div class="border border-primary" style="height: 100%;">
                        <a href="{{ route('skuPage', $sku->id) }}" class="btn btn-info w-100">
                            {{ $sku->product->name }}
                        </a>
                        <p class="text-center">price: {{ $sku->price }}</p>
                        <p class="mb-0 text-center">params:</p>
                        @foreach ($sku->options as $option)
                            <p class="mb-0 text-center">{{ $option->property->name }}: {{ $option->name }}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection