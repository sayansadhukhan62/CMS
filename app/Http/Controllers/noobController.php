<?php
namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;

use App\Http\Requests\CreateCategoryRequest;

use App\Http\Requests\UpdateCategoryRequest;

class noobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('noob.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noob.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
            Category::create([
            'name'=> $request->name
        ]);
        session()->flash('success','Category created succesfully');
        return redirect(route('noob.index'));
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
    // dd($id);
    $category=Category::findOrFail($id);
    return view('noob.create')->with('category',$category);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
      // dd($id);
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->update();

        session()->flash('success','Category updated succesfully');
        return redirect(route ('noob.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
       $category = Category::findOrFail($id);
       if ($category->posts()->count()>0) {
            session()->flash('error',"This Category can't be deleted");
            return redirect()->back();
        }
        else{
       $category -> delete();
       return redirect(route ('noob.index'));
        }
    }
}
