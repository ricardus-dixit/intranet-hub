<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\Country;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('country_id')
                    ->label('Country')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('state_id')
                    ->label('State')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('city_id')
                    ->label('City')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('address')
                    ->label('Address')
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('postal_code')
                    ->label('Postal Code')
                    ->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
