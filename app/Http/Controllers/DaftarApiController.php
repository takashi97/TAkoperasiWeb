<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class DaftarApiController extends Controller
{
    public function processDaftarUMKMForm($id, Request $request)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'alamat_ktp' => 'required|string',
                'nik' => 'required|digits:16|unique:users,nik,'.$user->id,
                'npwp' => 'required|regex:/^[0-9]{15}$/',
            ]);

            $user->level = 'umkm';
            $user->name = $validatedData['name'];
            $user->alamat_ktp = $validatedData['alamat_ktp'];
            $user->nik = $validatedData['nik'];
            $user->npwp = $validatedData['npwp'];

            if ($request->hasFile('image_ktp')) {
                $image = $request->file('image_ktp');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('image_ktp/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $user->image_ktp = $filename;
            }

            $user->save();

            return response()->json(['success' => 'Data updated successfully.'], 200);
        } catch (\Exception $e) {
            $errorMessage = 'An error occurred while processing the form.';

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                // Handle validation errors
                $errorMessage = $e->validator->errors()->first();
            } elseif ($e instanceof \Illuminate\Database\QueryException) {
                // Handle database query errors
                $errorMessage = 'Database query error.';
            }

            return response()->json(['error' => $errorMessage], 500);
        }
    }

    public function processDaftarMemberForm(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'alamat_ktp' => 'required|string',
                'nik' => 'required|digits:16|unique:users,nik,'.$user->id,
            ]);

            $user->level = 'member';
            $user->name = $validatedData['name'];
            $user->alamat_ktp = $validatedData['alamat_ktp'];
            $user->nik = $validatedData['nik'];

            if ($request->hasFile('image_ktp')) {
                $image = $request->file('image_ktp');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('image_ktp/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $user->image_ktp = $filename;
            }

            $user->save();

            return response()->json(['success' => 'Data updated successfully.'], 200);
        } catch (\Exception $e) {
            $errorMessage = 'An error occurred while processing the form.';

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                // Handle validation errors
                $errorMessage = $e->validator->errors()->first();
            } elseif ($e instanceof \Illuminate\Database\QueryException) {
                // Handle database query errors
                $errorMessage = 'Database query error.';
            }

            return response()->json(['error' => $errorMessage], 500);
        }
    }
}