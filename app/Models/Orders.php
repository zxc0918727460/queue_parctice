<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'Orders';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    public function createOrders($memberId, $ticketId)
    {
        try {
            // 創建新訂單
            $order = new self();
            $order->member_id = $memberId;
            $order->ticket_id = $ticketId;
            $order->save();

            // 返回創建的訂單
            return $order;
        } catch (\Exception $e) {
            // 處理可能出現的錯誤
            DB::rollback();
            return false;
        }
    }

    public static function checkOrderExists($memberId, $ticketId)
    {
        // 檢查是否存在匹配的記錄
        $exists = self::where('member_id', $memberId)
                      ->where('ticket_id', $ticketId)
                      ->exists();

        return $exists;
    }
}
