<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Department;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Academics';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('school_id')
                        // ->multiple()
                        ->relationship('schools', 'name')
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
                TextColumn::make('schools.name')
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }    

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
