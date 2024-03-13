<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\StoreManagerDashboardController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// login page
// default page when first load /
Route::get('/', function () {
    return view('auth.login');
});
// home page
Route::get('/home', function () {
    return view('welcome');
})->middleware('RedirectToHomeBasedOnRole');

//default dashboard by Jetstream
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//--------------system admin routes-----------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
    'CheckAdminRole'
])->group(function () {
    //home route
    Route::get('/systemAdmin/home', [AdminDashboardController::class, 'index'])->name('systemAdmin.home');
    //create new user
    Route::post('/systemAdmin/newUser', [AdminUserController::class, 'create'])->name('systemAdmin.newUser');
    //route to fetch all user data
    Route::get('/systemAdmin/home/fetchAllUserData', [AdminDashboardController::class, 'fetchAllUserData'])->name('fetchAllUserData');
    //route to edit user data
    Route::get('/systemAdmin/User/edit', [AdminDashboardController::class, 'edit'])->name('user.edit');
    //route to update student data
    Route::post('/systemAdmin/User/update', [AdminDashboardController::class, 'update'])->name('user.update');
});
//--------------End system admin routes-----------------



//--------------head of administration routes-----------------

//--------------End head of administration routes-----------------




//--------------purchasing manager routes-----------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
    // 'CheckPmRole'
])->group(function () {

    //pm home
    Route::get('/pm/home', function () {
        return view('PurchasingManager.PM-home');
    })->name('pm.home');
    // Route::get('/pm/home', function () {
    //     return view('PurchasingManager.PM-home');
    // })->name('pm.addNewProduct');

    //add new products page
    Route::get('/pm/addNewProduct', function () {
        return view('PurchasingManager.add-new-product');
    });
    // create new product
    Route::post('/pm/newProduct', [ProductController::class, 'create'])->name('pm.newProduct');
    //route to fetch all product data
    Route::get('/systemAdmin/home/fetchAllProductData', [ProductController::class, 'fetchAllProductData'])->name('fetchAllProductData');
    //route to edit product data
    Route::get('/pm/Product/edit', [ProductController::class, 'edit'])->name('product.edit');
    //route to update product data
    Route::post('/pm/Product/update', [ProductController::class, 'update'])->name('product.update');
    // route to get all product details
    Route::get('/products/fetch', [ProductController::class, 'fetchProducts'])->name('products.fetch');
    //route to fetch all product data for store
    Route::get('/products/fetchProductDetails', [ProductController::class, 'fetchProductDetails'])->name('fetchProductDetails');


    //category view
    Route::get('/pm/addNewCategory', function () {
        return view('PurchasingManager.add-new-category');
    })->name('pm.category');
    //category create
    Route::post('/pm/newCategory', [CategoryController::class, 'create'])->name('pm.newCategory');
    // category edit
    Route::get('/pm/Category/edit', [CategoryController::class, 'edit'])->name('category.edit');
    //route to update category data
    Route::post('/pm/Category/update', [CategoryController::class, 'update'])->name('category.update');
    // route to get all category details table
    Route::get('/categories/fetchAllCategoryData', [CategoryController::class, 'fetchAllCategoryData'])->name('fetchAllCategoryData');



    //view to add new brand
    Route::get('/pm/addNewBrand', function () {
        return view('PurchasingManager.add-new-brand');
    })->name('pm.brand');
    Route::get('/categories/fetch', [CategoryController::class, 'fetchCategories'])->name('categories.fetch');
    // create new brand
    Route::post('/pm/newBrand', [BrandController::class, 'create'])->name('pm.newBrand');
    //route to fetch all brand data
    Route::get('/pm/home/fetchAllBrandData', [BrandController::class, 'fetchAllBrandData'])->name('fetchAllBrandData');
    //route to edit brand data
    Route::get('/pm/Brand/edit', [BrandController::class, 'edit'])->name('brand.edit');
    //route to update brand data
    Route::post('/pm/Brand/update', [BrandController::class, 'update'])->name('brand.update');
    // route to get all brand details
    Route::get('/brands/fetch', [BrandController::class, 'fetchBrands'])->name('brands.fetch');


    //view to add new brand
    Route::get('/pm/addNewBrand', function () {
        return view('PurchasingManager.add-new-brand');
    })->name('pm.brand');
    // create new brand
    Route::post('/pm/newBrand', [BrandController::class, 'create'])->name('pm.newBrand');
    //route to fetch all brand data
    Route::get('/pm/home/fetchAllBrandData', [BrandController::class, 'fetchAllBrandData'])->name('fetchAllBrandData');
    //route to edit brand data
    Route::get('/pm/Brand/edit', [BrandController::class, 'edit'])->name('brand.edit');
    //route to update brand data
    Route::post('/pm/Brand/update', [BrandController::class, 'update'])->name('brand.update');
    // route to get all brand details
    Route::get('/brands/fetch', [BrandController::class, 'fetchBrands'])->name('brands.fetch');

    //view to add new item
    Route::get('/pm/addNewItem', function () {
        return view('PurchasingManager.add-new-item');
    })->name('pm.item');
    // create new item
    Route::post('/pm/newItem', [ItemsController::class, 'create'])->name('pm.newItem');
    //route to fetch all item data ( Not for users)
    Route::get('/pm/home/fetchAllItemData', [ItemsController::class, 'fetchAllItemData'])->name('fetchAllItemData');
    //route to fetch all item data ( Only for users)
    Route::get('/user/home/fetchAllItemData', [ItemsController::class, 'fetchAllItemDataUser'])->name('fetchAllItemDataUser');
    //route to edit product data
    Route::get('/pm/Item/edit', [ItemsController::class, 'edit'])->name('item.edit');
    //route to update item data
    Route::post('/pm/Item/update', [ItemsController::class, 'update'])->name('item.update');




    //route to the view product levels
    // Route::get('/pm/product-limits', function () {
    //     return view('PurchasingManager.PM-product-limits');
    // });
    Route::get('/pm/product-limits', [ProductController::class, 'pmProductLimits']);
    //route to fetch all product level data
    Route::get('/pm/ViewItemsUnderProduct/{product_id}', [ProductController::class, 'fetchItemsUnderProduct']);

    //Items and users who have them
    Route::get('/pm/items-with-users', [ProductController::class, 'fetchItemsAndUsers']);

    Route::get('/pm/viewProducts', function () {
        return view('PurchasingManager.View-products');
    });

    Route::get('/pm/chech/storeRecords', function () {
        return view('PurchasingManager.Store-Check-Record');
    });

    //route to view all requests users make to get items
    Route::get('/pm/view-all-requests', function () {
        return view('PurchasingManager.View-all-user-requests');
    });

    //route to view all requests users make when returning  items
    Route::get('/pm/view-all-returns', function () {
        return view('PurchasingManager.View-all-user-returns');
    });

    //view all processing-requests
    Route::get('/pm/view-processing-requests', function () {
        return view('PurchasingManager.view-all-processing-requests');
    });
    //route to fetch all processing requests data
    Route::post('/pm/fetchAllProcessingRequestDataPM', [RequestsController::class, 'fetchAllProcessingRequestDataPM'])->name('fetchAllProcessingRequestDataPM');

    //view-processing-returns
    Route::get('/pm/view-processing-returns', function () {
        return view('PurchasingManager.view-all-processing-returns');
    });
    //route to fetch all processing returns data
    Route::post('/pm/fetchAllProcessingReturnDataPM', [RequestsController::class, 'fetchAllProcessingReturnDataPM'])->name('fetchAllProcessingReturnDataPM');


    //view issued items history for purchasing manager
    Route::get('/pm/view-issued-items-history', function () {
        return view('PurchasingManager.view-issued-items-history');
    });
    //route to fetch all requests history data ( issued items history)
    Route::post('/pm/fetchAllRequestsHistory', [RequestsController::class, 'fetchAllRequestsHistoryPM'])->name('fetchAllRequestsHistoryPM');


    //view accepted items history for purchasing manager
    Route::get('/pm/view-accepted-items-history', function () {
        return view('PurchasingManager.view-returned-items-history');
    });
    //route to fetch all returns history data
    Route::post('/pm/fetchAllReturnsHistory', [RequestsController::class, 'fetchAllReturnsHistoryPM'])->name('fetchAllReturnsHistoryPM');

    //view rejected requests history
    Route::get('/pm/view-rejected-history', function () {
        return view('PurchasingManager.view-rejected-items-history');
    })->name('storeManager.rejected');
    //route to fetch all rejected requests history
    Route::post('/pm/fetchAllRejectsHistoryPM', [RequestsController::class, 'fetchAllRejectsHistoryPM'])->name('fetchAllRejectsHistoryPM');


    //view rejected retruns history
    Route::get('/pm/view-rejected-return-history', function () {
        return view('PurchasingManager.view-rejected-returns-history');
    })->name('storeManager.rejected.returns');
    //route to fetch all rejected requests history
    Route::post('/pm/fetchAllRejectReturnsHistoryPM', [RequestsController::class, 'fetchAllRejectReturnsHistoryPM'])->name('fetchAllRejectReturnsHistoryPM');
});
//--------------End purchasing manager routes-----------------




