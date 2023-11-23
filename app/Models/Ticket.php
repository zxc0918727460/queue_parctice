<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket';

    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';

    // 實作 takeTicket 方法
    public function takeTicket($ticketId)
    {
        // 根據 ticketId 查找票務
        $ticket = self::find($ticketId);

        // 檢查是否找到票務，並且票數大於 0
        if ($ticket && $ticket->ticket_amount > 0) {
            // 減少票數
            $ticket->ticket_amount -= 1;
            // 儲存變更
            $ticket->save();
            return true;
        }

        // 如果沒有找到票務或票數為 0，則返回錯誤
        return false;
    }
}