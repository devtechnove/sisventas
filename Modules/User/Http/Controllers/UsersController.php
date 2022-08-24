<?php

namespace Modules\User\Http\Controllers;

use Modules\User\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Upload\Entities\Upload;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable) {
        abort_if(Gate::denies('access_user_management'), 403);

        return $dataTable->render('user::users.index');
    }


    public function create() {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('user::users.create');
    }


    public function store(Request $request) {
        abort_if(Gate::denies('access_user_management'), 403);



      if ($request->has('document')) {

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255|confirmed'
        ]);


        $file = $request->document;

        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);



        $fileName = strtotime(date('Y-m-d H:i:s'));
        $fileName = $fileName . '.' . $ext;

        $file->move(public_path('images/perfiles'), $fileName);

        $user = new User();
        $user->name      = $request->name;
        $user->image     = $fileName;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->password);
        $user->is_active = $request->is_active;
        $user->save();

        $user->assignRole($request->role);

        toast("Usuario creado y asignado '$request->role' Role!", 'success');
        return redirect()->route('users.index');

      }
      else
      {
            $user = new User();
            $user->name      = $request->name;
            //$user->image     = $fileName;
            $user->email     = $request->email;
            $user->password  = Hash::make($request->password);
            $user->is_active = $request->is_active;
            $user->save();

            $user->assignRole($request->role);

             toast("Usuario creado y asignado '$request->role' Role!", 'success');
            return redirect()->route('users.index');
      }

    }


    public function edit(User $user) {
        abort_if(Gate::denies('access_user_management'), 403);

        return view('user::users.edit', compact('user'));
    }


    public function update(Request $request, $id) {
        abort_if(Gate::denies('access_user_management'), 403);

           $user =  User::find($id);
           $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);

           if ($request->has('document')) {


             $file = $request->document;
             $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

             $fileName = strtotime(date('Y-m-d H:i:s'));
             $fileName = $fileName . '.' . $ext;

             $file->move(public_path('images/perfiles'), $fileName);

             $user->name      = $request->name;
             $user->image     = $fileName;
             $user->email     = $request->email;
             //$user->password  = Hash::make($request->password);
             $user->is_active = $request->is_active;
             $user->save();

               toast("Usuario modificado y asignado '$request->role' Role!", 'success');
             return redirect()->route('users.index');
           }
           else
           {
            //dd($request);
            $user->name      = $request->name;
            //$user->image     = $fileName;
            $user->email     = $request->email;
            //$user->password  = Hash::make($request->password);
            $user->is_active = $request->is_active;
            $user->save();

           $user->syncRoles($request->role);

            toast("Usuario modificado y asignado '$request->role' Role!", 'success');
          return redirect()->route('users.index');
       }




    }


    public function destroy(User $user) {
        abort_if(Gate::denies('access_user_management'), 403);

        $user->delete();

        toast('Usuario eliminado!', 'warning');

        return redirect()->route('users.index');
    }
}
