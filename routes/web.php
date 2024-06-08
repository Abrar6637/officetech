<?php

use App\Http\Controllers\Admin\AccountManagerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\loginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ContactUsController as AdminContactUsController;
use App\Http\Controllers\Admin\discontcouponcontroller;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\Frontend\CartController;
use App\Http\Controllers\Admin\Frontend\orderController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\service_product;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Http\Controllers\Frontend\ReviewsController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Frontend\RequestQuotationController;
use App\Http\Controllers\Frontend\RequestServiceController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Frontend\ReturnOrderController;
use App\Http\Controllers\Admin\ReturnRequestController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CmsController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\Admin\GuestUserController;
use App\Http\Controllers\LanguageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Authentication Routes
Route::get('/lang/{locale}',[LanguageController::class,'getLanguageFile'])->name('admin.change.password');
Route::post('/admin/change-password', [AdminController::class,'changePassword'])->name('admin.change.password');
Route::post('/admin/change-username', [AdminController::class,'changeUsername'])->name('admin.change.username');

//Privacy Policy
Route::get('/admin/privacy-policy/create', [CmsController::class, 'addPrivacyPolicy'])->name('admin.privacy-policy.create');
Route::post('/admin/privacy-policy/store', [CmsController::class, 'storePrivacyPolicy'])->name('admin.privacy-policy.store');
Route::get('/admin/privacy-policy', [CmsController::class, 'showPrivacyPolicy'])->name('admin.privacy-policy.index');
Route::get('/admin/privacy-policy/{id}/edit', [CmsController::class, 'editPrivacyPolicy'])->name('admin.privacy-policy.edit');
Route::put('/admin/privacy-policy/{id}', [CmsController::class, 'updatePrivacyPolicy'])->name('admin.privacy-policy.update');
Route::delete('/admin/privacy-policy/{id}', [CmsController::class, 'destroyPrivacyPolicy'])->name('admin.privacy-policy.destroy');

//Return Policy
Route::get('/admin/return-policy/create', [CmsController::class, 'addReturnPolicy'])->name('admin.return-policy.create');
Route::post('/admin/return-policy/store', [CmsController::class, 'storeReturnPolicy'])->name('admin.return-policy.store');
Route::get('/admin/return-policy', [CmsController::class, 'showReturnPolicy'])->name('admin.return-policy.index');
Route::get('/admin/return-policy/{id}/edit', [CmsController::class, 'editReturnPolicy'])->name('admin.return-policy.edit');
Route::put('/admin/return-policy/{id}', [CmsController::class, 'updateReturnPolicy'])->name('admin.return-policy.update');
Route::delete('/admin/return-policy/{id}', [CmsController::class, 'destroyReturnPolicy'])->name('admin.return-policy.destroy');

//Service Policy
Route::get('/admin/service-policy/create', [CmsController::class, 'addServicePolicy'])->name('admin.service-policy.create');
Route::post('/admin/service-policy/store', [CmsController::class, 'storeServicePolicy'])->name('admin.service-policy.store');
Route::get('/admin/service-policy', [CmsController::class, 'showServicePolicy'])->name('admin.service-policy.index');
Route::get('/admin/service-policy/{id}/edit', [CmsController::class, 'editServicePolicy'])->name('admin.service-policy.edit');
Route::put('/admin/service-policy/{id}', [CmsController::class, 'updateServicePolicy'])->name('admin.service-policy.update');
Route::delete('/admin/service-policy/{id}', [CmsController::class, 'destroyServicePolicy'])->name('admin.service-policy.destroy');

