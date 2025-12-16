<?php

namespace Modules\StaticPage\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\StaticPage\Entities\StaticPage;
use Modules\StaticPage\Http\Requests\Admin\StoreRequest;
use Modules\StaticPage\Http\Requests\Admin\UpdateRequest;

class StaticPageController extends Controller
{
    public function index()
    {
        $static_pages = StaticPage::all();

        return view('staticpage.index', compact('static_pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('staticpage::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Renderable
     */
    public function store(StoreRequest $request)
    {
        StaticPage::create($request->validated());

        return redirect()->route('admin.static_pages.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit(StaticPage $static_page)
    {
        return view('staticpage::edit', compact('static_page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(UpdateRequest $request, StaticPage $static_page)
    {
        if (in_array($static_page->id, [1, 2, 3])) {
            if ($request->ar['name'] != $static_page->translate('ar')->name || $request->en['name'] != $static_page->translate('en')->name) {
                return redirect()->back()->with('error', 'لا يمكنك تعديل إسم هذة الصفحة');
            }
        }
        $static_page->update($request->validated());

        return redirect()->route('admin.static_pages.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy(StaticPage $static_page)
    {
        if (in_array($static_page->id, [1, 2, 3])) {
            return redirect()->route('admin.static_pages.index')->with('error', 'لا يمكنك حذف هذة الصفحة');
        }
        $static_page->delete();

        return redirect()->route('admin.static_pages.index')->with('success', 'تم الحذف بنجاح');
    }
}
