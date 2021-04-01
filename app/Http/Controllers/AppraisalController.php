<?php

namespace App\Http\Controllers;

use App\Appraisal;
use App\Branch;
use App\Employee;
use Illuminate\Http\Request;

class AppraisalController extends Controller
{

    public function index()
    {
        if(\Auth::user()->can('Manage Appraisal'))
        {
            $user = \Auth::user();
            if($user->type == 'employee')
            {
                $employee   = Employee::where('user_id', $user->id)->first();
                $appraisals = Appraisal::where('created_by', '=', \Auth::user()->creatorId())->where('branch', $employee->branch_id)->where('employee', $employee->id)->get();
            }
            else
            {
                $appraisals = Appraisal::where('created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('appraisal.index', compact('appraisals'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function create()
    {
        if(\Auth::user()->can('Create Appraisal'))
        {
            $technical      = Appraisal::$technical;
            $organizational = Appraisal::$organizational;
            $brances        = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');

            return view('appraisal.create', compact('technical', 'organizational', 'brances'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function store(Request $request)
    {

        if(\Auth::user()->can('Create Appraisal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'employee' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $appraisal                      = new Appraisal();
            $appraisal->branch              = $request->branch;
            $appraisal->employee            = $request->employee;
            $appraisal->appraisal_date      = $request->appraisal_date;
            $appraisal->customer_experience = $request->customer_experience;
            $appraisal->marketing           = $request->marketing;
            $appraisal->administration      = $request->administration;
            $appraisal->professionalism     = $request->professionalism;
            $appraisal->integrity           = $request->integrity;
            $appraisal->attendance          = $request->attendance;
            $appraisal->remark              = $request->remark;
            $appraisal->created_by          = \Auth::user()->creatorId();
            $appraisal->save();

            return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully created.'));
        }
    }

    public function show(Appraisal $appraisal)
    {
        return view('appraisal.show', compact('appraisal'));
    }


    public function edit(Appraisal $appraisal)
    {
        if(\Auth::user()->can('Edit Appraisal'))
        {
            $technical      = Appraisal::$technical;
            $organizational = Appraisal::$organizational;
            $brances        = Branch::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $brances->prepend('Select Branch', '');

            return view('appraisal.edit', compact('technical', 'organizational', 'brances', 'appraisal'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function update(Request $request, Appraisal $appraisal)
    {
        if(\Auth::user()->can('Edit Appraisal'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   'branch' => 'required',
                                   'employee' => 'required',
                               ]
            );
            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $appraisal->branch              = $request->branch;
            $appraisal->employee            = $request->employee;
            $appraisal->appraisal_date      = $request->appraisal_date;
            $appraisal->customer_experience = $request->customer_experience;
            $appraisal->marketing           = $request->marketing;
            $appraisal->administration      = $request->administration;
            $appraisal->professionalism     = $request->professionalism;
            $appraisal->integrity           = $request->integrity;
            $appraisal->attendance          = $request->attendance;
            $appraisal->remark              = $request->remark;
            $appraisal->save();

            return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully updated.'));
        }
    }


    public function destroy(Appraisal $appraisal)
    {
        if(\Auth::user()->can('Delete Appraisal'))
        {
            if($appraisal->created_by == \Auth::user()->creatorId())
            {
                $appraisal->delete();

                return redirect()->route('appraisal.index')->with('success', __('Appraisal successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}
