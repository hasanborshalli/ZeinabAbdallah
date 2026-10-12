<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

            Route::get('/lang/{locale}', function (Request $request, string $locale) {
                if (in_array($locale, ['en', 'ar'], true)) {
                    session(['locale' => $locale]);
                }

                return redirect()->back();
            })->name('lang.switch');

            Route::get('/',[PagesController::class,'homePage'])->name('home');
            Route::get('/gallery',[PagesController::class,'galleryIndexPage'])->name('gallery');
            Route::get('/themes',[PagesController::class,'themesIndexPage'])->name('themes');
            Route::get('/sessions/{category:slug}',[PagesController::class,'sessionDetailPage'])->name('sessions.show');
            Route::get('/sessions/{category:slug}/gallery',[PagesController::class,'sessionGalleryPage'])->name('sessions.gallery');
            Route::get('/sessions/{category:slug}/themes',[PagesController::class,'sessionThemesPage'])->name('sessions.themes');
            Route::get('/sessions/{category:slug}/form',[PagesController::class,'sessionInfoFormPage'])->name('sessions.form');
            Route::get('/booking',[PagesController::class,'bookingPage'])->name('booking');
            Route::get('/contact',[PagesController::class,'contactPage'])->name('contact');
            Route::get('/about',[PagesController::class,'aboutPage'])->name('about');

        Route::middleware('guest')->group(function () {
            
            Route::get('/login',[PagesController::class,'loginPage'])->name('login');
            Route::post('/login',[AuthController::class,'login'])->name('login.action');
            
        });

            Route::post('/logout',[AuthController::class,'logout'])->name('logout');

        Route::middleware('auth')->prefix('dashboard')->name('admin.')->group(function () {
            
            Route::get('/',[PagesController::class,'dashboardPage'])->name('dashboard');

            Route::get('/categories',[PagesController::class,'categoriesPage'])->name('categories.page');

            Route::get('/categories/add',[PagesController::class,'addCategoryPage'])->name('categories.add.page');
            Route::post('/categories/add',[CategoryController::class,'addCategory'])->name('categories.add');
            
            Route::get('/categories/edit/{category}',[PagesController::class,'editCategoryPage'])->name('categories.edit.page');
            Route::post('/categories/edit/{category}',[CategoryController::class,'editCategory'])->name('categories.edit');
            
            Route::post('/categories/{category}/delete', [CategoryController::class, 'deleteCategory'])->name('categories.delete');
            
            Route::get('/packages/edit/{package}',[PagesController::class,'editPackagePage'])->name('packages.edit.page');
            Route::post('/packages/edit/{package}',[CategoryController::class,'editPackage'])->name('packages.edit');

            Route::get('/packages/add/{category}',[PagesController::class,'addPackagePage'])->name('packages.add.page');
            Route::post('/packages/add/{category}',[CategoryController::class,'addPackage'])->name('packages.add');
            Route::post('/package/{package}/delete', [CategoryController::class, 'deletePackage'])->name('packages.delete');

            Route::get('/questions',[PagesController::class,'questionPage'])->name('questions.page');
            
            Route::get('/questions/edit/{question}',[PagesController::class,'editquestionPage'])->name('questions.edit.page');
            Route::post('/questions/edit/{question}',[QuestionsController::class,'editquestion'])->name('questions.edit');

            Route::get('/questions/add',[PagesController::class,'addquestionPage'])->name('questions.add.page');
            Route::post('/questions/add',[QuestionsController::class,'addquestion'])->name('questions.add');
            Route::post('/question/{question}/delete', [QuestionsController::class, 'deletequestion'])->name('questions.delete');

            Route::get('/feedbacks',[PagesController::class,'feedbacksPage'])->name('feedbacks.page');

            Route::get('/feedback/edit/{feedback}',[PagesController::class,'editFeedbackPage'])->name('feedbacks.edit.page');
            Route::post('/feedback/edit/{feedback}',[FeedbackController::class,'editFeedback'])->name('feedbacks.edit');

            Route::get('/feedback/add',[PagesController::class,'addFeedbackPage'])->name('feedbacks.add.page');
            Route::post('/feedback/add',[FeedbackController::class,'addFeedback'])->name('feedbacks.add');
            Route::post('/feedback/{feedback}/delete', [FeedbackController::class, 'deleteFeedback'])->name('feedbacks.delete');

            Route::get('/gallery',[PagesController::class,'galleryPage'])->name('gallery.page');
            Route::post('/gallery/image/{category}',[CategoryController::class,'addImage'])->name('images.add');
            Route::post('/gallery/{categoryImage}/delete', [CategoryController::class, 'deleteCategoryImage'])->name('images.delete');

            Route::get('/themes',[PagesController::class,'themesPage'])->name('themes.page');

            Route::post('/themes/add',[CategoryController::class,'addTheme'])->name('themes.add');
            Route::post('/themes/{theme}/delete', [CategoryController::class, 'deleteTheme'])->name('themes.delete');

            Route::get('/account',[PagesController::class,'accountPage'])->name('account.page');
            Route::post('/account/profile',[AccountController::class,'updateProfile'])->name('account.profile');
            Route::post('/account/password',[AccountController::class,'updatePassword'])->name('account.password');

        });
        