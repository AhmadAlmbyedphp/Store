<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Expectation;
use SebastianBergmann\Exporter\Exporter;

use function PHPUnit\Framework\returnSelf;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Gate::allows('categories.view')){
            abort(403);
        }
        $request= request();
        $categories=Category::with('parent')
        ->withCount('products')
        ->filter($request->query())
        ->orderBy('categories.id')
        ->paginate();
        return view('dashboard.categories.index',compact('categories'));

        // leftJoin('categories as parents',
        // 'parents.id','=',
        // 'categories.parent_id'
        //     )
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        //     ])
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        Gate::authorize('categories.create');
        $parents =Category::all();
        $category = new Category ();
        return view('dashboard.categories.create',compact('category','parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Gate::authorize('categories.create');
        $request->validate(Category::rules(),[
            'name.required'=>'This field (:attribute) is required',
            'name.unique'=>'This is name already exists'
        ]);

        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);

        $data=$request->except('image');
        $data['image']= $this->uploadImgae($request);
        $category =Category::create($data);
        $seved= $category->save();
        if($seved){
            session()->flash('success','category cerated scssesfuly');
            return redirect()->route('dashboard.categories.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(Category $category)
    {
        Gate::authorize('categories.view');
        return view('dashboard.categories.show',
        [
            'category'=>$category
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
        Gate::authorize('categories.update');
         try{
            $category =Category::findOrFail($id);
        }catch(Exception $e){
            return redirect()->route('dashboard.categories.index')
            ->with('info','Recore not  found!');
        }
        $parents =Category::where('id','<>',$id)
        ->where(function($query) use ($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','<>',$id );
        })->get();
        return view('dashboard.categories.edit',compact('category','parents'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        Gate::authorize('categories.update');
        $request->validate(Category::rules($id));

        $category =Category::findOrFail($id);
        $old_image=$category->image;
        $data=$request->except('image');
        $new_image=$this->uploadImgae($request);
       if($new_image){
        $data['image']=$new_image;
       }
        $category->update($data);
        //
        if($old_image && $new_image){
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categories.index')
        ->with('success','category update scssesfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Gate::authorize('categories.delete');
        $category = Category::findOrFail($id);
        $category->delete();
        $seved= $category;
        if($seved){
            session()->flash('success','category delete scssesfuly');
            return redirect()->route('dashboard.categories.index');
        }
    }

    protected function uploadImgae(Request $request){

        if(!$request->hasFile('image')){
            return ;
        }
            $file=$request->file('image');
            $path=$file->store('uploads_category',[
                'disk'=>'public'
            ]);
            return $path;

    }


    public function trash(){
        Gate::authorize('categories.view');
        $categories=Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash',compact('categories'));
    }
    public function restore(Request $request,$id){
        Gate::authorize('categories.view');
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category restoreed! ');
    }
    public function forceDelete($id){
        Gate::authorize('categories.view');
        $category=Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if( $category->image){
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')
        ->with('success','category delete scssesfuly!');
    }

}
