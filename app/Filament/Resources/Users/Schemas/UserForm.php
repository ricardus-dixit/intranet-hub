<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\City;
use App\Models\State;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Info')
                    ->afterHeader(Action::make('Test button'))
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->hiddenOn('edit')
                            ->password()
                            ->required(),
                    ]),
                Section::make('Address Info')
                    ->schema([
                        Select::make('country_id')
                            ->label('Country')
                            ->relationship(name: 'country', titleAttribute: 'name')
                            ->afterStateUpdated(function(Set $set) {
                                $set('state_id', null);
                                $set('city_id', null);
                            })
                            ->searchable()
                            ->preload()
                            ->live(onBlur:true)
                            ->required(),

                        Select::make('state_id')
                            ->label('State')
                            ->options(fn(Get $get): Collection => 
                                State::query()
                                    ->where('country_id', $get('country_id'))
                                    ->pluck('name', 'id')
                            )
                            ->afterStateUpdated(fn($set) => $set('city_id', null))
                            ->searchable()
                            ->preload()
                            ->live(onBlur:true)
                            ->required(),

                        Select::make('city_id')
                            ->label('City')
                            ->options(fn(Get $get): Collection => 
                                City::query()
                                    ->where('state_id', $get('state_id'))
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                            ->live(onBlur:true)
                            ->required(),

                        TextInput::make('address')
                            ->label('Address')
                            ->required(),

                        TextInput::make('postal_code')
                            ->label('Postal Code')
                            ->required(),
                    ])
            ]);
    }
}
