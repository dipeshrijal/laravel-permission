<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PostsController extends Controller
{
    
    protected $post;
    
    protected $permission;
    
    function __construct(Post $post, Permission $permission) 
    {
        $this->middleware('auth');
        
        $this->post = $post;
        
        $this->permission = $permission;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $posts = $this->post->all();
        
        return view('posts.index', compact('posts'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post) 
    {
        return view('posts.form', compact('post'));;
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $this->post->create($request->all());
        
        $this->permission->create(['name' => 'edit posts']);
        
        return redirect(route('posts.index'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, User $user) 
    {
        $post = $this->post->findOrFail($id);
        
        $user = $user->findOrFail(auth()->user()->id);
        
        if ($user->can('edit posts')) 
        {
            return view('posts.form', compact('post'));
        } 
        else
        {
            abort('403', 'You do not have this permission');
        }
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
        $this->post->findOrFail($id)->fill($request->all())->save();
        
        return redirect(route('posts.index'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) 
    {
        
        //
        
        
    }
}
