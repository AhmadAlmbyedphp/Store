<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        Gate::authorize('products.view');
        $request= request();
        $products=Product::with(['category','store'])
        ->filter($request->query())
        ->paginate();
        return view('dashboard.products.index',compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('products.create');
        $categores =  Category::all();
        $product = new Product ();
        return view('dashboard.products.create',compact('product' ,'categores'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Gate::authorize('products.create');
        $request->validate(Product::rules(),[
            'name.required'=>'This field (:attribute) is required',
            'name.unique'=>'This is name already exists'
        ]);

        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data=$request->except('image');
        $data['image']= $this->uploadImgae($request);
        $product =Product::create($data);
        $seved= $product->save();
        if($seved){
            session()->flash('success','product cerated scssesfuly');
            return redirect()->route('dashboard.products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        Gate::authorize('products.view');

        return view('dashboard.products.show',
        [
            'product'=>$product

        ]);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('products.update');
        $product=Product::findOrFail($id);

       $tags= implode(',',$product->tags()->pluck('name')->toArray())  ;

        return view('dashboard.products.edit',compact('product','tags'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        Gate::authorize('products.update');

        $request->validate(Product::rules(),[
            'name.required'=>'This field (:attribute) is required',
            'name.unique'=>'This is name already exists'
        ]);
        $product->update( $request->except('tags') );
        $tags = json_decode($request->post('tags'));
        $tag_ids = [];

        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('dashboard.products.index')
               ->with('success','Product Updated !');
    }

    protected function uploadImgae( Request $request)
    {

        if(!$request->hasFile('image')){
            return ;
        }
            $file=$request->file('image');
            $path=$file->store('uploads_product',[
                'disk'=>'public'
            ]);
            return $path;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('products.delete');
        $product =Product::findOrFail($id);
        $product->delete();
        $seved= $product;
        if($seved){
            session()->flash('success','product delete scssesfuly');
            return redirect()->route('dashboard.products.index');
        }
    }
    public function trash(){
        $products=Product::onlyTrashed()->paginate();
        return view('dashboard.products.trash',compact('products'));
    }
    public function restore(Request $request,$id)
    {
        $product=Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.trash')
        ->with('success','product restoreed! ');
    }
    public function forceDelete($id)
    {
        $product=Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if( $product->image){
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('dashboard.products.trash')
        ->with('success','product delete scssesfuly!');
    }
}
