<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    

    //CREATE NEW USER
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:11',
            'gender' => 'required',
            'home_address' => 'required|string|max:255',
            'state_of_origin' => 'required',
            'city' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $account_status = 'active'; //initialise account status to be active

        $user = new User();
        $user->user_id = bin2hex(openssl_random_pseudo_bytes(16));
        $user->first_name =  $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email; 
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->home_address = $request->home_address;
        $user->state_of_origin = $request->state_of_origin;
        $user->city = $request->city;
        $user->password = Hash::make($request->password); 
        $user->account_status = $account_status;
        $user->save();

        return response()->json(['message' => 'User Account Have Been Set Up Successfully'], 201);

    }

    //RETRIEVE ALL USERS
    public function index()
    {
        $users = User::all();
        return $users;
    }

    //RETRIEVE USER BY ID
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    //UPDATE USER RECORD
    public function update(Request $request, $id)
    {
        $validator =  Validator::make($request->all(), [
            'phone_number' => 'required|string|max:11',
            'gender' => 'required',
            'home_address' => 'required|string|max:255',
            'state_of_origin' => 'required',
            'city' => 'required',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::findOrFail($id);
        $user->phone_number = $request->phone_number;
        $user->gender = $request->gender;
        $user->home_address = $request->home_address;
        $user->state_of_origin = $request->state_of_origin;
        $user->city = $request->city;
        $user->password = Hash::make($request->password); 
        $user->save();
        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        if(!$user)
        {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json([
            'message' => 'User Deleted successfully'
        ], 200);
    }




}
