<?php

namespace App\admin;
use DB;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $allow_image = array('png', 'jpg', 'jpeg', 'gif');

    public function getAll($table){
      return DB::table($table)->get();
    }

    public function getPermissions($id){
      $data =  Permissions::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getPermissionsView($id){
      $permissions = Permissions::select(array('permissions.*'));
      $permissions->where('permissions.id', $id);

      return $permissions->get()[0];

    }

    public function getUsers($id){
      $data =  Users::where('id', $id)->get();
      if(count($data)){
        return $data[0];
      } else{
        return array();
      }
    }

    public function getUsersView($id){
      $users = Users::select(array('users.*' , 'roles.name'));
      $users->where('users.id', $id);
      $users->leftJoin('roles', 'users.rol_id', '=','roles.id');
      return $users->get()[0];

    }

    public function changeStatus($field, $id){
      $users = $this->getUsers($id);
      if(count($users)){

            return true;
      } else{
        return false;
      }
    }

    public function updateStatus($id, $num){
      $users = $this->getUsers($id);
      if(count($users)){
        $users->status = $num;
        $users->save();
        return true;
      } else{
        return false;
      }
    }


    public function deleteOne($id){
      $users = $this->getUsers($id);
      if(count($users)){
        $img = public_path().'/uploads/'.$users->featured_img;
            if($users->featured_img!='' && file_exists($img)){
                unlink($img);
            }
            $users->delete();
        return true;
      } else{
        return false;
      }
    }

    public function getUsersData($per_page, $searchBy, $searchValue, $sortBy, $order){
      $users = Users::select(array('users.*' , 'roles.name AS rol'));

      //join
        $users->leftJoin('roles', 'users.rol_id', '=','roles.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $users->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        $users->where('users.status', '1');

        // sort option
        if($sortBy!='' && $order!=''){
          $users->orderBy($sortBy, $order);
        } else{
          $users->orderBy('users.id', 'desc');
        }

        return $users->paginate($per_page);
    }

    public function getUsersExport($searchBy, $searchValue, $sortBy, $order){
      $users = Users::select(array('users.*' , 'roles.name'));

      //join
        $users->leftJoin('roles', 'users.rol_id', '=','roles.id');

        // where condition
        if($searchBy!='' && $searchValue!=''){
          $users->where($searchBy, 'like', '%'.$searchValue.'%');
        }

        // sort option
        if($sortBy!='' && $order!=''){
          $users->orderBy($sortBy, $order);
        } else{
          $users->orderBy('users.id', 'desc');
        }
        return $users->get();
    }

    public function updateUsers($request){
      $id = $request->input('id');
      $users = Users::getUsers($id);
      if(count($users)){

        $password = $request->input('password')!="" ? $request->input('password') : "";
        $users->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
      	$users->rol_id = $request->input('rol_id')!="" ? $request->input('rol_id') : "";
      	$users->name = $request->input('name')!="" ? $request->input('name') : "";
      	$users->email = $request->input('email')!="" ? $request->input('email') : "";

        if($password != "") {

          $users->password = bcrypt( $password );

        }

      	$users->remember_token = $request->input('remember_token')!="" ? $request->input('remember_token') : "";
      	$users->updated_at = date('Y-m-d');
      	$users->status = $request->input('status')!="" ? $request->input('status') : "1";

          $users->save();
          return true;
      } else{
        return false;
      }
    }

    public function addUsers($request){
      $users = new Users;

      $password = $request->input('password')!="" ? $request->input('password') : "";
      $users->asesor_id = $request->input('asesor_id')!="" ? $request->input('asesor_id') : "";
    	$users->rol_id = $request->input('rol_id')!="" ? $request->input('rol_id') : "";
    	$users->name = $request->input('name')!="" ? $request->input('name') : "";
    	$users->email = $request->input('email')!="" ? $request->input('email') : "";
    	$users->password = bcrypt( $password );
    	$users->remember_token = $request->input('remember_token')!="" ? $request->input('remember_token') : "";
    	$users->created_at = date('Y-m-d');
    	$users->status = $request->input('status')!="" ? $request->input('status') : "1";

      $users->save();
      return true;

    }

    public function createUser($data){

      $users = new Users;

      $users->name            = $data['name'];
      $users->email           = $data['email'];
      $users->password        = bcrypt($data['password']);
      $users->rol_id          = $data['rol_id'];
      $users->asesor_id       = $data['asesor_id'];
      $users->api_token       = ' ';

      $users->save();

      return true;

    }

    public function upgradeUsers($data){

      $users = Users::getUsers($data['id']);

      $password = $data['password'];

      if(count($users)){

        $users->name = $data['name'];

        if(!empty($password)) {

          $users->password = bcrypt( $data['password'] );

        }

        $users->rol_id = $data['rol_id'];

        $users->asesor_id   = $data['asesor_id'];

        $users->created_at = date('Y-m-d');

        $users->save();

        return true;

      } else {

        return false;

      }

    }

}
