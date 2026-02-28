<?php

namespace App\Filament\Pages;

use App\Settings\ProductPageSettings;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Pages\SettingsPage;
use UnitEnum;
use BackedEnum;

class ManageProductPageSettings extends SettingsPage
{
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-beaker';
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return 'Content';
    }

    protected static ?string $title = 'Product Page';

    protected static string $settings = ProductPageSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Banner Section')
                    ->schema([
                        Forms\Components\TextInput::make('banner_title')
                            ->required(),
                        Forms\Components\Textarea::make('banner_description')
                            ->required()
                            ->rows(3),
                    ]),

                Section::make('Footer Section')
                    ->schema([
                        Forms\Components\Textarea::make('disclaimer_text')
                            ->label('Disclaimer Text')
                            ->required()
                            ->rows(2),
                    ]),
            ]);
    }
}
