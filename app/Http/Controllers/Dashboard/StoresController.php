<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('store.view');
        $request= request();
        $stores=Store::all();
        // ->filter($request->query())
        // -> paginate();
        return view('dashboard.stores.index',compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('store.create');
        $store= new Store;
        return view('dashboard.stores.create',
        ['store'=>$store]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Gate::authorize('store.create');

        $request->validate(Store::rules(),[
            'name.required'=>'This field (:attribute) is required',
        ]);
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data=$request->except('cover_image'&'logo_image');
        $data['logo_image']= $this->uploadImgaeLogo($request);
        $data['cover_image']= $this->uploadImgaeCover($request);
        $store = Store::create($data);
        $seved= $store->save();
        if($seved){
            session()->flash('success','stores cerated scssesfuly');
            return redirect()->route('dashboard.stores.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('store.update');
        $store=Store::findOrFail($id);

        return view('dashboard.stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Store $store)
    {
        Gate::authorize('store.update');

        $request->validate(Store::rules(),[
            'name.required'=>'This field (:attribute) is required',
        ]);
        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $old_imagecover=$store->cover_image;
        $logo_image=$store->logo_image;
        $data=$request->except('cover_image','logo_image');
        $new_cover=$this->uploadImgaeCover($request);
        $new_iogo=$this->uploadImgaeLogo($request);
       if($new_cover && $new_iogo){
        $data['cover_image']=$new_cover;
        $data['logo_image']=$new_iogo;
       }
       $store->update($data);

        $seved= $store->save();
        if($seved){
            session()->flash('success','stores update scssesfuly');
            return redirect()->route('dashboard.stores.index');
        }

    }

    protected function uploadImgaeCover( Request $request)
    {

        if(!$request->hasFile('cover_image')){
            return ;
        }
            $file=$request->file('cover_image');
            $path=$file->store('uploads_store/uploads_cover_store',[
                'disk'=>'public'
            ]);
            return $path;

    }

    protected function uploadImgaeLogo(Request $request)
    {

        if(!$request->hasFile('logo_image')){
            return ;
        }
            $file=$request->file('logo_image');
            $path=$file->store('uploads_store/uploads_logo_image',[
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
        Gate::authorize('store.delete');
        $store=Store::findOrFail($id);
        $store->delete();
        $seved= $store;
        if($seved){
            session()->flash('success','Store delete scssesfuly');
            return redirect()->route('dashboard.stores.index');
        }
    }
}
