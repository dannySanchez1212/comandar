<?php

namespace Voyager\Http\Controllers;

use Pvtl\VoyagerPages\Page;
use Pvtl\VoyagerFrontend\Helpers\Layouts;
use Pvtl\VoyagerFrontend\Traits\Breadcrumbs;
use Pvtl\VoyagerFrontend\Helpers\BladeCompiler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PageController extends BaseController
{
    use Breadcrumbs;

    protected $viewPath = 'voyager-frontend';

    /**
     * POST B(R)EAD - Create data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return View
     */
    public function create(Request $request)
    {
        $view = parent::create($request);

        $view['layouts'] = Layouts::getLayouts('voyager-frontend');

        return $view;
    }


    /**
     * POST - Change Page Layout
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id - the page id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLayout(Request $request, $id)
    {
        $page = Page::findOrFail((int)$id);
        $page->layout = $request->layout;
        $page->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('voyager::generic.successfully_updated') . " Page Layout",
                'alert-type' => 'success',
            ]);
    }

    public function getPage2($slug = 'home')
    {
        $page = Page::where(['slug' => $slug, 'status' => 'ACTIVE'])->firstOrFail();

        return view("modules.pages.default", [
            'page' => $page,
        ]);
    }
    public function getPage($slug = 'home')
    {
        $view = $this::getPage2($slug);
        dd($view);
        $page = Page::findOrFail((int)$view->page->id);

        $view->layout = $page->layout;
        $view = BladeCompiler::getHtmlFromString($view, [], true);

        return $view;
    }

}
