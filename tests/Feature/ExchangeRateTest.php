<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExchangeRateTest extends TestCase
{
    /**
     * 測試匯率計算
     */
    public function testExchangeRateCalculation(): void
    {
        $requestData = [
            'source' => 'TWD',
            'target' => 'USD',
            'amount' => '$100.00',
        ];

        // 發送 GET 請求到 exchange 路由，並傳遞請求數據
        $response = $this->get('/exchange?'. http_build_query($requestData));

        // 驗證響應狀態碼，期望是 200 OK
        $response->assertStatus(200);

        // 驗證響應中是否包含預期的 JSON 數據
        $response->assertJson([
            'data' => [
                'msg' => 'success'
            ]
        ]);
    }

    /**
     * 測試錯誤的input格式
     */
    public function testExchangeFailInput(): void
    {
        $requestData = [
            'source' => 'TWDxcbxbc',
            'target' => 'UcbcSD',
            'amount' => '$100.00',
        ];

        // 發送 GET 請求到 exchange 路由，並傳遞請求數據
        $response = $this->get('/exchange?'. http_build_query($requestData));

        // 驗證響應狀態碼，期望是 200
        $response->assertStatus(200);

        // 驗證響應中是否包含預期的 JSON 數據
        $response->assertJson([
            'status_code' => 422
        ]);
    }
}
