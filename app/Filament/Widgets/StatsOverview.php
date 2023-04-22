<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Department;
use App\Models\School;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort  =  1;
    protected function getCards(): array
    {
        return [
            Card::make('Students', Student::count())
            ->description('21% increase')
            ->descriptionIcon('heroicon-s-trending-up')
             ->chart([7, 2, 10, 3, 15, 4, 17])
             ->color('danger'),

            Card::make('Courses', Course::count())
            ->description('7% increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->color('warning')
            ->chart([7, 2, 10, 3, 15, 4, 17]),
            
             Card::make('Departments', Department::count())
            ->description('3% increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),

            Card::make('Schools', School::count())
            ->description('8% increase')
            ->descriptionIcon('heroicon-s-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
        ];
    }
}
