<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use UnitEnum;
use BackedEnum;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';
    
    protected static string|UnitEnum|null $navigationGroup = 'Catalog';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Section::make('General Details')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->unique(Product::class, 'slug', ignoreRecord: true),
                        Forms\Components\TextInput::make('clinical_focus')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Descriptions')
                    ->schema([
                        Forms\Components\Textarea::make('short_description')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),

                Section::make('Technical Details')
                    ->schema([
                        Forms\Components\Repeater::make('benefits')
                            ->simple(Forms\Components\TextInput::make('benefit'))
                            ->reorderableWithButtons()
                            ->collapsible(),
                        Forms\Components\Repeater::make('composition')
                            ->schema([
                                Forms\Components\TextInput::make('name')->required(),
                                Forms\Components\TextInput::make('description'),
                            ])
                            ->columns(2)
                            ->label('Composition / Ingredients')
                            ->reorderableWithButtons()
                            ->collapsible(),
                    ])->columns(2),

                Section::make('Application Protocols')
                    ->schema([
                        Forms\Components\Textarea::make('protocol_summary')
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('protocol_details')
                            ->schema([
                                Forms\Components\TextInput::make('step')->required(),
                                Forms\Components\Textarea::make('value')->required(),
                            ])
                            ->columns(2)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active on Site')
                            ->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Feature on Homepage')
                            ->default(false),
                    ])->columns(2),

                Section::make('Media')
                    ->schema([
                        Forms\Components\FileUpload::make('featured_image')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('products')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => sprintf(
                                    '%s.%s',
                                    (string) Str::uuid(),
                                    $file->guessExtension() ?: $file->extension()
                                )
                            )
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('gallery')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('products')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->maxSize(5120)
                            ->getUploadedFileNameForStorageUsing(
                                fn (TemporaryUploadedFile $file): string => sprintf(
                                    '%s.%s',
                                    (string) Str::uuid(),
                                    $file->guessExtension() ?: $file->extension()
                                )
                            )
                            ->columnSpanFull()
                            ->reorderable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
