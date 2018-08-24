<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Configuration;

class Helper
{
    /**
     * Tag entities
     * @param  [type]  $tagType [name of tag type]
     * @param  array   $tags    [vector of tags]
     * @param  [type]  $entity  [object to be tagged]
     * @param  boolean $sync    [detach all tags before tagging]
     * @return [type]           [description]
     */
    public static function tag($tagType, $tags = [], $entity, $sync = false) {

        if ($sync) {
            $todetach = array_pluck($entity->tags->where('type', $tagType), 'id');
            $entity->tags()->detach($todetach);
        }

        if(count($tags)) {
            foreach (array_unique($tags) as $t) {
                $tag = \App\Tag::firstOrNew([
                    'tag'  => $t,
                    'type' => $tagType,
                ]);

                $entity->tags()->save($tag);
                $entities[] = $tag;
            }
        }
    }

    /**
     * TO BE FIXED
     * Get all tags byt type about a specific model.
     * Actually the bug here is that it doesn filter on model type
     * @param  [type] $tagType [description]
     * @param  [type] $model   [description]
     * @return [type]          [description]
     */
    public static function getSpecificModelTags($tagType, $model) {

        return \App\Tag::where([
            'type' => $tagType,
        ])->get();

    }

    public static function getConfiguration($key) {
        return Configuration::where([
            'key' => $key
        ])->first();
    }

    public static function getPageToView($request) {

        $page   = Page::where('route', $request->route()->getName())->with('fields')->first();
        $fields = $page->fields->keyBy('htmlid');

        $view = str_after(config('filesystems.disks.views.root'), 'views/') . '/' . $page->template;
        $view = str_before($view, '.blade.php');
        $view = str_replace('/', '.', $view);

        return [
            'page'   => $page,
            'view'   => $view,
            'fields' => $fields,
        ];
    }


    public static function getViewPath($view) {
        $root = config('filesystems.disks.views.root');
        $path = $root . '/' . str_replace(".", "/", $view) . '.blade.php';
        return $path;
    }


}
