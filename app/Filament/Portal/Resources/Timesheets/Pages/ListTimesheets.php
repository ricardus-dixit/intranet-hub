<?php

namespace App\Filament\Portal\Resources\Timesheets\Pages;

use App\Filament\Portal\Resources\Timesheets\TimesheetResource;
use App\Models\Calendar;
use App\Models\Timesheet;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Auth;

use function Illuminate\Support\now;

class ListTimesheets extends ListRecords
{
    protected static string $resource = TimesheetResource::class;

    protected function getHeaderActions(): array
    {
        $lastTimesheet = Timesheet::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastTimesheet)
        {
            return [
                Action::make('inWork')
                    ->label('Enter')
                    ->color(Color::Teal)
                    ->requiresConfirmation()
                    ->action(function () {
                        $timesheet = Timesheet::create([
                            'calendar_id' => 2,
                            'user_id' => Auth::user()->id,
                            'type' => 'work',
                            'day_in' => now(),
                        ]);
                        $timesheet->save();
                    }),
            ];
        }

        return [
            Action::make('inWork')
                ->label('Enter')
                ->color(Color::Teal)
                ->requiresConfirmation()
                ->visible(!$lastTimesheet->day_out == null)
                ->disabled($lastTimesheet->day_out == null)
                ->action(function () {
                    $timesheet = Timesheet::create([
                        'calendar_id' => 2,
                        'user_id' => Auth::user()->id,
                        'type' => 'work',
                        'day_in' => now(),
                    ]);
                    $timesheet->save();
                })
                ->after(fn () => $this->redirect(request()->header('Referer'))),

            Action::make('stopWork')
                ->label('Stop Work')
                ->color(Color::Stone)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type != 'pause')
                ->disabled(!$lastTimesheet->day_out == null)
                ->requiresConfirmation()
                ->action(function () use ($lastTimesheet) {
                    $lastTimesheet->day_out = now();
                    $lastTimesheet->save();
                })
                ->after(fn () => $this->redirect(request()->header('Referer'))),

            Action::make('inPause')
                ->label('Pause')
                ->color(Color::Neutral)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type != 'pause')
                ->disabled(!$lastTimesheet->day_out == null)
                ->requiresConfirmation()
                ->action(function () use ($lastTimesheet) {
                    $lastTimesheet->day_out = now();
                    $lastTimesheet->save();

                    TimeSheet::create([
                        'calendar_id' => 2,
                        'user_id' => Auth::user()->id,
                        'type' => 'pause',
                        'day_in' => now(),
                    ]);
                })
                ->after(fn () => $this->redirect(request()->header('Referer'))),

            Action::make('stopPause')
                ->label('Stop Pause')
                ->color(Color::Mauve)
                ->visible($lastTimesheet->day_out == null && $lastTimesheet->type == 'pause')
                ->disabled(!$lastTimesheet->day_out == null)
                ->requiresConfirmation()
                ->action(function () use ($lastTimesheet) {
                    $lastTimesheet->day_out = now();
                    $lastTimesheet->save();
                })
                ->after(fn () => $this->redirect(request()->header('Referer'))),

            CreateAction::make(),
        ];
    }
}