//Service Plans Policy
Route::get('/admin/service-plan-policy/create', [CmsController::class, 'addServicePlanPolicy'])->name('admin.service-plan-policy.create');
Route::post('/admin/service-plan-policy/store', [CmsController::class, 'storeServicePlanPolicy'])->name('admin.service-plan-policy.store');
Route::get('/admin/service-plan-policy', [CmsController::class, 'showServicePlanPolicy'])->name('admin.service-plan-policy.index');
Route::get('/admin/service-plan-policy/{id}/edit', [CmsController::class, 'editServicePlanPolicy'])->name('admin.service-plan-policy.edit');
Route::put('/admin/service-plan-policy/{id}', [CmsController::class, 'updateServicePlanPolicy'])->name('admin.service-plan-policy.update');
Route::delete('/admin/service-plan-policy/{id}', [CmsController::class, 'destroyServicePlanPolicy'])->name('admin.service-plan-policy.destroy');

//Payment Policy
Route::get('/admin/payment-policy/create', [CmsController::class, 'addPaymentPolicy'])->name('admin.payment-policy.create');
Route::post('/admin/payment-policy/store', [CmsController::class, 'storePaymentPolicy'])->name('admin.payment-policy.store');
Route::get('/admin/payment-policy', [CmsController::class, 'showPaymentPolicy'])->name('admin.payment-policy.index');
Route::get('/admin/payment-policy/{id}/edit', [CmsController::class, 'editPaymentPolicy'])->name('admin.payment-policy.edit');
Route::put('/admin/payment-policy/{id}', [CmsController::class, 'updatePaymentPolicy'])->name('admin.payment-policy.update');
Route::delete('/admin/payment-policy/{id}', [CmsController::class, 'destroyPaymentPolicy'])->name('admin.payment-policy.destroy');

//About Us
Route::get('/admin/about-us/create', [CmsController::class, 'addAboutUs'])->name('admin.about-us.create');
Route::post('/admin/about-us/store', [CmsController::class, 'storeAboutUs'])->name('admin.about-us.store');
Route::get('/admin/about-us', [CmsController::class, 'showAboutUs'])->name('admin.about-us.index');
Route::get('/admin/about-us/{id}/edit', [CmsController::class, 'editAboutUs'])->name('admin.about-us.edit');
Route::put('/admin/about-us/{id}', [CmsController::class, 'updateAboutUs'])->name('admin.about-us.update');
Route::delete('/admin/about-us/{id}', [CmsController::class, 'destroyAboutUs'])->name('admin.about-us.destroy');



//Vat Certificate
Route::get('/vat-certificate', [HomeController::class, 'vatCertificate'])->name('vat.certificate');


Route::get('admin/guest-users', [GuestUserController::class, 'index'])->name('user.guest-user.index');
Route::get('admin/guest-user/create', [GuestUserController::class, 'create'])->name('user.guest-user.create');
Route::post('admin/guest-user/store', [GuestUserController::class, 'store'])->name('user.guest-user.store');
Route::get('admin/guest-user/{user}/edit', [GuestUserController::class, 'edit'])->name('user.guest-user.edit');
Route::post('admin/guest-user/{user}/update', [GuestUserController::class, 'update'])->name('user.guest-user.update');
Route::post('admin/guest-user/{user}/delete', [GuestUserController::class, 'destroy'])->name('user.guest-user.destroy');

Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
Route::match(['get', 'post'], '/site-admin', [AdminController::class, 'login'])->name('admin.login');
Route::get('/adminlogout', [AdminController::class, 'logout'])->name('admin.logout');

Route::post('/process-payment', [PaymentController::class, 'processPayment']);

// Admin Authentication Routes Ends

// Admin UI Routes

// discount coupon
Route::get('/discount-coupon', [discontcouponcontroller::class, 'discount'])->name('discount');
Route::get('/edit-discount/{id}', [discontcouponcontroller::class, 'edit_discount'])->name('edit.discount');
Route::post('/store-discount', [discontcouponcontroller::class, 'store_discount'])->name('store.discount');
Route::get('/create-discount', [discontcouponcontroller::class, 'create_discount'])->name('create.discount');
Route::post('/add-discount', [discontcouponcontroller::class, 'add_discount'])->name('add.discount');
Route::get('/delete-discount/{id}', [discontcouponcontroller::class, 'delete_discount'])->name('delete.discount');

