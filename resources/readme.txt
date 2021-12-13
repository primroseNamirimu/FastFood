######### Installing Yayjara datatables

run the command
composer require yajra/laravel-datatables-oracle:"~9.0"

or this, for the all in one installer
composer require yajra/laravel-datatables:^1.5

2. In config/app 

'providers' => [
    // ...
    Yajra\DataTables\DataTablesServiceProvider::class,
],

3.publish using 

php artisan vendor:publish --tag=datatables

4. Add this to the aliases in the config/app
'DataTables' => Yajra\DataTables\Facades\DataTables::class,