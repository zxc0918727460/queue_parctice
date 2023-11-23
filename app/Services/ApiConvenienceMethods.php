<?php

namespace App\Services;

use Log;

trait ApiConvenienceMethods
{
    /**
     * 将本地帐号名称填充vendor_code 和各平台的prefix
     *
     * @param  [string] $username      [description]
     * @param  [string] $prefix        [description]
     * @param  [string] $vendor_code   [description]
     * @return [string]                [description]
     */
    public function paddingUsername($username, $prefix, $vendor_code)
    {
        return $prefix . $vendor_code . $username;
    }

    public function paddingSuffixUsername($username, $suffix)
    {
        return "{$username}{$suffix}";
    }

    public function getUserNameForThirdParty($username, $prefix, $vendor_code)
    {
        $username = $this->paddingUsername($username, $prefix, $vendor_code);
        $username = strtolower($username);
        return $username;
    }

    public function createResponseContent($info, $message = '', $extra_content = [])
    {
        $response = json_decode('{"result": {"info": 0, "msg": ""}}');
        $response->result->info = $info;
        $response->result->msg = $message;

        if (!empty($extra_content)) {
            foreach ($extra_content as $key => $value) {
                $response->result->$key = $value;
            }
        }

        return $response;
    }

    public function printRequestLog($className, $funcName, $request, $logTimestamp)
    {
        $SEP = ' | ';
        $apiPath = $request->path();
        $reqInput = json_encode($request->input(), JSON_UNESCAPED_UNICODE);
        Log::info("Request{$SEP}{$logTimestamp}{$SEP}{$funcName}{$SEP}{$apiPath}{$SEP}{$className}{$SEP}{$reqInput}");
    }

    public function printRequestDetailLog($method, string $url, string $headers, string $params, $logID)
    {
        $SEP = ' | ';
        Log::info("B2B to Third Party Request{$SEP}{$logID}{$SEP}{$method}{$SEP}{$url}{$SEP}Header => {$headers}{$SEP}Params => {$params}");
    }

    public function printResponseSuccessLog($httpCode, string $response, $logID)
    {
        $SEP = ' | ';
        if (strlen($response) > 500) { // 防止有些遊戲 ex: ezugi , 會回傳超大的response,會塞暴log
            $response = substr($response, 0, 500);
        }
        Log::info("Third Party to B2B Response{$SEP}{$logID}{$SEP}HTTP CODE => {$httpCode}{$SEP}Response => {$response}");
    }

    public function printResponseLog($className, $funcName, $response, $logTimestamp)
    {
        $SEP = ' | ';
        $content = $response->content();
        Log::info("Response{$SEP}{$logTimestamp}{$SEP}{$funcName}{$SEP}{$className}{$SEP}{$content}");
    }

    public function printLog($className, $funcName, $data)
    {
        $SEP = ' | ';
        if (is_object($data) || is_array($data))
            $data = json_encode($data);
        Log::info("{$funcName}{$SEP}{$className}{$SEP}{$data}");
    }
}