// Category Routes

Route::get('/main-categories', [AdminController::class, 'showMainCategories'])->name('show.main.categories');
Route::get('/sub-categories', [AdminController::class, 'showSubCategories'])->name('show.sub.categories');
Route::get('/categories', [AdminController::class, 'showcategories'])->name('show.categories');
Route::post('/addCategories', [AdminController::class, 'addCategory'])->name('add.main.category');
Route::post('/add-sub-categories', [AdminController::class, 'addSubCategory'])->name('add.sub.categories');
Route::post('/add-sub-sub-categories', [AdminController::class, 'addSubOfSubCategory'])->name('add.sub.sub.category');

Route::get('/quotation/{userId}', [RequestQuotationController::class, 'generateRequestQuotation'])->name('request.quotation.generate');

// Edit main category Routes

Route::get('/edit-category/{id}/{index}', [AdminController::class, 'edit_main_Category'])->name('edit.main.category');
Route::post('/update-category/{id}', [AdminController::class, 'update_main_Category'])->name('update.main.category');

// Edit main category Routes ends

// Edit sub-category category Routes

Route::get('/edit-sub-category/{id}/{index}', [AdminController::class, 'edit_sub_Category'])->name('edit.sub.category');
Route::post('/update-sub-category/{id}', [AdminController::class, 'update_sub_Category'])->name('update.sub.category');

// Edit sub-category category Routes ends

// Edit sub-of-subcategory category Routes

Route::get('/edit-sub-sub-category/{id}', [AdminController::class, 'edit_sub_sub_Category'])->name('edit.sub.sub.category');
Route::post('/update-sub-sub-category/{id}', [AdminController::class, 'update_sub_sub_Category'])->name('update.sub.sub.category');

// Edit sub-of-sub-category category Routes ends

// Delete main category

Route::get('/delete-main-category/{id}', [AdminController::class, 'deleteMainCategory'])->name('delete.main.category');

// Delete main category ends

// Delete sub category

Route::get('/delete-sub-category/{id}', [AdminController::class, 'deleteSubCategory'])->name('delete.subcategory');

// Delete sub category ends

// Delete Sub of Sub category

Route::get('/delete-sub-sub-category/{id}', [AdminController::class, 'deleteSub_sub_Category'])->name('delete.sub.sub.category');

// Delete Sub of Sub category ends

// Category Routes ends

// Products Type

Route::get('/products-type', [ProductController::class, 'show_products_type'])->name('produts.type');

// Add Edit Products Type

Route::post('/add-products-type', [ProductController::class, 'add_products_type'])->name('add.products.type');
Route::get('/edit-products-type/{id}', [ProductController::class, 'edit_products_type'])->name('edit.products.type');
Route::post('/update-products-type/{id}', [ProductController::class, 'update_products_type'])->name('update.products.type');
Route::get('/delete-products-type/{id}', [ProductController::class, 'delete_products_type'])->name('delete.products.type');

// Add Edit Products Type End

//Products Search Start
Route::post('/search',[ProductController::class, 'search'])->name('search');
Route::get('/fillters', [ProductController::class, 'searchProducts'])->name('search.products');
//Products Search End

// Product add

Route::get('/products', [ProductController::class, 'allproduct'])->name('products');
Route::get('/add-products', [ProductController::class, 'showproduct'])->name('add.products');
Route::post('/store-products', [ProductController::class, 'storeproduct'])->name('store.products');
Route::get('/edit-product/{id}', [ProductController::class, 'edit_products'])->name('edit.products');
Route::post('/product-image-destroy', [ProductController::class, 'destory_delete_image'])->name('delete.product-image');
Route::post('/update-products/{id}', [ProductController::class, 'update_products'])->name('update.products');
Route::get('/getSubCategories/{category}', [ProductController::class, 'getSubCategories']);
Route::get('/getSubSubCategories/{subcategory}', [ProductController::class, 'getSubSubCategories']);
Route::get('/delete-products/{id}', [ProductController::class, 'delete_products'])->name('delete.products');

