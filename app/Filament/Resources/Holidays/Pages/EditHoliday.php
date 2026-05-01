<?php

namespace App\Filament\Resources\Holidays\Pages;

use App\Filament\Resources\Holidays\HolidayResource;
use App\Mail\HolidayApprovedMail;
use App\Mail\HolidayRejectedMail;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EditHoliday extends EditRecord
{
    protected static string $resource = HolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        $dataToSend = [
            'name' => $record->user->name,
            'email' => $record->user->email,
            'day' => $record->day,
            'type' => ucfirst($record->type),
        ];

        if ($record->type === 'approved') {
            Mail::to($record->user->email)->send(new HolidayApprovedMail($dataToSend));
        }

        if ($record->type === 'rejected') {
            Mail::to($record->user->email)->send(new HolidayRejectedMail($dataToSend));
        }

        return $record;
    }
}
