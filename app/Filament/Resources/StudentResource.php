<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Student;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Records';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('course_id')
                        // ->multiple()
                        ->relationship('stdCourse', 'name')
                        ->label('Student Course')                       
                        ->preload(),
                    TextInput::make('reg_no')
                        ->maxLength(255) 
                        ->required() 
                        ->unique(ignoreRecord: true) ,
                    TextInput::make('first_name')
                        ->maxLength(255) 
                        ->required() ,
                    TextInput::make('middle_name')
                        ->maxLength(255)  ,
                    TextInput::make('last_name')
                        ->maxLength(255) 
                        ->required() ,
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true) 
                        ->maxLength(255) ,
                    TextInput::make('mobile')
                        ->tel()
                        ->required()
                        ->unique(ignoreRecord: true) 
                        ->maxLength(255) ,
                    TextInput::make('book_title')
                        ->required()
                        ->maxLength(255),                    
                    TextInput::make('book_number')
                        ->numeric()
                        ->required()
                        ->maxLength(255) ,
                    TextInput::make('author')
                        ->required()
                        ->maxLength(255) ,   

                ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('stdCourse.name')
                    ->sortable()
                    ->label('Student Course')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('reg_no')
                    ->sortable()
                    ->label('Reg: Number')
                    ->searchable(),
                TextColumn::make('first_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('last_name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()->wrap()
                    ->searchable(),
                TextColumn::make('mobile')
                    ->sortable()->wrap()
                    ->searchable(),
                TextColumn::make('book_title')
                    ->sortable()
                    ->wrap()
                    ->searchable(),
                TextColumn::make('book_number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('author')
                    ->sortable()->wrap()
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }    

    protected static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }
}