//Service Product

Route::get('/show-product-services', [service_product::class, 'show_services'])->name('show.product.services');
Route::get('/create-product-services', [service_product::class, 'create_services'])->name('create.product.services');
Route::post('/add-product-services', [service_product::class, 'add_services'])->name('add.product.services');
Route::get('/edit-product-services/{id}', [service_product::class, 'edit_services'])->name('edit.product.services');
Route::post('/update-product-services', [service_product::class, 'update_services'])->name('update.product.services');
Route::get('/delete-product-services/{id}', [service_product::class, 'delete_services'])->name('delete.product.services');

// Crud Brands
Route::get('/brands', [ProductController::class, 'showBrands'])->name('brands');
Route::post('/add/productbrand', [ProductController::class, 'addProductBrand'])->name('add.product.brand');
Route::get('/edit/productbrand/{id}', [ProductController::class, 'editProductBrand'])->name('edit.product.brands');
Route::put('/update/productbrand/{id}', [ProductController::class, 'updateProductBrand'])->name('update.product.brand');
Route::get('/deletebrands/{id}', [ProductController::class, 'deleteProductBrand'])->name('delete.product.brands');

// Order
Route::get('/admin/orders', [OrdersController::class,'orders'])->name('admin.orders');
Route::post('/admin/orders/destory/{id}', [OrdersController::class,'destory'])->name('admin.destory');
Route::post('/admin/orders/status/{id}', [OrdersController::class,'updateOrderStatus'])->name('admin.status');
Route::post('/admin/orders/count/{selectedValue}', [OrdersController::class, 'handlePageResult'])->name('admin.orders.post');
Route::get('/admin/create/order', [OrdersController::class,'create_order'])->name('admin.create.order');
Route::post('/admin/store/order', [OrdersController::class,'store_order'])->name('admin.store.order');
Route::get('/admin/edit/order/{id}', [OrdersController::class,'edit_order'])->name('admin.edit.order');
Route::post('/admin/update/order/{orderId}', [OrdersController::class,'update_order'])->name('update.admin.order');
Route::get('/admin/order/invoice/{orderId}', [OrdersController::class,'orderInvoice'])->name('admin.order.invoice');

//Privacy Policy
Route::get('/admin/privacy-policy/create', [CmsController::class, 'addPrivacyPolicy'])->name('admin.privacy-policy.create');
Route::post('/admin/privacy-policy/store', [CmsController::class, 'storePrivacyPolicy'])->name('admin.privacy-policy.store');
Route::get('/admin/privacy-policy', [CmsController::class, 'showPrivacyPolicy'])->name('admin.privacy-policy.index');
Route::get('/admin/privacy-policy/{id}/edit', [CmsController::class, 'editPrivacyPolicy'])->name('admin.privacy-policy.edit');
Route::put('/admin/privacy-policy/{id}', [CmsController::class, 'updatePrivacyPolicy'])->name('admin.privacy-policy.update');
Route::delete('/admin/privacy-policy/{id}', [CmsController::class, 'destroyPrivacyPolicy'])->name('admin.privacy-policy.destroy');

//Return Policy
Route::get('/admin/return-policy/create', [CmsController::class, 'addReturnPolicy'])->name('admin.return-policy.create');
Route::post('/admin/return-policy/store', [CmsController::class, 'storeReturnPolicy'])->name('admin.return-policy.store');
Route::get('/admin/return-policy', [CmsController::class, 'showReturnPolicy'])->name('admin.return-policy.index');
Route::get('/admin/return-policy/{id}/edit', [CmsController::class, 'editReturnPolicy'])->name('admin.return-policy.edit');
Route::put('/admin/return-policy/{id}', [CmsController::class, 'updateReturnPolicy'])->name('admin.return-policy.update');
Route::delete('/admin/return-policy/{id}', [CmsController::class, 'destroyReturnPolicy'])->name('admin.return-policy.destroy');

