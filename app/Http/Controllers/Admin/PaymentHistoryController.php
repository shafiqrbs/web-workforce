<?php

namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use Input;
use File;
use Carbon\Carbon;
use ImgUploader;
use Redirect;
use App\PaymentHistory;
use App\Language;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DataTables;
use App\Http\Requests\SalaryPeriodFormRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PaymentHistoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexPaymentHistory()
    {
        $users = DB::table('payment_transactions_history')
            ->join('users','users.id', '=','payment_transactions_history.user_id')
            ->join('packages','packages.id', '=','payment_transactions_history.package_id')
            ->get();

        $languages = DataArrayHelper::languagesNativeCodeArray();
        return view('admin.payment_history.index')
            ->with('languages', $languages)
            ->with('users', $users);
    }

}
