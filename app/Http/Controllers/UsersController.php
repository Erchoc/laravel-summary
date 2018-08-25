<?php

namespace App\Http\Controllers;

use Validator;
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
        $arr = ['name'=> 'yangxuejin'];
        return $arr;
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
        dd($request->all());
        $this->validate($request, [
            'name'    => 'required | max:255',
            'email'   => 'required | email',
            'password'=> 'required | max:255'
        ]);

        $res = \DB::table('users')->insertGetId([
                    'name'    => $request->input('name'),
                    'email'   => $request->input('email'),
                    'password'=> $request->input('password')
                ]);
        $msg = ($res==true)?'数据插入成功':'暂无数据';

        return [
            'msg' => $msg,
            'data'=> \DB::table('users')->where('id', $res)->get()
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
        $rule = [
            'name'    => 'required',
            'email'   => 'required|email',
            'password'=> 'required'
        ];
        $message = [
            'name.required'     => '姓名不允许为空',
            'email.required'    => '邮箱不允许为空',
            'email.email'       => '邮箱验证不通过',
            'password.required' => '密码不允许为空',
        ];
        $validate = Validator::make($request->all(), $rule, $message);
        if ($validate->fails()) {
            $msg = '验证不通过';
            return [
                'msg' => $msg
            ];
        }

        $name    = $request->input('name');
        $email   = $request->input('email');
        $password= $request->input('password');

        $userIns =\DB::table('users')->where('id', $id)->get();
        if ($userIns->isEmpty()) {
            $msg = '未查询到相关数据';
        } else {
            $sum = \DB::table('users')->where('id', $id)->update([
                'name'    => $name?$name:$userIns['name'],
                'email'   => $email?$email:$userIns['email'],
                'password'=> $password?$password:$userIns['password']
            ]);
            $msg = ($sum==true)?'更新数据成功':'修改失败';
            $data = \DB::table('users')->where('id', $id)->get();
        }

        return [
            'msg' => $msg,
            'data'=> $data
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
