<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\models\ChatRoomFeed;
class ChatRoomFeedCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (ChatRoomFeed $ChatRoomFeed) {
            return (new ChatRoomFeedResource($ChatRoomFeed));
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
