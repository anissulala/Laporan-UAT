<?php

use App\Livewire\BookCount;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Beranda;

Route::get('/', Beranda::class)
    ->name('beranda');

Route::get('/book', BookCount::class);

Route::get('/login', App\Livewire\Pages\Login\Index::class)
    ->name('login.index');

Route::get('/projects', App\Livewire\Pages\Projects\Index::class)
    ->name('project.index');

Route::get('/projects/{projectId}/test-suites', App\Livewire\Pages\Projects\TestSuites\Index::class)
    ->name('testsuite.index');

Route::get('/projects/{projectId}/test-suites/{testSuiteId}/test-cases', App\Livewire\Pages\Projects\TestSuites\TestCases\Index::class)
    ->name('testcase.index');

Route::get('/projects/{projectId}/test-suites/{testSuiteId}/test-cases/{testCaseId}/test-results', App\Livewire\Pages\Projects\TestSuites\TestCases\TestResults\Index::class)
    ->name('testresult.index');

Route::get('/projects/{projectId}/test-suites/{testSuiteId}/test-cases/{testCaseId}/test-results/{testResultId}/komentars', App\Livewire\Pages\Projects\TestSuites\TestCases\TestResults\Komentars\Index::class)
    ->name('komentar.index');

Route::get('/profile', App\Livewire\Pages\Profile\Index::class)
    ->name('profile.index');

Route::get('/kelola-user', App\Livewire\Pages\KelolaUser\Index::class)
    ->name('kelola-user.index');
