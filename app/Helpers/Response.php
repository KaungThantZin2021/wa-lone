<?php

function success(string $message = 'Success', array $data = []) {
    return [
        'result' => 1,
        'message' => $message,
        'data' => $data
    ];
}

function fail(string $message = 'Fail', array $data = []) {
    return [
        'result' => 0,
        'message' => $message,
        'data' => $data
    ];
}

function successJson(string $message = 'Success', array $data = []) {
    return response()->json([
        'result' => 1,
        'message' => $message,
        'data' => $data
    ]);
}

function failJson(string $message = 'Fail', array $data = []) {
    return response()->json([
        'result' => 0,
        'message' => $message,
        'data' => $data
    ]);
}

function successMessage(string $message = 'Success') {
    return [
        'result' => 1,
        'message' => $message,
    ];
}

function failMessage(string $message = 'Fail') {
    return [
        'result' => 0,
        'message' => $message,
    ];
}
