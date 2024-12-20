<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Condidat;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Hash;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\DB;
class PassportAuthController extends Controller
{
    /**
     * Register
     */
    public function register(Request $request)
    {   
    
        $validator = Validator::make(request()->all(), [
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'min:6',
            'role'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
  if($request->role == 'entreprise'){
            $this->validate($request, [
                'nom_entreprise' => 'required',
                'tel' => 'required',
                'region' => 'required',
                'secteur' => 'required',

            ]);
        }elseif($request->role == 'candidat'){
 
            $validator = Validator::make(request()->all(), [
                'tel' => 'required|string',
                'civilite' => 'required',
                'date_de_naissance' => 'required|date',
                'region' => 'required',
                
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        } 
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        
        $user = User::create($input); 
        $user->role = $request->role;
        $token = $user->createToken('myapp')->accessToken;
        //inscription entreprise
        if($request->role == 'entreprise')
        {
            $input['region_id'] =$request->region;
            $input['secteur_id'] =$request->secteur;
            $input['user_id'] =$user->id;
            $user = Entreprise::create($input); 
        
        }  //inscription candidat
        elseif($request->role == 'candidat'){
            $input['user_id'] =$user->id;
            $input['secteur_id'] =$request->secteur;
            $input['region_id'] =$request->region;
            $user = Condidat::create($input);  
        }
        return response()->json(['token' => $token], 200);
        
    }
    /**
     * Login
     */
    public function login(Request $request)
    {
       
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token, 'user'=>auth()->user(), 'role'=>auth()->user()->role], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }   
    /**
     * Logouy
     */
    public function logout(Request $request)
    {
        auth()->user()->token()->revoke();

        if ($request->everywhere) {
            foreach ($request->user()->tokens()->whereRevoked(0)->get() as $token) {
                $token->revoke();
            }
        }
    
        return response()->json(['message' => 'success']);
    }
    /**
     * User info
     */
    
    public function whoami()
    {
        $user = auth()->user();
        return  response()->json(
            [
                "data" => [
                    "message" => "Success",
                    "data" => new UserResource($user),
                ],
            ],
            200
        );
        
    }
    /**
     * User info
     */
    public function profile()
    {
        return auth('api')->user();
    }
   
    /**
     * Password Update
     */
    public function change_password(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'old_password'=>'required',
            'password'=>'required|min:6',
            "password_confirmation"=> 'reequired|same:password',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>'validations fails',
                'errors'=>$validator->errors()
            ],422);
        }
        $user=$request->user();
        if(Hash::check($request->old_password, $user->password)){
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
            return response()->json([
                'message'=>'password updated',
            ],200);
        }else{
            return response()->json([
                'message'=>'old password does not match',
            ],400);
        }
    }
    /**
     * Email Update
     */
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'email'=>'required|email|string|max:255',
            'password'=>'required|min:6',
        ]);
        $user =Auth::user();
        $user_id=$user->id;
        if(Hash::check($request->password, $user->password))
        {
            $user->email = $request['email'];
        }else{
            return response()->json([
                'message'=>'you can not change email',
            ],400);
        }
        if ($user->role=='entreprise')
        {
            $this->validate($request, [
                'nom_entreprise' => 'required',
                'tel' => 'required|string',
                'adresse' => 'required|string',
                'description' => 'required|string',
                'categorie' => 'required|not_in:--Secteur--',

            ]);
            $entreprise=Entreprise::where(['user_id'=>$user_id]);
            $entreprise->update($request->all());
            

        }elseif($user->role=='condidat')
        {
            $this->validate($request, [
            
                'civilite' => 'required|not_in:--Civilité--',
                'date_de_naissance' => 'required|date|date_format:Y-m-d|before:'.now()->subYears(18)->toDateString(),
                'gouvernorat' => 'required|not_in:--Gouvernorat--',
            ]);
            $condidat=Condidat::where(['user_id'=>$user_id]);
            $condidat->update($request->all());
            
        }
        return response()->json([
            "success" => true,
            "message" => "profile updated",
            ]);
        
    }

}