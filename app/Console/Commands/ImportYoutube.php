<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Helper;

class ImportYoutube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start ...');
        $id = \Youtube::getChannelByName('schooltoonchannel')->id;

        // $lastVideo = \App\Video::orderBy('publishedAt', 'desc')->first();
        // if (isset($lastVideo->publishedAt)) {
        //     $params['publishedAfter'] = Carbon::parse($lastVideo->publishedAt)->addSeconds(10)->toRfc3339String();
        // }
        // $this->info('Starting from: ' . $params['publishedAfter']);
        $params = [
            'channelId'  => $id,
            'order'      => 'date',
            'type'       => 'video',
            'part'       => 'id, snippet',
            // 'pageToken'  => $request->input('pageToken',null),
            'maxResults' => 40
        ];
        $videos = \Youtube::searchAdvanced($params,true);

        $bar = $this->output->createProgressBar($videos['info']['totalResults']);

        do {

            $videos = \Youtube::searchAdvanced($params,true);

            if (isset($videos['results']) && count($videos['results']) > 1) {
                foreach ($videos['results'] as $video) {

                    $details = \Youtube::getVideoInfo($video->id->videoId);

                    $post = \App\Post::firstOrNew([
                        'extra->Youtube->id' => $details->id,
                        'type'             => 'video',
                    ]);

                    $post->title        = $details->snippet->title;
                    $post->version      = 1;
                    $post->type         = 'video';
                    $post->slug         = str_slug($details->snippet->title);
                    $post->excerpt      = $details->snippet->description;
                    $post->published_at = Carbon::parse($details->snippet->publishedAt)->format('Y-m-d H:i:s');
                    $post->is_published = true;

                    if (isset($details->snippet->thumbnails->maxres->url)){
                        $img_res = $details->snippet->thumbnails->maxres->url;
                    } else if (isset($details->snippet->thumbnails->standard->url)) {
                        $img_res = $details->snippet->thumbnails->standard->url;
                    } else if (isset($details->snippet->thumbnails->high->url)) {
                        $img_res = $details->snippet->thumbnails->high->url;
                    }

                    $upload = \Cloudder::upload(
                        $img_res,
                        [],
                        [
                            'public_id'       => $details->id,
                            'unique_filename' => false,
                            'folder'          => 'YouTube',
                            'overwrite'       => true,
                        ],
                        isset($details->snippet->tags) ? $details->snippet->tags : []
                    );

                    $u = (object)$upload->getResult();

                    $post->extra        = [
                        'media' => [
                            'Youtube'   => $details,
                            'picture'   => $u,
                        ],
                    ];

                    $post->save();

                    $bar->advance();
                }
            }

            $params = [
                'channelId'  => $id,
                'order'      => 'date',
                'type'       => 'video',
                'part'       => 'id, snippet',
                'pageToken'  => $videos['info']['nextPageToken'],
                'maxResults' => 40
            ];

        } while(!is_null($videos['info']['nextPageToken']));
    }
}

