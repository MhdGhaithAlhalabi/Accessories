<?php

namespace App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use GeneralTrait;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer-api', ['except' => ['login','register']]);
    }
    public function login(Request $request)
    {

        try {
            $rules = [
                "phone" => "required",
                "password" => "required",
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return $this->returnValidationError( $validator->getMessageBag());
            }

            //login

            $credentials = request(['phone', 'password']);

            $token = Auth::guard('customer-api')->attempt($credentials);

            if (!$token)
                return $this->returnError( 'بيانات الدخول غير صحيحة');

           // $customer = Auth::guard('customer-api')->user();
          //  $customer->api_token = $token;
            //return token
            return $this->returnData('token', $token);

        } catch (Exception $ex) {
            return $this->returnError($ex->getMessage());
        }


    }
    public function register(Request $request){
        $rules = [
            'name' => ['required','string','max:255'],
            'phone' =>[ 'required','string','max:255','unique:customers'],
            'password' => ['required','string','min:6'],
            'city'=>['required']
        ];

        $validator = Validator::make($request->all(), $rules);
if($validator->fails()){
    return $this->returnValidationError( $validator->getMessageBag());
}
        $customer = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'city'=>$request->city
        ]);

        $token = Auth::guard('customer-api')->login($customer);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $customer,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    public function editProfile(Request $request){
        $rules = [
            'name' => ['required','string','max:255'],
            'city'=>['required']
        ];

        $validator = Validator::make($request->all(), $rules);
if($validator->fails()){
    return $this->returnValidationError( $validator->getMessageBag());
                }
        $customer = Customer::findOrFail($request->customer_id);
        $customer->update($request->all());


        return $this->returnSuccessMessage('User edit successfully');
    }

    public function destroy(Request $request){
        $customer = Customer::findOrFail($request->customer_id);
        $customer->delete();
       return $this->returnSuccessMessage('customer deleted');

    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
       auth()->logout(true);
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
