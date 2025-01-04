<div class="single-category">
    <h3 class="heading">{{$category->name}}</h3>
    <ul>
        @php
        $product = $category->products()->latest()->paginate(4);
        @endphp
        @foreach ($product as $product )
        <li><a href="{{ route('products.shew',$product->slug) }}">{{$product->name}}</a></li>
        @endforeach
    </ul>
    <div class="images">
        <img style="width: 190px ; height:190px ;"
        src="{{Storage::url($category->image)}}" alt="">
    </div>
</div>
<!-- End Single Category -->
