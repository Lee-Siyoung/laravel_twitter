<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // return new WelcomeEmail(auth()->user());   이메일 미리보기 할 때, 관리자 계정이 있다면 이걸로 확인 가능
        $ideas = Idea::orderBy('created_at', 'DESC');

        // where content like %test%
        if(request()->has('search')){
            $ideas = $ideas->where('content','like','%' . request()->get('search','') . '%');
        }


        return view('dashboard',[
            'ideas'=>$ideas->paginate(5)
        ]);
    }
}