//--------------store manager routes-----------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
    // 'CheckStoreManagerRole'
])->group(function () {


    //home route
    Route::get('/storeManager/home', [StoreManagerDashboardController::class, 'index'])->name('storeManager.home');



    //view to see items with users
    Route::get('/storeManager/view-user-items', function () {
        return view('storeManager.view-all-user-items');
    });
    //route to fetch all items at users
    Route::get('/storeManager/fetchItemsAtUsers', [RequestsController::class, 'fetchItemsAtUsers'])->name('fetchItemsAtUsers');



    //view requests by users
    Route::get('/storeManager/view-requested-items', function () {
        return view('storeManager.view-rquest-item');
    })->name('storeManager.requests');
    //route to fetch all requests data
    Route::post('/storeManager/fetchAllRequestData', [RequestsController::class, 'fetchAllRequestData'])->name('fetchAllRequestData');

    //view-processing-requests
    Route::get('/storeManager/view-processing-requests', function () {
        return view('storeManager.view-processing-requests');
    })->name('storeManager.processing-requests');
    //route to fetch all processing requests data
    Route::post('/storeManager/fetchAllProcessingRequestData', [RequestsController::class, 'fetchAllProcessingRequestData'])->name('fetchAllProcessingRequestData');

    //view issued items history
    Route::get('/storeManager/view-issued-items-history', function () {
        return view('storeManager.view-issued-items-history');
    })->name('storeManager.requests');
    //route to fetch all requests history data ( issued items history)
    Route::post('/storeManager/fetchAllRequestsHistory', [RequestsController::class, 'fetchAllRequestsHistory'])->name('fetchAllRequestsHistory');


    //view rejected requests history
    Route::get('/storeManager/view-rejected-history', function () {
        return view('storeManager.view-rejected-history');
    })->name('storeManager.rejected');
    //route to fetch all rejected requests history
    Route::post('/storeManager/fetchAllRejectedHistory', [RequestsController::class, 'fetchAllRejectedHistory'])->name('fetchAllRejectedHistory');

    //view rejected returns history
    Route::get('/storeManager/view-rejected-returns-history', function () {
        return view('storeManager.SMcomponent.rejected-returns-history');
    });
    //route to fetch all rejected returns history
    Route::post('/storeManager/fetchAllRejectedReturnsHistory', [RequestsController::class, 'fetchAllRejectedReturnsHistory'])->name('fetchAllRejectedReturnsHistory');



    //view returns by users
    Route::get('/storeManager/view-return-items', function () {
        return view('storeManager.view-return-item');
    })->name('storeManager.returns');
    //route to fetch all returns data
    Route::post('/storeManager/fetchAllReturnData', [RequestsController::class, 'fetchAllReturnData'])->name('fetchAllReturnData');

    //view-processing-returns
    Route::get('/storeManager/view-processing-returns', function () {
        return view('storeManager.view-processing-returns');
    })->name('storeManager.processing-returns');
    //route to fetch all processing returns data
    Route::post('/storeManager/fetchAllProcessingReturnData', [RequestsController::class, 'fetchAllProcessingReturnData'])->name('fetchAllProcessingReturnData');

    //view accepted items history
    Route::get('/storeManager/view-accepted-items-history', function () {
        return view('storeManager.view-accepted-items-history');
    })->name('storeManager.requests');
    //route to fetch all returns history data
    Route::post('/storeManager/fetchAllReturnsHistory', [RequestsController::class, 'fetchAllReturnsHistory'])->name('fetchAllReturnsHistory');




    //route to change the status of a request
    Route::post('/storeManager/RequestAction', [RequestsController::class, 'RequestAction'])->name('RequestAction');
    //route to get data for request process modal
    Route::get('/storeManager/dataForProcessModal', [RequestsController::class, 'dataForProcessModal'])->name('dataForProcessModal');
    //route to send process reqeust modal data to request controller
    Route::post('/storeManager/processRequest', [RequestsController::class, 'processRequest'])->name('processRequest');
    //route to make a request to return an item
    Route::get('/user/request-return', [RequestsController::class, 'makeRequestReturn'])->name('makeRequest.return');





    //store visit route
    Route::get('/storeManager/store', function () {
        return view('storeManager.store');
    });

    // Not returned items
    Route::get('/Store/Not-Returned_Items', function () {
        return view('storeManager.Not-Returned-items');
    });

    //rote for sm to view low limits
    Route::get('/storeManager/product-limits', [ProductController::class, 'smProductLimits']);
    //route to fetch all product level data for sm
    Route::get('/storeManager/ViewItemsUnderProduct/{product_id}', [ProductController::class, 'fetchItemsUnderProductSM']);


    // store history view
    Route::get('/store/History', function () {
        return view('storeManager.history-store');
    });

    //view return items
    Route::get('/siba-store-view-return-items', function () {
        return view('storeManager.view-return-item');
    });

    //route to store page catagory table Item table catagory --> sub catagory
    Route::get('/siba-store-item-by-catagory-table', function () {
        return view('storeManager.Item-by-catargory-page');
    });

    Route::get('/update-profile', function () {
        return view('publicComponent.profile');
    });;

    //low quentity product route
    Route::get('/store/low-quentity', function () {
        return view('storeManager.low-quentity-product');
    });;
});


