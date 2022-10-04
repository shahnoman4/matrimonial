<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\models\Interest;
class SendInterestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function (Interest $Interest) {
            return (new SendInterestResource($Interest));
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
