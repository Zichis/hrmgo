<?php

namespace App\Http\Controllers;

use App\Employee;
use App\TimeSheet;
use Illuminate\Http\Request;

class TimeSheetController extends Controller
{
    public function index(Request $request)
    {
        if(\Auth::user()->can('Manage TimeSheet'))
        {
            $employeesList = [];
            if(\Auth::user()->type == 'employee')
            {
                $timeSheets = TimeSheet::where('employee_id', \Auth::user()->id)->get();
            }
            else
            {
                $employeesList = Employee::where('created_by', \Auth::user()->creatorId())->get()->pluck('name', 'user_id');
                $employeesList->prepend('All', '');

                $timesheets = TimeSheet::where('created_by', \Auth::user()->creatorId());

                if(!empty($request->start_date) && !empty($request->end_date))
                {
                    $timesheets->where('date', '>=', $request->start_date);
                    $timesheets->where('date', '<=', $request->end_date);
                }

                if(!empty($request->employee))
                {
                    $timesheets->where('employee_id', $request->employee);
                }
                $timeSheets = $timesheets->get();
            }

            return view('timeSheet.index', compact('timeSheets', 'employeesList'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function create()
    {

        if(\Auth::user()->can('Create TimeSheet'))
        {
            $employees = Employee::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'user_id');

            return view('timeSheet.create', compact('employees'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('Create TimeSheet'))
        {
            $timeSheet = new Timesheet();
            if(\Auth::user()->type == 'employee')
            {
                $timeSheet->employee_id = \Auth::user()->id;
            }
            else
            {
                $timeSheet->employee_id = $request->employee_id;
            }

            $timeSheetCheck = TimeSheet::where('date', $request->date)->where('employee_id', $timeSheet->employee_id)->first();

            if(!empty($timeSheetCheck))
            {
                return redirect()->back()->with('error', __('Timesheet already created in this day.'));
            }

            $timeSheet->date       = $request->date;
            $timeSheet->hours      = $request->hours;
            $timeSheet->remark     = $request->remark;
            $timeSheet->created_by = \Auth::user()->creatorId();
            $timeSheet->save();

            return redirect()->route('timesheet.index')->with('success', __('Timesheet successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }

    }

    public function show(TimeSheet $timeSheet)
    {
        //
    }

    public function edit(TimeSheet $timeSheet, $id)
    {

        if(\Auth::user()->can('Edit TimeSheet'))
        {
            $employees = Employee::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'user_id');
            $timeSheet = Timesheet::find($id);

            return view('timeSheet.edit', compact('timeSheet', 'employees'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function update(Request $request, $id)
    {
        if(\Auth::user()->can('Edit TimeSheet'))
        {

            $timeSheet = Timesheet::find($id);
            if(\Auth::user()->type == 'employee')
            {
                $timeSheet->employee_id = \Auth::user()->id;
            }
            else
            {
                $timeSheet->employee_id = $request->employee_id;
            }

            $timeSheetCheck = TimeSheet::where('date', $request->date)->where('employee_id', $timeSheet->employee_id)->first();

            if(!empty($timeSheetCheck) && $timeSheetCheck->id != $id)
            {
                return redirect()->back()->with('error', __('Timesheet already created in this day.'));
            }

            $timeSheet->date   = $request->date;
            $timeSheet->hours  = $request->hours;
            $timeSheet->remark = $request->remark;
            $timeSheet->save();

            return redirect()->route('timesheet.index')->with('success', __('TimeSheet successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function destroy($id)
    {
        if(\Auth::user()->can('Delete TimeSheet'))
        {
            $timeSheet = Timesheet::find($id);
            $timeSheet->delete();

            return redirect()->route('timesheet.index')->with('success', __('TimeSheet successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
