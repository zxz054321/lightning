<?php
/**
 * Author: Abel Halo <zxz054321@163.com>
 */

namespace App\Providers;

use App\Foundation\ServiceProvider;
use Phalcon\Mvc\View\Engine\Php;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\View\Simple;

/**
 * Runs only in web environment
 * @package App\Providers
 */
class WebServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    protected function register()
    {
        $this->di->set('view', function () {
            $view = new Simple();
            $view->setViewsDir(VIEW_PATH.'/');
            $view->registerEngines([
                '.phtml' => Php::class,
                '.volt'  => function ($view, $di) {
                    $volt = new Volt($view, $di);

                    $volt->setOptions([
                        'compiledPath' => STORAGE_PATH.'/framework/views/',
                    ]);

                    return $volt;
                },
            ]);

            return $view;
        });
    }
}
