<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\Student;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestStudents extends BaseWidget
{
    protected static ?int $sort  =  2;

    protected int | string | array $columnSpan  = 'full';
    protected function getTableQuery(): Builder
    {
        return Student::query()
                        ->latest()
                        ->take(4);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('stdCourse.name')
                    ->sortable()
                    ->label('Student Course')
                    
                    ->searchable(),
                TextColumn::make('reg_no')
                    ->sortable()
                    ->label('Reg: Number')
                    ->searchable(),
                // TextColumn::make('first_name')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('last_name')
                //     ->sortable()
                //     ->searchable(),
                // TextColumn::make('email')
                //     ->sortable()                   
                //     ->searchable(),
                // TextColumn::make('mobile')
                //     ->sortable()
                //     ->searchable(),
                TextColumn::make('book_title')
                    ->sortable()                  
                    ->searchable(),
          
                
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
