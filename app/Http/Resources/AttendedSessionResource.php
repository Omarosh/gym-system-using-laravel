<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendedSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $date= explode(" ",$this->created_at);
        //    dd($this->session);
            return [
                'training session'=>new TrainingSessionResource($this->session),
                // 'gym'=>new TraineeResource($this->trainee),
                'attendance date'=>$date[0],
                'attendance time'=>$date[1],
                // 'description'=>$this->description,
                // 'user'=> new UserResource($this->user),
           
           ];
    }
}
