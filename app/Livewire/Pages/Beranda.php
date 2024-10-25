<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\TestCase;
use App\Models\TestSuite;
use App\Models\TestResult;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]

class Beranda extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $testResults = TestResult::with(['userPenugasan', 'status'])
            ->paginate(5, ['*'], 'testResultsPage'); // Paginate dengan namespace 'testResultsPage'
        
        $testCases = TestCase::with('testSuite', 'testResults')
            ->paginate(5, ['*'], 'testCasesPage'); // Paginate dengan namespace 'testCasesPage'

        $testSuites = TestSuite::with('project')
            ->paginate(5, ['*'], 'testSuitesPage'); // Paginate dengan namespace 'testSuitesPage'

        return view('livewire.pages.beranda', [
            'testResults' => $testResults,
            'testCases' => $testCases,
            'testSuites' => $testSuites,
        ]);
    }
}