//Service Policy
Route::get('/admin/service-policy/create', [CmsController::class, 'addServicePolicy'])->name('admin.service-policy.create');
Route::post('/admin/service-policy/store', [CmsController::class, 'storeServicePolicy'])->name('admin.service-policy.store');
Route::get('/admin/service-policy', [CmsController::class, 'showServicePolicy'])->name('admin.service-policy.index');
Route::get('/admin/service-policy/{id}/edit', [CmsController::class, 'editServicePolicy'])->name('admin.service-policy.edit');
Route::put('/admin/service-policy/{id}', [CmsController::class, 'updateServicePolicy'])->name('admin.service-policy.update');
Route::delete('/admin/service-policy/{id}', [CmsController::class, 'destroyServicePolicy'])->name('admin.service-policy.destroy');

//Ecom Print Package
Route::get('/admin/ecom-print-package/create', [CmsController::class, 'addEcomPrintPackage'])->name('admin.ecom-print-package.create');
Route::post('/admin/ecom-print-package/store', [CmsController::class, 'storeEcomPrintPackage'])->name('admin.ecom-print-package.store');
Route::get('/admin/ecom-print-package', [CmsController::class, 'showEcomPrintPackage'])->name('admin.ecom-print-package.index');
Route::get('/admin/ecom-print-package/{id}/edit', [CmsController::class, 'editEcomPrintPackage'])->name('admin.ecom-print-package.edit');
Route::put('/admin/ecom-print-package/{id}', [CmsController::class, 'updateEcomPrintPackage'])->name('admin.ecom-print-package.update');
Route::delete('/admin/ecom-print-package/{id}', [CmsController::class, 'destroyEcomPrintPackage'])->name('admin.ecom-print-package.destroy');

//admin return request
Route::get('/admin/return-request',[ReturnRequestController::class, 'index'])->name('admin.return.request');
Route::post('/admin/return-request-approve', [ReturnRequestController::class, 'approveRequest'])->name('admin.return.request.approve');

// Admin Reviews
Route::get('/admin/reviews', [ReviewsController::class, 'show'])->name('admin.reviews');
Route::get('/admin/update-reviews/{id}', [ReviewsController::class, 'update'])->name('update.reviews');

// Slider Crud
Route::get('/slider', [SliderController::class, 'show'])->name('admin.slider');
Route::get('/add-slider', [SliderController::class, 'add'])->name('add.slider');
Route::post('/store-slider', [SliderController::class, 'store'])->name('store.slider');
Route::get('/edit-slider/{id}', [SliderController::class, 'edit'])->name('edit.slider');
Route::post('/update-slider/{id}', [SliderController::class, 'update'])->name('update.slider');
Route::get('/delete-slider/{id}', [SliderController::class, 'destory'])->name('delete.slider');

// Admin Contact US
Route::get('/contacts', [AdminContactUsController::class, 'show'])->name('admin.contactus');

// Admin Services
Route::get('/all-services', [ServicesController::class, 'show'])->name('all.services');
Route::post('/add-services', [ServicesController::class, 'store'])->name('add.services');
Route::get('/edit-service/{id}', [ServicesController::class, 'editService'])->name('edit.service');
Route::post('/update-services/{id}', [ServicesController::class, 'updateService'])->name('update.service');
Route::get('/delete-services/{id}', [ServicesController::class, 'deleteService'])->name('delete.service');
Route::get('/services-call', [ServicesController::class, 'showServicesCall'])->name('services.call');
Route::get('/services-contract', [ServicesController::class, 'showServicesContract'])->name('services.contract');
Route::get('/update-services-call/{id}', [ServicesController::class, 'updateServicesCall'])->name('update.service.call.request');
Route::get('/delete-services-call/{id}', [ServicesController::class, 'deleteCallRequest'])->name('delete.service.call.request');
Route::get('/update-services-contract/{id}', [ServicesController::class, 'updateServicesContract'])->name('update.service.contract.request');
Route::get('/decline-services-contract/{id}', [ServicesController::class, 'declineServicesContract'])->name('decline.service.contract.request');
Route::get('/decline-services-call/{id}', [ServicesController::class, 'declineServicesCall'])->name('decline.service.call.request');
Route::get('/delete-services-contract-request/{id}', [ServicesController::class, 'deleteServiceRequest'])->name('delete.service.contract.request');

