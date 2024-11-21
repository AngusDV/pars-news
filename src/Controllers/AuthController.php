<?php

namespace AngusDV\ParsNews\Controllers;


use AngusDV\ParsNews\Entity\ApiUser;
use AngusDV\ParsNews\Requests\API\V1\AuthRequest;
use AngusDV\ParsNews\Resources\API\V1\ApiUserResource;
use AngusDV\ParsNews\Resources\BaseResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function login(AuthRequest $request)
    {
        try {
            $user = ApiUser::where('email',$request->email)->firstOrFail();
            if(!$user->isApi()){
                return  BaseResource::falseResponse(__('ParsNews::parsnews.username_or_password_is_wrong'));
            }
            if(!password_verify($request->password,$user->password)){
                return  BaseResource::falseResponse(__('ParsNews::parsnews.username_or_password_is_wrong'));
            }

            return new ApiUserResource($user, 'Bearer ' . $user->createToken("api",
                        [
                            "fcm" => "{$request->input("fcmToken")}",
                            "device" => "{$request->input("device","android")}"
                        ])->plainTextToken);


        }catch (ModelNotFoundException $e){
            return  BaseResource::falseResponse(__('ParsNews::parsnews.username_or_password_is_wrong'));
        }

    }
}
