<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \DB::table('users')->get();
        $msg = $users->isEmpty()?'暂无数据':'数据获取成功';

        return [
            'msg'   => $msg,
            'data'  => $users
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    => 'required | max:255',
            'email'   => 'required | email',
            'password'=> 'required | max:255'
        ]);

        $res = \DB::table('users')->insert([
                    'name'    => $request->input('name'),
                    'email'   => $request->input('email'),
                    'password'=> $request->input('password')
                ]);
        $msg = !$res?'暂无数据':'数据获取成功';

        return [
            'msg' => $msg,
            'data'=> $res
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = \DB::table('users')
                ->where('id', $id)
                ->get();
        $msg = $data->isEmpty()?'暂无数据':'获取数据成功';
        return [
            'msg' => $msg,
            'data' => $data
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'name'    => 'required | max:255',
            'email'   => 'required | email',
            'password'=> 'required | max:255'
        ]);

        $name    = $request->input('name');
        $email   = $request->input('email');
        $password= $request->input('password');
        $userIns =\DB::table('users')->where('id', $id)->get();

        dd($userIns);

        $sum = \DB::table('users')->where('id', $id)->update([
            'name'  => $name?$name:$userIns['name'],
            'email' => $email?$email:$userIns['email'],
            password=> $password?$password:$userIns['password']
        ]);
        $msg = !$sum?'更新数据失败':'更新数据成功';
        return [
            'msg' => $msg,
            'data'=> 'ok'
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = \DB::table('users')
                    ->where('id', $id)
                    ->delete();
        $msg = $deleted==0 ?'删除失败':'删除成功';
        return [
            'msg' => $msg
        ];
    }
}
