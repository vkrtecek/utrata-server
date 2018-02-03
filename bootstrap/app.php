<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

/*###################  DAO ########################*/
$app->app->bind('App\Model\Dao\ICheckStateDAO', 'App\Model\Dao\CheckStateDAO');
$app->app->bind('App\Model\Dao\ICurrencyDAO', 'App\Model\Dao\CurrencyDAO');
$app->app->bind('App\Model\Dao\IItemDAO', 'App\Model\Dao\ItemDAO');
$app->app->bind('App\Model\Dao\ILanguageDAO', 'App\Model\Dao\LanguageDAO');
$app->app->bind('App\Model\Dao\IMemberDAO', 'App\Model\Dao\MemberDAO');
$app->app->bind('App\Model\Dao\IPurposeDAO', 'App\Model\Dao\PurposeDAO');
$app->app->bind('App\Model\Dao\ITranslationDAO', 'App\Model\Dao\TranslationDAO');
$app->app->bind('App\Model\Dao\IWalletDAO', 'App\Model\Dao\WalletDAO');
$app->app->bind('App\Model\Dao\IMemberPurposeDAO', 'App\Model\Dao\MemberPurposeDAO');

/*###################  SERVICES ###################*/
$app->app->bind('App\Model\Service\ICheckStateService', 'App\Model\Service\CheckStateService');
$app->app->bind('App\Model\Service\ICurrencyService', 'App\Model\Service\CurrencyService');
$app->app->bind('App\Model\Service\IItemService', 'App\Model\Service\ItemService');
$app->app->bind('App\Model\Service\ILanguageService', 'App\Model\Service\LanguageService');
$app->app->bind('App\Model\Service\IMemberService', 'App\Model\Service\MemberService');
$app->app->bind('App\Model\Service\IPurposeService', 'App\Model\Service\PurposeService');
$app->app->bind('App\Model\Service\ITranslationService', 'App\Model\Service\TranslationService');
$app->app->bind('App\Model\Service\IWalletService', 'App\Model\Service\WalletService');
$app->app->bind('App\Model\Service\IMemberPurposeService', 'App\Model\Service\MemberPurposeService');
$app->app->bind('App\Model\Service\IFileService', 'App\Model\Service\CsvService');

return $app;
