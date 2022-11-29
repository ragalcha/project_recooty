<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\DB;
use App\Models\Customer;
use App\Models\Friends;
class ProjectController extends Controller
{
    function index()
    {
        return view('index');
        
    }

    function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required'
        ]);
        if($request->get('password')!=$request->get('cpassword'))
        {
            return redirect('/')->withSuccess('passsword is mish mech'); ;

        }
        else
        {
            $requestData = $request->all();
            Customer::create($requestData);
            return redirect('/')->withSuccess('Account created successfully'); ;
        }
    }

    function login(Request $request)
    {
      $keyword=$request->get('email');
      $info= Customer::where('email','LIKE',"%$keyword%")->get();
      $users= Customer::where('email','!=',"$keyword")->paginate($perPage); 
      $data=compact('info','users');
      $pass="";
      $notification=0;
      $perPage=8;
    
        foreach($info as $item)
      {
        $pass=$item->name;
        if($request->get('email')==$item->email && $request->get('password')==$item->password)
        {    
            session()->put('id',$item->id);
            session()->put('email',$item->email);
            session()->put('name',$item->name);

            $not=session('id');
            $frnd_list= DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
            $frnd_list=$frnd_list->where('status','=',1); 
            $req = DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
            $req=$req->where('status','<>',1);          
              foreach($req as $data)
            {
             $notification=$notification+1;
            }
            return view('home',compact('users','info','notification','req','frnd_list'));
        }
        else
        {
             return redirect('/')->withSuccess('envalied password'); 
        }
     }

         return redirect('/')->withSuccess('envalied user email'); 

    }

    function search(Request $request)
    {
      $perPage=8;
      $keyword=$request->get('search');
      $not=session('id');
      $info=Customer::where('email','LIKE',"%$keyword%")->get(); 
      $frnd_list= DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
      $frnd_list=$frnd_list->where('status','=',1); 
      $req = DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
      $req=$req->where('status','<>',1);  
       $notification=0;
      foreach($req as $data)
      {
       $notification=$notification+1;
      }
        if(!empty($keyword))
        {
            $users= Customer::where('email','LIKE',"%$keyword%")
                       ->orWhere('name','LIKE',"%$keyword%")->paginate($perPage);
            return view('home',compact('users','info','req','notification','frnd_list'));
        }

        
        return redirect('/home')->withSuccess('user not found'); 
    }

   public function friends($id)
    {
        $requestData['user_id']=session('id');
        $requestData['frnd_id']=$id;
        Friends::create($requestData);
        return redirect('/home')->withSuccess('request send successfully'); 
    }

    public function home()
    {   
        $keyword=session('email');
        $not=session('id');
        $perPage=8;
        $info=Customer::where('email','LIKE',"%$keyword%")->get();
        $users= Customer::where('email','!=',"$keyword")->paginate($perPage); 
        // $req = DB::table('customers')->join('friends','customers.id',"=",'friends.user_id') ->whereNot(function ($query) {
        //     $query->where('frnd_id','=',session('id'))
        //         ->orWhere('status', '<>', 1);
        // })->get();
        $frnd_list= DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
        $frnd_list=$frnd_list->where('status','=',1); 
        $req = DB::table('customers')->join('friends','customers.id',"=",'friends.user_id')->where('frnd_id','=',"$not")->get();
        $req=$req->where('status','<>',1);
       
        $notification=0;
        foreach($req as $data)
        {
         $notification=$notification+1;
        }
        return view('home',compact('info','req','users','notification','frnd_list'));
   
    }

    public function confirme($id)
    {
        DB::table('friends')
              ->where('id', $id)
              ->update(['status' => 1]);
        return redirect('/home')->withSuccess('add friend succesfully'); 
    }

    public function reject($id)
    {
        Friends::destroy($id);
        return redirect('/home')->withSuccess('friend request reject succesfully'); 
    }
    }