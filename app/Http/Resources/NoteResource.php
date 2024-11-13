<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,

            'created_at_simple' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'created_at_simple_string' => Carbon::parse($this->created_at)->toFormattedDateString(),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'created_at_ago' => Carbon::parse($this->created_at)->diffForHumans(),
            'created_at_string' => Carbon::parse($this->created_at)->toDayDateTimeString(),
            'updated_at_simple' => Carbon::parse($this->updated_at)->format('Y-m-d'),
            'updated_at_simple_string' => Carbon::parse($this->updated_at)->toFormattedDateString(),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
            'updated_at_ago' => Carbon::parse($this->updated_at)->diffForHumans(),
            'updated_at_string' => Carbon::parse($this->updated_at)->toDayDateTimeString(),
        ];
    }
}
