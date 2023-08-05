<?php

namespace App\Http\Resources;

use App\Http\Resources\expense\AttachmentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{

    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'accounting_code' => $this->accounting_code,
            'describe' => $this->describe,
            'date' => $this->date,
            'time' => $this->time,
            'value' => $this->value,
            'total_salary_paid' => $this->total_salary_paid,
            'total_expenses' => $this->total_expenses,
            'address' => $this->address,
            'job_title' => $this->job_title,
            'status' => $this->status,
            'in_progress' => $this->in_progress,
            'image' => url('attachments/expense/'.$this->id.'/'.$this->image),

            'client' => $this->client,
            'company' => $this->Company,
            'employee' => $this->employee,
            'team_id' => $this->team,
            'job_id' => $this->job,
            'project' => $this->project,
            'task' => $this->task,

            'attachments'=>AttachmentResource::collection($this->attachments),
        ];
    }
}
