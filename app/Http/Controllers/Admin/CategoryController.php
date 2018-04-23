<?php

namespace App\Http\Controllers\Admin;

use App\Common\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorys = Category::all();

        return response()->json($categorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('id');
        $category = Category::create($input);
        if ($category) {
            return response()->json([
                'status' => 'success',
                'msg' => '操作成功'
            ]);
        }

        return response()->json([
            'status' => 'error',
            'msg' => '操作失败'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Category::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return response()->json();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->except('id');
        $category = Category::find($id);
        if($category->update($input)){
            return response()->json([
                'status'=>'success'
            ]);
        }
        return response()->json([
            'status'=>'error'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        if(empty($request->ids)){
            return response()->json(['status' => 'error', 'info' => 'ID不能为空']);
        }
        $result = Category::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => !$result ? 'error' : 'success']);
    }

}
