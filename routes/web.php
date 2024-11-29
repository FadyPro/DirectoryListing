<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\Admin\Amenity\AmenityCreate;
use App\Livewire\Admin\Amenity\AmenityEdit;
use App\Livewire\Admin\Amenity\AmenityIndex;
use App\Livewire\Admin\Category\CategoryCreate;
use App\Livewire\Admin\Category\CategoryEdit;
use App\Livewire\Admin\Category\CategoryIndex;
use App\Livewire\Admin\Dashboard\DashboardIndex;
use App\Livewire\Admin\Hero\HeroIndex;
use App\Livewire\Admin\Listing\ListingCreate;
use App\Livewire\Admin\Listing\ListingEdit;
use App\Livewire\Admin\Listing\ListingImageGallery\ListingImageGalleryIndex;
use App\Livewire\Admin\Listing\ListingIndex;
use App\Livewire\Admin\Listing\ListingReview\ListingReviewIndex;
use App\Livewire\Admin\Listing\ListingSchedule\ListingScheduleCreate;
use App\Livewire\Admin\Listing\ListingSchedule\ListingScheduleEdit;
use App\Livewire\Admin\Listing\ListingSchedule\ListingScheduleIndex;
use App\Livewire\Admin\Listing\ListingVideoGallery\ListingVideoGalleryIndex;
use App\Livewire\Admin\Orders\OrderIndex;
use App\Livewire\Admin\Orders\OrderShow;
use App\Livewire\Admin\Location\LocationCreate;
use App\Livewire\Admin\Location\LocationEdit;
use App\Livewire\Admin\Location\LocationIndex;
use App\Livewire\Admin\Packages\PackageCreate;
use App\Livewire\Admin\Packages\PackageEdit;
use App\Livewire\Admin\Packages\PackageIndex;
use App\Livewire\Admin\PaymentSetting\Sections\PaypalSettings;
use App\Livewire\Admin\PaymentSetting\Sections\RazorpaySettings;
use App\Livewire\Admin\PaymentSetting\Sections\StripeSettings;
use App\Livewire\Admin\PendingListing\PendingListingIndex;
use App\Livewire\Admin\Profile\ProfileUpdate;
use App\Livewire\Admin\Settings\Sections\AppearanceSettings;
use App\Livewire\Admin\Settings\Sections\GeneralSettings;
use App\Livewire\Admin\Settings\Sections\LogoSettings;
use App\Livewire\Admin\Settings\Sections\PusherSettings;
use App\Livewire\Frontend\Dashboard\Listing\AgentImageGallery\AgentImageGalleryIndex;
use App\Livewire\Frontend\Dashboard\Listing\AgentListingCreate;
use App\Livewire\Frontend\Dashboard\Listing\AgentListingEdit;
use App\Livewire\Frontend\Dashboard\Listing\AgentListingIndex;
use App\Livewire\Frontend\Dashboard\Listing\AgentSchedule\AgentScheduleCreate;
use App\Livewire\Frontend\Dashboard\Listing\AgentSchedule\AgentScheduleEdit;
use App\Livewire\Frontend\Dashboard\Listing\AgentSchedule\AgentScheduleIndex;
use App\Livewire\Frontend\Dashboard\Listing\AgentVideoGallery\AgentVideoGalleryIndex;
use App\Livewire\Frontend\Dashboard\Order\UserOrderIndex;
use App\Livewire\Frontend\Dashboard\Order\UserOrderShow;
use App\Livewire\Frontend\Dashboard\Profile\ProfileIndex;
use App\Livewire\Frontend\Dashboard\UserDashboardIndex;
use App\Livewire\Frontend\Home\Index;
use App\Livewire\Frontend\Pages\Checkout;
use App\Livewire\Frontend\Pages\Listings;
use App\Livewire\Frontend\Pages\ListingView;
use App\Livewire\Frontend\Pages\Packages;
use App\Livewire\Frontend\Pages\PaymentCancel;
use App\Livewire\Frontend\Pages\PaymentSuccess;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/', 'welcome');
Route::get('/', Index::class)->name('home');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['role:admin','auth'])->group(function (){
    /** Profile Routes */
    Route::get('admin/dashboard', DashboardIndex::class)->name('admin.dashboard.index');
    Route::get('admin/profile', ProfileUpdate::class)->name('admin.profile');
    /** hero Routes */
    Route::get('admin//hero/index', HeroIndex::class)->name('admin.hero.index');
    /** Category Routes */
    Route::get('admin/category/index', CategoryIndex::class)->name('admin.category.index');
    Route::get('admin/category/create', CategoryCreate::class)->name('admin.category.create');
    Route::get('admin/category/{id}/edit', CategoryEdit::class)->name('admin.category.edit');
    /** Locations Routes */
    Route::get('admin/location/index', LocationIndex::class)->name('admin.location.index');
    Route::get('admin/location/{id}/edit', LocationEdit::class)->name('admin.location.edit');
    Route::get('admin/location/create', LocationCreate::class)->name('admin.location.create');
    /** Amenity Routes */
    Route::get('admin/amenity/index', AmenityIndex::class)->name('admin.amenity.index');
    Route::get('admin/amenity/create', AmenityCreate::class)->name('admin.amenity.create');
    Route::get('admin/amenity/{id}/edit', AmenityEdit::class)->name('admin.amenity.edit');
    /** Listing Routes */
    Route::get('admin/listing/index', ListingIndex::class)->name('admin.listing.index');
    Route::get('admin/listing/{id}/edit', ListingEdit::class)->name('admin.listing.edit');
    Route::get('admin/listing/create', ListingCreate::class)->name('admin.listing.create');
    /** Listing Image Gallery Routes */
    Route::get('/listing-image-gallery/{id}', ListingImageGalleryIndex::class);
    /** Listing Video Gallery Routes */
    Route::get('/listing-video-gallery/{id}', ListingVideoGalleryIndex::class);
    /** Listing Schedule Routes */
    Route::get('/listing-schedule/{id}', ListingScheduleIndex::class)->name('listing-schedule.index');
    Route::get('/listing-schedule/{id}/create', ListingScheduleCreate::class)->name('listing-schedule.create');
    Route::get('/listing-schedule/{id}/edit', ListingScheduleEdit::class)->name('listing-schedule.edit');
    /** Listing Review */
    Route::get('/admin/listing-reviews', ListingReviewIndex::class)->name('admin.listing-reviews.index');
    /** Pending Listing Routes */
    Route::get('/admin/pending-listing', PendingListingIndex::class)->name('admin.pending-listing.index');
    /** Packages Routes */
    Route::get('/admin/packages', PackageIndex::class)->name('admin.packages.index');
    Route::get('/admin/packages/{id}/edit', PackageEdit::class)->name('admin.packages.edit');
    Route::get('/admin/packages/create', PackageCreate::class)->name('admin.packages.create');
    /** Settings Routes */
    Route::get('/admin/settings/general', GeneralSettings::class)->name('admin.settings.general');
    Route::get('/admin/settings/logo', LogoSettings::class)->name('admin.settings.logo');
    Route::get('/admin/settings/appearance', AppearanceSettings::class)->name('admin.settings.appearance');
    Route::get('/admin/settings/pusher', PusherSettings::class)->name('admin.settings.pusher');
    /** Payment Settings Routes */
    Route::get('/admin/paypal-settings', PaypalSettings::class)->name('admin.paypal-settings.index');
    Route::get('/admin/stripe-settings', StripeSettings::class)->name('admin.stripe-settings.index');
    Route::get('/admin/razorpay-settings', RazorpaySettings::class)->name('admin.razorpay-settings.index');
    /** Order Routes */
    Route::get('/admin/orders/index', OrderIndex::class)->name('admin.orders.index');
    Route::get('/admin/orders/{id}/show', OrderShow::class)->name('admin.orders.show');

});
Route::middleware(['role:user','auth', 'verified'])->group(function (){
    /** Profile Routes */
    Route::get('/user/dashboard', UserDashboardIndex::class)->name('user.dashboard');
    Route::get('/user/profile', ProfileIndex::class)->name('user.profile.index');
    /** Linsting Routes */
    Route::get('/user/listing', AgentListingIndex::class)->name('user.listing.index');
    Route::get('/user/listing/{id}/edit', AgentListingEdit::class)->name('user.listing.edit');
    Route::get('/user/listing/create', AgentListingCreate::class)->name('user.listing.create');
    /** Listing Image Gallery Routes */
    Route::get('/user/listing-image-gallery/{id}', AgentImageGalleryIndex::class);
    /** Listing Video Gallery Routes */
    Route::get('/user/listing-video-gallery/{id}', AgentVideoGalleryIndex::class);
    /** Listing Schedule Routes */
    Route::get('/user/listing-schedule/{id}', AgentScheduleIndex::class)->name('user.listing-schedule.index');
    Route::get('/user/listing-schedule/{id}/create', AgentScheduleCreate::class)->name('user.listing-schedule.create');
    Route::get('/user/listing-schedule/{id}/edit', AgentScheduleEdit::class)->name('user.listing-schedule.edit');
    /** Listing Orders */
    Route::get('/user/order', UserOrderIndex::class)->name('user.order.index');
    Route::get('/user/order/{id}/show', UserOrderShow::class)->name('user.order.show');
});
Route::group(['middleware' => 'auth'], function(){
    /** Payment Routes */
    Route::get('payment/success', PaymentSuccess::class)->name('payment.success');
    Route::get('payment/cancel', PaymentCancel::class)->name('payment.cancel');

    /** Paypal routes */
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');
    /** Stripe Routes */
    Route::get('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');
    Route::get('stripe/success', [PaymentController::class, 'stripeSuccess'])->name('stripe.success');
    Route::get('stripe/cancel', [PaymentController::class, 'stripeCancel'])->name('stripe.cancel');
    /** razorpay Routes */
    Route::get('razorpay/redirect', [PaymentController::class, 'razorpayRedirect'])->name('razorpay.redirect');
    Route::get('razorpay/payment', [PaymentController::class, 'payWithRazorpay'])->name('razorpay.payment');

    /** Checkout Routes */
    Route::get('/checkout/{id}', Checkout::class )->name('checkout.index');
});

Route::get('listings', Listings::class)->name('listings');
Route::get('listing/{slug}', ListingView::class)->name('listing.show');
Route::get('/packages', Packages::class )->name('package.show');







require __DIR__.'/auth.php';
