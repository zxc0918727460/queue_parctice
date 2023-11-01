<?php

function generatePermissionErrorResponse(){
    return response()->json([
        'status_code' => 403,
        'description' => trans('common.permission-denied'),
        'server_time' => strtotime('now'),
        'data'        => '',
    ], 403);
}

function generateSuccessResponse($data = '', $description = ''){
    $result = [
        'status_code' => 200,
        'description' => trans($description),
        'server_time' => strtotime('now'),
        'data'        => $data,
    ];
    return response()->json($result);
}

function generateFailedResponse($description){
    $result = [
        'status_code' => 201,
        'description' => trans($description),
        'server_time' => strtotime('now'),
    ];
    return response()->json($result);
}

function generateUnAuthroizeResponse($description){
    $result = [
        'status_code' => 401,
        'description' => $description,
        'server_time' => strtotime('now'),
        'data'        => '',
    ];
    return response()->json($result);
}

function generateOperationSuccessResponse(){
    $result = [
        'status_code' => 200,
        'description' => trans('common.operate-success'),
        'server_time' => strtotime('now'),
        'data'        => '',
    ];
    return response()->json($result);
}