<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function getCompanies()
    {
        $companies = Auth::user()->companies()->get();

        return response()->json(['status' => 'success','result' => $companies]);
    }

    /**
     *
     * @param Request $request
     */
    public function createCompany(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'description' => 'required|string|',
        ]);

        Company::create([
            'title' => $request->input('title'),
            'phone' => $request->input('phone'),
            'description' => $request->input('description'),
            'user_id' =>  Auth::user()->id,
        ]);
        $companies = Company::all();

        return response()->json(['status' => 'success','result' => $companies]);
    }
}
