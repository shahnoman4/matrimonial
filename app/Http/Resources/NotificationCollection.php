<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Notification;
class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Notification $Notification) {
            return (new NotificationResource($Notification));
        });

        return parent::toArray($request);
    }
    public function with($request)
    {
        return [
            'success' => 1,
            'message' => 'Records found.'
        ];
    }
}
