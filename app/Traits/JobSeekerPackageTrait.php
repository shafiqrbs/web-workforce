<?php

namespace App\Traits;

use DB;
use Carbon\Carbon;
use App\User;

trait JobSeekerPackageTrait
{

    public function addJobSeekerPackage($user, $package)
    {
        $now = Carbon::now();
        $user->package_id = $package->id;
        $user->package_start_date = $now;
        $user->package_end_date = $now->addDays($package->package_num_days);
        $user->jobs_quota = $package->package_num_listings;
        $user->availed_jobs_quota = 0;
        $user->update();
    }

    public function renewJobSeekerPackage($user, $package)
    {
        $now = Carbon::now();
//        $package_end_date = $user->package_end_date?$user->package_end_date:$now;
//        $current_end_date = Carbon::createFromDate($package_end_date->format('Y'), $package_end_date->format('m'), $package_end_date->format('d'));
        $user->package_id = $package->id;
        $startDate=$user->package_end_date&&$user->package_end_date>$now?$user->package_end_date:$now;
//        $user->package_start_date = $user->package_start_date?$user->package_start_date:$now;
//        $user->package_end_date = $current_end_date->addDays($package->package_num_days);
        $user->package_start_date = $startDate;
        $user->package_end_date = $startDate->addDays($package->package_num_days);
//        $user->jobs_quota = $package->package_num_listings;
//        $user->availed_jobs_quota = 0;
        $user->update();
    }

    public function updateJobSeekerPackage($user, $package)
    {
        $now = Carbon::now();
//        $package_end_date = $user->package_end_date;
//        $current_end_date = Carbon::createFromDate($package_end_date->format('Y'), $package_end_date->format('m'), $package_end_date->format('d'));
        $user->package_id = $package->id;
        $user->package_start_date = $now;
        $user->package_end_date = $now->addDays($package->package_num_days);
        $user->jobs_quota = $package->package_num_listings;
//        $user->availed_jobs_quota = 0;
        $user->update();
    }

}
