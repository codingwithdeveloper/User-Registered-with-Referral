<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    function loadRegister(){
        return view('register');
    }
    function registered (Request $request){
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required|min:6|confimed',
        // ]);
        // dd($request);
        $referralCode = Str::random(10);
        
        if(isset($request->referral_code)){
            
            $userData = User::where('referral_code', $request->referral_code)->first();
            //return $userData;

            if(isset($userData)){
                

                $user_id = User::insertGetId([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'referral_code' => $referralCode,
                ]);
                // na kaj krsy na apni amak aktu details bolun ke 
                // ami video dissi aktu dakhan
                Network::insert([
                // DB::table('networks')->insert([
                    'referral_code'=>$request->referral_code,
                    'user_id'=>$user_id,
                    'parent_user_id'=>$userData->id,
                ]);

            }else{
                return back()->with('success');
            }
        }else{
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'referral_code' => $referralCode,
            ]);
        }
    }
}



// DB::beginTransaction();
// try {
//     $referralCode = Str::random(10);
//     if (isset($request->referral_code)) {
//         $userData = User::where('referral_code', $request->referral_code)->first();
//         if (isset($userData)) {
//             $user_id = User::insertGetId([
//                 'name' => $request->name,
//                 'email' => $request->email,
//                 'password' => Hash::make($request->password),
//                 'referral_code' => $referralCode,
//             ]);
//             Network::insert([
//                 // DB::table('networks')->insert([
//                 'referral_code' => $request->referral_code,
//                 'user_id' => $user_id,
//                 'parent_user_id' => $user_id,
//             ]);
//         } else {
//             return back()->with('success');
//         }
//     } else {
//         User::insert([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'referral_code' => $referralCode,
//         ]);
//     }
//     DB::commit();
//     return redirect()->back();
// } catch (Exception $th) {
//     DB::rollBack();
//     dd($th);
// }
// }