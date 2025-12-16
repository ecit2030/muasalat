<?php

namespace Modules\Student\Http\Controllers\Admin;

use App\Services\LocalFileService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\City\Entities\City;
use Modules\Client\Entities\Student;
use Modules\Client\Http\Requests\Admin\StoreRequest;
use Modules\Client\Http\Requests\Admin\UpdateRequest;
use Modules\Nationality\Entities\Nationality;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $clients = Student::all();

        return view('client::index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        $cities = City::all();
        $nationalities = Nationality::all();

        return view('client::create', compact('cities', 'nationalities'));
    }

    public function store(StoreRequest $request, LocalFileService $localFileService)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        if (isset($data['image'])) {
            $data['image'] = $localFileService->uploadImage('clients', $data['image']);
        }

        Student::Create($data);

        return redirect()->route('admin.clients.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show(Student $client)
    {
        return view('client::show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit(Student $client)
    {
        $cities = City::all();
        $nationalities = Nationality::all();

        return view('client::edit', compact('client', 'cities', 'nationalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(UpdateRequest $request, Student $client, LocalFileService $localFileService)
    {
        $data = $request->validated();
        if (isset($data['password']) && $data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        }
        if (isset($data['image'])) {
            $data['image'] = $localFileService->uploadImage('clients', $data['image'], $client->image);
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(Student $client)
    {
        $client->delete();
        //TODO:: delete image , times , subscriptions
        return redirect()->route('admin.clients.index')->with('success', 'تم الحذف بنجاح');
    }
}
