<?php

namespace App\Filament\Pages;

use App\Settings\CategoryPageSettings;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Pages\SettingsPage;
use UnitEnum;
use BackedEnum;

class ManageCategoryPageSettings extends SettingsPage
{
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-squares-2x2';
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return 'Content';
    }

    protected static ?string $title = 'Category Showcase';

    protected static string $settings = CategoryPageSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Showcase Configuration')
                    ->schema([
                        Forms\Components\Toggle::make('is_visible')
                            ->label('Visible on Homepage')
                            ->default(true),
                        Forms\Components\TextInput::make('showcase_subtitle')
                            ->label('Section Subtitle (e.g., Our Focus)')
                            ->required(),
                        Forms\Components\TextInput::make('showcase_title')
                            ->label('Section Title (e.g., Pioneering Solutions)')
                            ->required(),
                    ]),
            ]);
    }
}
