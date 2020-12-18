<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Report;

class InvestorRelationsController extends Controller
{
    public function index() {
      $new_submissions = Report::newSubmissions();

        return view('investor_relations.investor', compact('new_submissions')); 
    }
}
