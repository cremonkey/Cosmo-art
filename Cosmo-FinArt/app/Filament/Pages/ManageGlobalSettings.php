<?php

namespace App\Filament\Pages;

use App\Settings\GlobalSettings;
use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use UnitEnum;
use BackedEnum;

class ManageGlobalSettings extends SettingsPage
{
    protected bool $hadMissingTemporaryUpload = false;

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return 'Settings';
    }

    protected static string $settings = GlobalSettings::class;

    protected function beforeValidate(): void
    {
        $this->sanitizeMissingTemporaryUpload('site_logo');
        $this->sanitizeMissingTemporaryUpload('favicon');
    }

    protected function afterSave(): void
    {
        if (! $this->hadMissingTemporaryUpload) {
            return;
        }

        Notification::make()
            ->warning()
            ->title('Some selected images expired')
            ->body('Please upload the image again if you want to replace the existing one.')
            ->send();

        $this->hadMissingTemporaryUpload = false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('General')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->required(),
                        self::secureImageUpload('site_logo', 'settings'),
                        self::secureImageUpload('favicon', 'settings')
                            ->helperText('Square image, ideally 32x32 or 64x64px'),
                    ])->columns(3),

                Section::make('SEO Settings')
                    ->schema([
                        Forms\Components\TextInput::make('seo_title')
                            ->label('Global SEO Title')
                            ->placeholder('e.g. Cosmo FinArt | Premium Regenerative Medicine'),
                        Forms\Components\Textarea::make('seo_description')
                            ->label('Global SEO Description')
                            ->rows(3),
                        Forms\Components\TagsInput::make('meta_keywords')
                            ->label('Global Keywords')
                            ->placeholder('New keyword...'),
                    ]),

                Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('contact_phone'),
                        Forms\Components\Textarea::make('address')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Footer')
                    ->schema([
                        Forms\Components\TextInput::make('copyright_text')
                            ->required(),
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

    private function sanitizeMissingTemporaryUpload(string $field): void
    {
        $state = data_get($this->data, $field);

        if (! $this->containsMissingTemporaryUpload($state)) {
            return;
        }

        $this->hadMissingTemporaryUpload = true;

        $currentValue = app(static::getSettings())->{$field} ?? null;
        data_set($this->data, $field, $currentValue);
    }

    private function containsMissingTemporaryUpload(mixed $value): bool
    {
        if ($value instanceof TemporaryUploadedFile) {
            return ! $value->exists();
        }

        if (! is_array($value)) {
            return false;
        }

        foreach ($value as $item) {
            if ($this->containsMissingTemporaryUpload($item)) {
                return true;
            }
        }

        return false;
    }
}