// Account Manager 
Route::get('admin/account-manager', [AccountManagerController::class,'show'])->name('account.manager');
Route::post('admin/add-account-manager', [AccountManagerController::class, 'store'])->name('store.account.manager');
Route::get('admin/edit-account-manager/{id}', [AccountManagerController::class, 'edit'])->name('edit.account.manager');
Route::post('admin/update-account-manager/{id}', [AccountManagerController::class, 'update'])->name('update.account.manager');
Route::get('admin/delete-account-manager/{id}', [AccountManagerController::class, 'destroy'])->name('delete.account.manager');
// Region 
Route::get('admin/region', [RegionController::class,'show'])->name('region');
Route::post('admin/add-region', [RegionController::class, 'store'])->name('add.region');
Route::get('admin/edit-region/{id}', [RegionController::class, 'edit'])->name('edit.region');
Route::post('admin/update-region/{id}', [RegionController::class, 'update'])->name('update.region');
Route::get('admin/delete-region/{id}', [RegionController::class, 'destroy'])->name('delete.region');

//Customers
Route::get('admin/users', [UsersController::class,'show'])->name('admin.users');
Route::get('admin/edit-user/{id}', [UsersController::class, 'edit'])->name('edit.user');
Route::post('admin/update-user/{id}', [UsersController::class, 'update'])->name('update.user');

//Shipping User Side
Route::post('/update-shipping',[HomeController::class,'updateShipping'])->name('update.shipping');
Route::post('/admin-update-shipping', [App\Http\Controllers\Admin\OrdersController::class, 'updateShipping'])->name('admin.update.shipping');
// Cities
Route::get('admin/cities', [CitiesController::class,'show'])->name('cities');
Route::post('admin/create/city', [CitiesController::class,'store'])->name('cities.store');
Route::get('admin/edit/city/{id}', [CitiesController::class,'edit'])->name('edit.city');
Route::post('admin/update/city/{id}', [CitiesController::class,'update'])->name('update.city');
Route::get('admin/delete/city/{id}', [CitiesController::class,'destroy'])->name('delete.city');

// Countries 
Route::get('admin/countries', [CountryController::class,'show'])->name('countries');
Route::post('admin/create/country', [CountryController::class,'store'])->name('country.store');
Route::get('admin/edit/country/{id}', [CountryController::class,'edit'])->name('edit.country');
Route::post('admin/update/country/{id}', [CountryController::class,'update'])->name('update.country');
Route::get('admin/delete/country/{id}', [CountryController::class,'destroy'])->name('delete.country');

//Newsletter
Route::get('admin/newsletters', [NewsletterController::class,'show'])->name('admin.newsletters');

