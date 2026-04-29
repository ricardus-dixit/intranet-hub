<?php

namespace App\Filament\Portal\Widgets;

use App\Models\Holiday;
use App\Models\Timesheet;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PortalWidgetStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Pending', $this->getPendingHolidays(Auth::user()))
                ->description('32k increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Approved', $this->getApprovedHolidays(Auth::user()))
                ->description('7% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),

            Stat::make('Total Work', $this->getTotalWork(Auth::user()))
                ->description('3% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }

    protected function getPendingHolidays(User $user)
    {
        $totalPendingHolidays = Holiday::where('type', 'pending')
            ->where('user_id', $user->id)
            ->get()
            ->count();

        return $totalPendingHolidays;
    }

    protected function getApprovedHolidays(User $user)
    {
        $totalApprovedHolidays = Holiday::where('type', 'approved')
            ->where('user_id', $user->id)
            ->get()
            ->count();

        return $totalApprovedHolidays;
    }

    protected function getTotalWork(User $user)
    {
        $totalSeconds = Timesheet::where('type', 'work')
            ->where('user_id', $user->id)
            ->get()
            ->sum(function ($timesheet) {
                return $timesheet->day_out->diffInSeconds($timesheet->day_in);
            });

        $totalWork = gmdate("H:i:s", $totalSeconds);

        return $totalWork;
    }
}
