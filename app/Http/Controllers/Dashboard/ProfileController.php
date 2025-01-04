<?php

namespace App\Http\Controllers\Dashboard;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function edit(){
         $user=Auth::user();
        return view('dashboard.profile.edit',[
            'user'=>$user,
            'countries'=>Countries::getNames('en'),
            'locales'=>Languages::getNames('en')
        ]);
    }

    public function update(Request $request)
    {

       $request->validate([
      'first_name'=>['required','string','max:255'],
       'last_name'=>['required','string','max:255'],
       'birthday'=>['nullable','date','before:today'],
       'image'=>[
                'image','mimes:jpg,png','max:1048576',
                'dimensions:min_width=100,min_height=100'
                 ],
       'gander'=>['in:male,female'],
       'country'=>['required','string','size:2']
       ]);
       $data=$request->except('image');
       $data['image']= $this->uploadImgae($request);

       $user=$request->user();
        $user->profile->fill($request->all())->save();
       return redirect()->route('dashboard.profile.edit')
          ->with('success','profile Updatd!');
     }
     protected function uploadImgae( Request $request)
     {

         if(!$request->hasFile('image')){
             return ;
         }
             $file=$request->file('image');
             $path=$file->store('uploads_profile',[
                 'disk'=>'public'
             ]);
             return $path;

     }
}