// User Change Password
Route::post('/change-password/{id}', [UserAccountController::class,'changePassword'])->name('change.password');
//  User Frontend
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('/cart/total-count', [CartController::class, 'getTotalCartCount'])->name('cart.total-count');
Route::post('/cart/discount', [CartController::class, 'discount_card'])->name('cart.discount_card');
Route::post('/cart/update', [CartController::class, 'update_Cart'])->name('cart.update_Cart');
Route::get('/cart/remove/{id}', [CartController::class, 'remove_Cart'])->name('cart.remove');
Route::get('/cart/remove', [CartController::class, 'delete_all_cart'])->name('cart.delete.all');
Route::post('/cart/showquantity', [CartController::class, 'showquantity'])->name('cart.show.quantity');
Route::get('/user', [HomeController::class, 'admin'])->name('user.admin');
Route::get('/Category/{slug}', [ProductController::class, 'showSubCategoryProducts'])->name('sub.category.products');
Route::get('/brand/{slug}', [ProductController::class, 'brands_products'])->name('brands.products');
Route::get('/search-products', [ProductController::class, 'applyFilters'])->name('apply.filters');
Route::get('/', [HomeController::class, 'index'])->name('user.index');
Route::get('/about-us',[HomeController::class,'about_us'])->name('user.aboutUs');
Route::get('/accessories',[HomeController::class,'accessories'])->name('user.accessories');
Route::get('/cart',[HomeController::class,'cart'])->name('user.cart');
Route::post('/checkout/add',[orderController::class,'add_order_customer'])->name('user.add_order_customer');
Route::get('/checkout',[HomeController::class,'checkout'])->name('user.checkout');
Route::get('/payment-success',[orderController::class,'payment_success'])->name('user.payment-success');
Route::get('/contact-us',[HomeController::class,'contact_us'])->name('user.contact_us');
Route::get('/forget-password',[HomeController::class,'forget_password'])->name('user.forget_password');
Route::post('/forget-password',[HomeController::class,'forget_password_link'])->name('user.forget_password_link');
Route::get('reset-password/{token}', [HomeController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [HomeController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/order-status',[HomeController::class,'order_status'])->name('user.order_status');
Route::get('/printers',[HomeController::class,'printers'])->name('user.printers');
Route::get('/product-details/{slug}',[HomeController::class,'product_details'])->name('user.product_details');
Route::get('/reset-password',[HomeController::class,'reset_password'])->name('user.reset_password');
Route::get('/services',[HomeController::class,'services'])->name('user.services');
Route::get('/software-solutions',[HomeController::class,'software_solutions'])->name('user.software_solutions');
Route::get('/sign-in',[HomeController::class,'signin'])->name('user.signin');
Route::get('/sign-up',[HomeController::class,'signup'])->name('user.signup');
Route::get('/track-order',[HomeController::class,'track_order'])->name('user.track_order');
Route::post('/track-order-details',[HomeController::class,'track_order_details'])->name('user.track_order_details');
Route::get('/order-successfull',[HomeController::class,'order_successfull'])->name('user.order_successfull');
Route::get('/work-station',[HomeController::class,'work_station'])->name('user.work_station');
Route::get('/404',[HomeController::class,'error'])->name('user.error');
Route::get('/featured-products',[HomeController::class,'featured_product'])->name('featured.products');
Route::get('/recomended-products',[HomeController::class,'recommended_product'])->name('recommended.products');
Route::get('/latest-products',[HomeController::class,'latest_products'])->name('latest.products');
Route::get('/product-reviews',[ReviewsController::class,'store'])->name('product.reviews');
Route::post('/request-service',[RequestServiceController::class,'store'])->name('request.service');
Auth::routes();
Route::post('/sign-up/form', [loginController::class, 'sign_up'])->middleware('secure_signup');
Route::post('/sign-up/ajax', [loginController::class, 'sign_up_ajax'])->middleware('secure_signup')->name('checkout.signup');
Route::post('/sign-in/form', [loginController::class, 'sign_in']);
Route::post('/sign-in/ajax', [loginController::class, 'sign_in_ajax'])->name("checkout.signin");
Route::get('/load-more-reviews/{productId}/{page}', [HomeController::class, 'loadMoreReviews'])->name('load.more.reviews');
Route::post('/contact-us', [ContactUsController::class, 'store'])->name('user.contactus');
Route::get('/choose-service/{orderId}', [HomeController::class, 'service'])->name('choose.service');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/terms-&-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');
Route::get('/payment-policy', [HomeController::class, 'paymentPolicy'])->name('payment.policy');
Route::get('/old-page', [HomeController::class, 'old_page'])->name('user.old_page');
Route::get('/service-plans-policy', [HomeController::class, 'servicePlansPolicy'])->name('service.plans.policy');
Route::get('/service-policy', [HomeController::class, 'servicePolicy'])->name('service.policy');
Route::get('/return-policy', [HomeController::class, 'return_policy'])->name('return.policy');
Route::get('/ecom-print-package', [HomeController::class, 'ecomPrintPackage'])->name('ecom.print.package');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('user.newsletter');
//user admin routes
Route::get('/orders', [HomeController::class, 'orders'])->name('user.orders')->middleware('user.session');
Route::get('/invoice/{orderId}', [InvoiceController::class, 'generateInvoice'])->name('invoice.generate');
Route::get('/quotation/{userId}', [RequestQuotationController::class, 'generateRequestQuotation'])->name('request.quotation.generate');
Route::get('/frontend/request_quotation',[RequestQuotationController::class, 'RequestQuotation'])->name('frontend.request_quotation');
Route::post('/clear-session',[RequestQuotationController::class, 'clearSession'])->name('clear.session');
Route::post('/quotaion-email', [RequestQuotationController::class, 'sendEmail'])->name("request.quotation.email");
Route::get('/user-setting', [HomeController::class, 'user_setting'])->name('user.user_setting')->middleware('user.session');
Route::get('/user-logout', [HomeController::class, 'user_logout'])->name('user.logout');
Route::get('/return-order/{orderId}',[ReturnOrderController::class, 'returnOrder'])->name('return.order');
Route::get('/admin-request-email',[HomeController::class, 'admin_request_email']);
//Vat Certificate
Route::get('/vat-certificate', [HomeController::class, 'vatCertificate'])->name('vat.certificate');

// Quotation
Route::get('/admin/quotations',[QuotationController::class, 'index'])->name('admin.quotations');
Route::get('/admin/quotations/show/{id}', [QuotationController::class, 'show'])->name('admin.quotations.show');
Route::get('/admin/quotations/edit/{id}', [QuotationController::class, 'edit'])->name('admin.quotations.edit');
Route::post('/admin/quotations/update/{id}',[QuotationController::class, 'update'])->name('admin.quotations.update');
Route::post('/admin/quotations/delete/{id}', [QuotationController::class, 'delete'])->name('admin.quotations.delete');
Route::get('/admin/admin-quotations',[QuotationController::class, 'indexAdminQuotation'])->name('admin.index.quotation');
Route::get('/admin/create/quotations',[QuotationController::class, 'createAdminQuotation'])->name('admin.create.quotation');
Route::post('/admin/store/quotations',[QuotationController::class, 'storeAdminQuotation'])->name('admin.store.quotation');
Route::get('admin/edit/quotations/{id}',[QuotationController::class, 'editAdminQuotation'])->name('admin.edit.quotation');
Route::get('/admin/show/quotations/{id}', [QuotationController::class, 'showAdminQuotation'])->name('admin.show.quotation');
Route::post('/admin/update/quotations/{id}', [QuotationController::class, 'updateAdminQuotation'])->name('admin.update.quotation');
Route::post('/admin/delete/quotations/{id}', [QuotationController::class, 'deleteAdminQuotation'])->name('admin.delete.quotation');

//User Settings
Route::post('/user/account-settings-store', [UserAccountController::class, 'storeAccountDetails'])->name('user.account.details.store');
Route::post('/user/billing-settings-store', [UserAccountController::class, 'storeBillingDetails'])->name('user.billing.details.store');

// Add a wildcard route to catch undefined routes
Route::fallback(function () {
    if (auth('admin')->check()) {
        return view('errors.404');
    } else {
        return view('frontend.user.404-page');
    }
});

Route::get('migrate' , function () {
    Artisan::call('migrate');
});
Route::get('config-cache', function () {
    Artisan::call('config:cache');
});

Route::get('config-clear', function () {
    Artisan::call('config:clear');
});

Route::get('cache-clear', function () {
    Artisan::call('cache:clear');
});