<?php

namespace App\Providers;

use App\Repositories\EarningRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ProjectRepository;
use Facade\FlareClient\View;
use Illuminate\Routing\Console\MiddlewareMakeCommand;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{

    public function __construct()
    {
        $this->projects = resolve(ProjectRepository::class);
        $this->earning = resolve(EarningRepository::class);
    }


    private function contractorStatistic()
    {
        return view()->composer('Contractor.Layout.leftMenu', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                $allProjects = $this->projects->getContractorProject($user->id)->count();
                $ongoingProjects = $this->projects->getContractorOngoingProject($user->id)->count();
                $finishedProjects = $this->projects->getContractorFinishedProject($user->id)->count();
                $earning = $this->earning->getContractorEarnings($user->id)->count();
                $credit = $this->earning->getContractorCredits($user->id)->count();
                $view->with([
                    'allProjects' => $allProjects,
                    'ongoingProjects' => $ongoingProjects,
                    'finishedProjects' => $finishedProjects,
                    'earning' => $earning,
                    'credit' => $credit
                ]);
            }
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->contractorStatistic();
        Schema::defaultStringLength('191');
    }
}
