<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //-------------------------------------------- get all data
    public function index()
    {
        try {
            $employees = Post::all();

            if ($employees->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'employees' => $employees,
                    'message' => 'Records found',
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No records found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    //-------------------------------------------- get data by id
    public function show($id)
    {
        $record = Post::find($id);

        if (!$record) {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return response()->json($record);
    }

    //-------------------------------------------- post data
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'email' => 'required|string|max:191',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages(),
            ], 422);
        }try {
            $employee = Post::create([
                'name' => $request->name,
                'address' => $request->address,
                'email' => $request->email,
            ]);
            if ($employee) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Employee added successfully',
                    'employee' => $employee,
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Failed to add employee',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }   

    //-------------------------------------------- update data by id
    public function update(Request $request, $id)
    {
        $employee = Post::find($id);

        if (!$employee) {
            return response()->json([
                'action' => 404,
                'message' => 'Employee not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'email' => 'required|string|max:191,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'action' => 422,
                'error' => $validator->messages()
            ], 422);
        }

        $employee->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
        ]);

        return response()->json([
            'action' => 200,
            'message' => 'Employee updated successfully',
            'employee' => $employee
        ], 200);
    }

    //-------------------------------------------- delete data by id
    public function destroy($id)
    {
        $employee = Post::find($id);

        if (!$employee) {
            return response()->json([
                'action' => 404,
                'message' => 'Employee not found'
            ], 404);
        }

        $employee->delete();

        return response()->json([
            'action' => 200,
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}
