<?php

namespace App\Filament\Resources\Abouts\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AboutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Section')
                    ->schema([
                        TextInput::make('hero_title')
                            ->required(),
                        Textarea::make('hero_text')
                            ->columnSpanFull(),
                        self::secureImageUpload('hero_image', 'about'),
                    ]),

                Section::make('Philosophy Section')
                    ->schema([
                        TextInput::make('philosophy_subtitle'),
                        TextInput::make('philosophy_title')
                            ->required(),
                        Textarea::make('philosophy_content')
                            ->columnSpanFull(),
                        self::secureImageUpload('philosophy_image', 'about'),
                    ]),

                Section::make('Science Section')
                    ->schema([
                        TextInput::make('science_title')
                            ->required(),
                        Textarea::make('science_content')
                            ->columnSpanFull(),
                        self::secureImageUpload('science_image', 'about'),
                    ]),

                Section::make('Category Showcase (Homepage)')
                    ->schema([
                        TextInput::make('showcase_title'),
                        TextInput::make('showcase_subtitle'),
                        \Filament\Forms\Components\Toggle::make('is_visible')
                            ->label('Visibility')
                            ->default(true),
                    ]),

                Section::make('Product Page Banner')
                    ->schema([
                        TextInput::make('banner_title'),
                        Textarea::make('banner_description')
                            ->columnSpanFull(),
                        Textarea::make('disclaimer_text')
                            ->columnSpanFull(),
                    ]),

                Section::make('Infographics')
                    ->schema([
                        Repeater::make('infographics')
                            ->schema([
                                TextInput::make('title')->required(),
                                Textarea::make('description')->required(),
                                TextInput::make('icon')->placeholder('heroicon-o-lightning-bolt'),
                            ])
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    private static function secureImageUpload(string $name, string $directory): FileUpload
    {
        return FileUpload::make($name)
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
