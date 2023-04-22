<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Course;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CourseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CourseResource\RelationManagers;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Academics';

   

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('department_id')
                        // ->multiple()
                        ->relationship('dept', 'name')
                        ->preload(),
                    TextInput::make('code')
                        ->minLength(2)
                        ->maxLength(255) 
                        ->required() 
                        ->unique(ignoreRecord: true) ,
                    TextInput::make('name')
                        ->minLength(2)
                        ->maxLength(255) 
                        ->required() 
                        ->unique(ignoreRecord: true) ,
                    
                            ])
                        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                        ->sortable()
                        ->searchable(),
                TextColumn::make('name')
                        ->sortable()
                        ->searchable(),
                TextColumn::make('dept.name')
                        ->sortable()
                        ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }    

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