//--------------End store manager routes-----------------




//-------------------------------------------------Department user------------------------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    // 'verified',
    // 'CheckStoreManagerRole'
])->group(function () {
    //home view route
    Route::get('/user/home', [UserDashboardController::class, 'index'])->name('user.home');


    //user update profile
    // Route::get('user/update-profile' , function(){
    //     return view('DepartmentUser.user-update-profile');
    // });;

    Route::get('user-update-profile', function () {
        return view('publicComponent.update-profile');
    });

    //view store
    Route::get('/user/view-store', function () {
        return view('DepartmentUser.visit-store-user');
    });
    //requested item table view
    Route::get('/user/RequestItemTableView', function () {
        return view('DepartmentUser.storereqtable');
    });
    //returned item table view
    Route::get('/user/ReturnedItemTableView', function () {
        return view('DepartmentUser.user-returned-items');
    });

    //route to make request
    Route::post('/user/newRequest', [RequestsController::class, 'create'])->name('request.create');
    //route to check if an existing request is their
    Route::post('/checkExistingRequest', [RequestsController::class, 'checkExistingRequest'])->name('checkExistingRequest');

    //route to view user my request history
    Route::post('/user/fetchMyRequestData', [RequestsController::class, 'fetchMyRequestData'])->name('fetchMyRequestData');
    //route to view user my return history
    Route::post('/user/fetchMyReturnData', [RequestsController::class, 'fetchMyReturnData'])->name('fetchMyReturnData');
    //route to view current items user have
    Route::get('/user/user-myItems', function () {
        return view('DepartmentUser.user-myItems');
    });
    //route to view items user has currently
    Route::post('/user/fetchMyItems', [RequestsController::class, 'fetchMyItems'])->name('fetchMyItems');
});
//-------------------------------------------------End Department user------------------------------------------------






//-------------------------------------------------Error pages------------------------------------------------

Route::get('/accountDeactivated', function () {
    return view('errors.accountDeactivated');
})->name('accountDeactivated');
//-------------------------------------------------End Error pages------------------------------------------------





// -------------------------------------------human resource---------------------------------------------------------
// meka athle route hadann epaaa---------------------

Route::get('/HR-Home', function () {
    return view('HumanResource.HR-Cleark.HRC-Home');
});

Route::get('/HR-AddNewEMP', function () {
    return view('HumanResource.AddNewEMP');
});






// ---------------------------------------------------------------end of human resource---------------------------------------------------/
