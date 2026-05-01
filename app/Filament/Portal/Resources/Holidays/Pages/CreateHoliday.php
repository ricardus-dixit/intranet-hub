<?php

namespace App\Filament\Portal\Resources\Holidays\Pages;

use App\Filament\Portal\Resources\Holidays\HolidayResource;
use App\Mail\HolidayPendingMail;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;
        $data['type'] = 'pending';

        $admin = User::find(2);
        $dataToSend = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'day' => $data['day'],
        ];

        Mail::to($admin)->send(new HolidayPendingMail($dataToSend));

        return $data;
    }
}
