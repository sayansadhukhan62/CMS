<?php
namespace App\Http\Controllers;

use App\tag;

use Illuminate\Http\Request;

use App\Http\Requests\Tags\CreateTagRequest;

use App\Http\Requests\Tags\UpdateTagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {
            Tag::create([
            'name'=> $request->name
        ]);
        session()->flash('success','Tag created succesfully');
        return redirect(route('tag.index'));
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
    $tag=Tag::findOrFail($id);
    return view('tag.create')->with('tag',$tag);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, $id)
    {
      // dd($id);
        $tag=Tag::findOrFail($id);
        $tag->name=$request->name;
        $tag->update();

        session()->flash('success','Tag updated succesfully');
        return redirect(route ('tag.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $tag = Tag::findOrFail($id);
         if ($tag->posts()->count()>0) {
            session()->flash('error',"This Tag can't be deleted");
            return redirect()->back();
        }else{
       $tag -> delete();
       return redirect(route ('tag.index'));
        }
    }
}
