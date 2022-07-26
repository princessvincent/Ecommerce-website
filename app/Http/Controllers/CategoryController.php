<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;

class CategoryController extends Controller
{
    public function index(){
$categ = category::all();
        return view('admin.category', compact('categ'));
    }

    public function add(){
return view('admin.addcat');
    }
    public function store(Request $request){
$cate = new category();
if(!$request->hasfile('image'))
{
    return No; 
    
}else{
    $file = $request->file('image');
    $ext = $file->getClientOriginalExtension();
    $filename = time(). ".". $ext;
    $file->move('img/category/', $filename);
   $cate->image =  $filename;
    // dd($request->image =  $filename);
}
$cate->name = $request->name;
$cate->slug = $request->slug;
$cate->description = $request->description;
// $cate->image = $request->image;
$cate->meta_title = $request->meta_title;
$cate->meta_descrip = $request->meta_descrip;
$cate->meta_keywords = $request->meta_keywords;
$cate->status = $request->input('status')== TRUE ? '1' : '0' ;
$cate->popular = $request->input('popular')== TRUE ? '1' : '0' ;

$cate->save();
if($cate->save()){
    return redirect()->back()->with('cat', 'Category has been save successfully!');
}else{
    return redirect()->back()->with('ca', 'Unable to save Category!');
}


    }

    public function editca($id){
$edit = category::find($id);
return view('admin.editcat', compact('edit'));
    }


    public function updaca(Request $request, $id){
$update = category::find($id);
// $file = $request->input('image');
// dd($request->hasFile('image'));
if($request->hasFile('image')){
  
   $path = 'img/category/'.$update->image;
   if(FacadesFile::exists($path))
   {
       FacadesFile::delete($path);
       // return true;
   }
   $file = $request->file('image');
//    dd($file);
   $ext = $file->getClientOriginalExtension();
   $filename = time().".".$ext;
 $file->move('img/category/', $filename);
  $update->image =  $filename;
}

$update->name = $request->name;
$update->slug = $request->slug;
$update->description = $request->description;
$update->meta_title = $request->meta_title;
$update->meta_descrip = $request->meta_descrip;
$update->meta_keywords = $request->meta_keywords;
$update->status = $request->input('status')== TRUE ? '1' : '0' ;
$update->popular = $request->input('popular')== TRUE ? '1' : '0' ;
$update->update();
if($update->update()){
    return redirect('cat')->with('upcat', "Category Has been Successfully Updated!");
}else{
    return redirect('cat')->with('upc', "Unable to Update Category!");
}
    }

    public function deletcat($id){
        $delcat = category::find($id);
        if($delcat->image){
            $pat = 'img/category/'.$delcat->image;
            if(FacadesFile::exists($pat)){
                FacadesFile::delete($pat);
            }

        }
        $delcat->delete();        
            return redirect('cat')->with('upcat', "Category Has been Successfully Deleted!");
        }
    }

