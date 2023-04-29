<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoResouces extends JsonResource
{
    public $status;
    public $message;

    public function __construct($status, $message, $resouce)
    {
        parent::__construct($resouce);
        $this->message = $message;
        $this->status = $status;
    }

    public function toArray($request)
    {
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource
        ];
    }
}
