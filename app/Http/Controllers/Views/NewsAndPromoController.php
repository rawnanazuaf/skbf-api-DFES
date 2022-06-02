<?php

namespace App\Http\Controllers\Views;

use App\Models\NewsPromo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class NewsAndPromoController extends Controller
{
    public function index(){
        return view('news_promo.NewsAndPromo');
    }

    public function store(Request $request){
        $user = auth()->user();
        // $name = $request->file('image')->getClientOriginalName();
        $id = NewsPromo::max('id') + 1;
        $file = $request->file('image');
        $extension = $file->extension();
        $name = 'news'.$id.".".$extension;
        $data = $request->file('image')->storeAs('public/files/news/', $name);
        $data = $request->all();
        $data['image'] = $name;
        $data['author'] = $user->id;
        $newspromo = NewsPromo::create($data);
        Alert::success('Good Joob', 'News Or Promo Created');
        return redirect('/news-promo');
    }
}
