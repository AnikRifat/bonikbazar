<?php

namespace App\Http\Controllers;

use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchHistoryController extends Controller
{
    
    //store search history
    public function store($keyword){
        if($keyword){
            $search = new SearchHistory();
            $search->user_id = (Auth::check()) ? Auth::id() : null;
            $search->keyword = $keyword;
            $search->user_ip_address = $_SERVER['REMOTE_ADDR'];
            $search->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $search->save();
        }
        return true;
    }

    //list search history
    public function list(){
        
        $search_keywords = SearchHistory::orderBy('id', 'desc')->paginate(25);
        
        return view('admin.search_keywords')->with(compact('search_keywords'));
    }

    //delete search history
    public function delete($id){
        
        $search_keyword = SearchHistory::where("id", $id)->delete();
        
        return response()->json(["status" => true, "msg" => "Delete success"]);
    }
}
