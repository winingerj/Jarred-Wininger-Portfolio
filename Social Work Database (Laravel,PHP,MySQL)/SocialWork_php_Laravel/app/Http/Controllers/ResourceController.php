<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Resource;
use App\Provider;
use App\User;

use App\Http\Requests;


class ResourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:worker', ['only' => 'resourceList']);
        $this->middleware('role:GA', ['only' => ['addResource', 'storeResource', 'editResource']]);
    }

    public function resourceList()
    {
       
        $resources = DB::table('resources')->get();
        return view('resource.list',['resources' => $resources]);
    }

    public function addResource()
    {
        return view('resource.add');
    }

    public function storeResource(Request $request)
    {
    /*
         //store fields from form
        $type = Request::get('type');
        $subtype = Request::get('subtype');
        $description = Request::get('description');
        //store in database with incremented ID
        DB::table('resources')->insertGetId(['type'=>$type, 'subtype'=>$subtype, 'description'=>$description]);
        
        
        //return resource list view
        $resources = DB::table('resources')->get();
        return view('resource.list',['resources' => $resources]);
    */
    
       $resource = new Resource;
       $resource->type = $request->type;
       $resource->subtype = $request->subtype;
       $resource->description = $request->description;
       $resource->save();

       $message = "Resource added"; 
       return view('message', compact('message'));
     
    }    

    public function editResource($resourceID)
    {
        return view('resource.edit', compact('resourceID'));
    }


}
