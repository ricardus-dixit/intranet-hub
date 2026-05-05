<?php

namespace App\Filament\Portal\Resources\Holidays;

use App\Filament\Portal\Resources\Holidays\Pages\CreateHoliday;
use App\Filament\Portal\Resources\Holidays\Pages\EditHoliday;
use App\Filament\Portal\Resources\Holidays\Pages\ListHolidays;
use App\Filament\Portal\Resources\Holidays\Schemas\HolidayForm;
use App\Filament\Portal\Resources\Holidays\Tables\HolidaysTable;
use App\Models\Holiday;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDateRange;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return HolidayForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HolidaysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListHolidays::route('/'),
            'create' => CreateHoliday::route('/create'),
            'edit' => EditHoliday::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }

    public static function getNavigationBadge(): ?string
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::user()->id)
            ->where('type', 'pending')
            ->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'The number of pending holidays';
    }
}
