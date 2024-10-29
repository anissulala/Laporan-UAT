<?php

namespace App\Livewire\Pages;

use App\Models\MStatus;
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

    public function getChartData()
    {
        // Hitung jumlah test results, test cases, dan test suites
        $testResultCount = TestResult::count();
        $testCaseCount = TestCase::count();
        $testSuiteCount = TestSuite::count();

        // Menyiapkan data untuk chart
        $chartData = [
            ['label' => 'Test Results', 'total' => $testResultCount],
            ['label' => 'Test Cases', 'total' => $testCaseCount],
            ['label' => 'Test Suites', 'total' => $testSuiteCount],
        ];

        return $chartData;
    }

    public function render()
    {
        $testResults = TestResult::with(['userPenugasan', 'status'])
            ->paginate(5, ['*'], 'testResultsPage'); // Paginate dengan namespace 'testResultsPage'

        $testCases = TestCase::with('testSuite', 'testResults')
            ->paginate(5, ['*'], 'testCasesPage'); // Paginate dengan namespace 'testCasesPage'

        $testSuites = TestSuite::with('project')
            ->paginate(5, ['*'], 'testSuitesPage'); // Paginate dengan namespace 'testSuitesPage'

        $chartData = $this->getChartData();

        return view('livewire.pages.beranda', [
            'testResults' => $testResults,
            'testCases' => $testCases,
            'testSuites' => $testSuites,
            'chartData' => $chartData, // Tambahkan ini
        ]);
    }
}
