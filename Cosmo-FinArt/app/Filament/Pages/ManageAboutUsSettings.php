<?php

namespace App\Filament\Pages;

use App\Settings\AboutUsSettings;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use UnitEnum;
use BackedEnum;

class ManageAboutUsSettings extends SettingsPage
{
    protected static bool $shouldRegisterNavigation = false;

    public static function canAccess(): bool
    {
        return false;
    }

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-information-circle';
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return 'Content';
    }

    protected static ?string $title = 'About Us Page';

    protected static string $settings = AboutUsSettings::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('Hero Section')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')
                            ->required(),
                        self::secureImageUpload('hero_image', 'about'),
                    ])->columns(2),

                Section::make('Philosophy Section')
                    ->schema([
                        Forms\Components\TextInput::make('philosophy_title')
                            ->required(),
                        Forms\Components\Textarea::make('philosophy_content')
                            ->required()
                            ->rows(5),
                        self::secureImageUpload('philosophy_image', 'about'),
                    ]),

                Section::make('Science Section')
                    ->schema([
                        Forms\Components\TextInput::make('science_title')
                            ->required(),
                        Forms\Components\Textarea::make('science_content')
                            ->required()
                            ->rows(5),
                        self::secureImageUpload('science_image', 'about'),
                    ]),
            ]);
    }

    private static function secureImageUpload(string $name, string $directory): Forms\Components\FileUpload
    {
        return Forms\Components\FileUpload::make($name)
            ->image()
            ->disk('public')
            ->directory($directory)
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
            ->maxSize(5120)
            ->getUploadedFileNameForStorageUsing(
                fn (TemporaryUploadedFile $file): string => sprintf(
                    '%s.%s',
                    (string) Str::uuid(),
                    $file->guessExtension() ?: $file->extension()
                )
            );
    }
}
