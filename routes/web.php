<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeImageController;
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
            Route::get('/catalog',[PagesController::class,'catalogPage'])->name('catalog');
            Route::get('/contact',[PagesController::class,'contactPage'])->name('contact');
            Route::get('/faq',[PagesController::class,'faqPage'])->name('faq');
            Route::post('/contact',[BookingController::class,'store'])->name('contact.store');
            Route::get('/availability',[BookingController::class,'availability'])->name('availability');

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

            Route::get('/gallery',[PagesController::class,'galleryPage'])->name('gallery.page');
            Route::post('/gallery/image/{category}',[CategoryController::class,'addImage'])->name('images.add');
            Route::post('/gallery/{categoryImage}/delete', [CategoryController::class, 'deleteCategoryImage'])->name('images.delete');

            Route::get('/homeImage',[PagesController::class,'homeImagePage'])->name('homeImage.page');
            Route::post('/homeImage/image',[HomeImageController::class,'addHomeImage'])->name('homeImage.add');
            Route::post('/homeImage/{portfolio}/delete', [HomeImageController::class, 'deleteHomeImage'])->name('homeImage.delete');
            
            Route::get('/themes',[PagesController::class,'themesPage'])->name('themes.page');

            Route::post('/themes/add',[CategoryController::class,'addTheme'])->name('themes.add');
            Route::post('/themes/{theme}/edit',[CategoryController::class,'editTheme'])->name('themes.edit');
            Route::post('/themes/{theme}/delete', [CategoryController::class, 'deleteTheme'])->name('themes.delete');

            Route::get('/account',[PagesController::class,'accountPage'])->name('account.page');
            Route::post('/account/profile',[AccountController::class,'updateProfile'])->name('account.profile');
            Route::post('/account/password',[AccountController::class,'updatePassword'])->name('account.password');

            Route::get('/schedule',[PagesController::class,'schedulePage'])->name('schedule.page');

            Route::get('/bookings',[PagesController::class,'bookingsPage'])->name('bookings.page');
            Route::post('/bookings/{booking}/status',[BookingController::class,'updateStatus'])->name('bookings.status');
            Route::post('/bookings/{booking}/reschedule',[BookingController::class,'reschedule'])->name('bookings.reschedule');
        });
        