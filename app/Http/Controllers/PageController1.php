<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Routing\RouteCollection;
use Illuminate\Support\Facades\Validator;
use \Symfony\Component\DomCrawler\Crawler;

use \App\CustomField;
use \App\Helper;
use \App\Page;
use Storage;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Prepare the main pages list analyzing the set of frontend routes
     * that have a name starting with "page"
     *
     * @return [type]
     */
    public function index() {

        #Create the pages list
        $pages = [];

        $routes = app()->routes->getRoutesByName();

        $page_routes = array_where($routes, function ($value, $key) {
            return starts_with($key, 'page');
        });

        foreach ($page_routes as $r) {
            $page_db = Page::firstOrCreate([
                'route' => $r->getAction()['as'],
            ]);
        }

        return view('backend.pages.pages',[
            'pages' => Page::paginate(20),
        ]);
    }

    /**
     * Edit the page parameters and fields
     *
     * @param  Page
     * @return [type]
     */
    public function edit(Page $page) {

        $pagehtml = null;
        $fields = null;

        #Create the views list
        $views = Storage::disk('views')->allFiles();

        // $route = app()->routes->getByName($page->route);

        if ($page->template) {

            $page_view = config('filesystems.disks.views.root');
            $pagehtml  = file_get_contents($page_view . '/' . $page->template);

            #controllo se ci sono campi custom anche nelle viste importate
            $count = preg_match_all("/@include\('(.+?)'\)/", $pagehtml, $included_pagehtml);

            if ($count) {
                foreach ($included_pagehtml[1] as $includedHtmlPage) {
                    $viewname = resource_path() . '/views/' . str_replace('.', '/', $includedHtmlPage) . '.blade.php';
                    $pagehtml .= file_get_contents($viewname);
                }
            }

            $crawler = new Crawler($pagehtml);

            $editableFields = $crawler->filter('div[data-editable="yes"]');

            $ids = [];

            foreach ($editableFields as $editableFiled) {

                $f = new Crawler($editableFiled);

                $field = null;

                if ($page->fields->where('htmlid', $f->attr('id'))->count()) {
                    $field = $page->fields->where('htmlid', $f->attr('id'))->first();
                } else {
                    $field = new CustomField();
                    $field->htmlid = $f->attr('id');
                }

                $field->type  = $f->attr('data-type');
                $field->label = $f->attr('data-label');
                $field->order = $f->attr('data-order');

                $page->fields()->save($field);
                $ids[] = $f->attr('id');
            }

            #Elimino quelli che non sono presenti nella pagina => quelli il cui htmlid non rientra negli id dei campi editabili appena identificati nella pagina template
            #Potrebbe essere che ho cambiato template oppure ho modificato il template
            $page->fields()->whereNotIn('htmlid', $ids)->delete();

            $fields = $page->fields()->orderBy('order')->get();

        }

        return view('backend.pages.pages.page-edit',[

            'page'      => $page,
            'pages'     => Page::all(),
            'fields'    => $fields,
            'templates' => $views,

        ]);
    }

    /**
     * Update the page parameters
     *
     * @param  Request
     * @param  Page
     * @return [type]
     */
    public function update (Request $request, Page $page) {

        $validator = Validator::make($request->all(), [
            'name'     => 'required|max:255',
            'template' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $page->name       = $request->input('name');
        $page->template   = $request->input('template');
        $page->status     = $request->exists('publish');
        $page->restricted = $request->exists('restricted');

        if ($request->input('title') != null) {
            $page->title = $request->input('title');
        }

        if ($request->input('copyright') != null) {
            $page->copyright = $request->input('copyright');
        }

        if ($request->input('description') != null) {
            $page->description = $request->input('description');
        }

        if ($request->input('favicon') != null) {
            $page->favicon = $request->input('favicon');
        }

        $page->save();

        $tags = explode(',', $request->input('tags'));
        for ($i=0; $i < count($tags); $i++) {
            $tags[$i] = trim($tags[$i]);
        }

        if (head($tags) != null) {
            Helper::tag('page-keywords', $tags, $page, true);
        }

        return redirect()->back()->with([
            'message' => [
                'text' => 'Page correctly saved!',
                'type' => 'success',
            ]
        ]);
    }

    /**
     * Function to update complex easy-slider fields
     * @param  CustomField
     * @param  [type]
     * @return [type]
     */
    public function updateEasySliderField (CustomField $field, $value) {

        if ($field->value == null) {
            $slides = [];
        } else {
            $slides = $field->value;
        }

        array_push($slides, $value);
        $field->value = $slides;

        return $field;
    }

    /**
     * Delete a slide from a easy-slyder field
     * @param  Request
     * @param  Page
     * @param  CustomField
     * @param  [type]
     * @return [type]
     */
    public function deleteEasySliderSlide(Request $request, Page $page, CustomField $field, $slideToken) {

        $slides = collect($field->value);
        $slides = $slides->filter(function ($item) use ($slideToken) {
            return $item['id'] != $slideToken;
        });

        $field->value = $slides;
        $field->save();

        return redirect()->back()->with([
            'message' => [
                'text' => 'Fields correctly saved!',
                'type' => 'success',
            ]
        ]);
    }

    /**
     * Dispatcher based on field type
     *
     * @param  Request
     * @param  Page
     * @param  CustomField
     * @return [type]
     */
    public function updateFields(Request $request, Page $page, CustomField $field) {

        $params       = $request->all();
        $params['id'] = md5(json_encode($request->all()));

        switch ($field->type) {
            case 'easyslider':
                $field = $this->updateEasySliderField($field, $params);
                break;

            default:
                $field->value = $params;
                break;
        }

        $field->save();

        return redirect()->back()->with([
            'message' => [
                'text' => 'Fields correctly saved!',
                'type' => 'success',
            ]
        ]);
    }

    /**
     * Function to get Cloudinary resources on the base of tags
     * @param  Request
     * @param  Page
     * @return [type]
     */
    public function cloudinarySearch(Request $request, Page $page) {

        // $cloudinary = \Cloudder::getApi();
        // return $cloudinary->tags(['max_results' => '100']);

        // $cloudinary = \Cloudder::getSearch();
        // return $cloudinary->expression('tags:eddie')->with_field('tags')->max_results(10)->execute();

        // return $cloudinary->resources_by_tag('eddie', [
        //     'next_cursor' => $request->input('next'),
        //     'with_field'  => 'tags',
        // ]);
        // return cl_image_tag($res['resources'][0]['public_id'], array("width"=>100, "height"=>100, "crop"=>"fit"));

        if ($request->input('q', false)) {
            $answer = [];
            $results = [];
            $cloudinary = \Cloudder::getApi();
            $items = $cloudinary->resources_by_tag(str_replace(' ', '', $request->input('q')), [
                'next_cursor' => $request->input('next', ''),
                'with_field'  => 'tags',
            ]);

            foreach ($items['resources'] as $i) {
                $results[] = [
                    'id'   => $i['public_id'],
                    'text' => $i['public_id'],
                    'img'  => cl_image_tag($i['public_id'], array("width"=>100, "height"=>100, "crop"=>"fit")),
                ];
            }

            if (isset($items['next_cursor'])) {
                $answer['pagination']['more'] = true;
                $answer['pagination']['next'] = $items['next_cursor'];
            } else {
                $answer['pagination']['more'] = false;
                $answer['pagination']['next'] = null;
            }

            $answer['results'] = $results;

            return $answer;
        }
    }


}
