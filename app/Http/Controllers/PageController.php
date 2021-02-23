<?php

namespace App\Http\Controllers;

use App\Album;
use App\Block;
use App\Catalog;
use App\CatalogItem;
use App\Media;
use App\Rubric;
use App\SiteSettings;
use App\Slider;
use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function main()
    {
        $meta_title = SiteSettings::getSetting('title-home-page', app()->getLocale())->value ?? '';
        $meta_description = SiteSettings::getSetting('description-home-page', app()->getLocale())->value ?? '';
        $videoUrl = SiteSettings::getSetting('video_on_home')->value ?? '';

        $slider = Slider::query()
            ->where('type', 'slider_home')
            ->orderBy('id', 'desc')
            ->get();
        $posts = [];
        $catalogList = Catalog::getOnlyParent();
        $blocks = Block::all();
        //$catalogImages = CatalogItem::where('display_home', 1)->limit(5)->get();
        $rubric = Rubric::where('slug', 'publikatsiebi')->first();
        if($rubric)
            $posts = $rubric->posts()
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();

        return view('front.pages.main', compact(
            'slider',
            'catalogList',
            'blocks',
            'posts',
            'meta_title',
            'meta_description',
            'videoUrl'
        ));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function show(Request $request)
    {
        $page = Page::where('slug', $this->parseUriString($request->path()))->first();
        if(!$page){
            return abort(404);
        }
        return view('front.pages.show', compact('page'));
    }

    private function parseUriString($path)
    {
        $arr = explode('/', $path, 2);
        if(count($arr) > 1) {
            return $arr[1];
        }
        return $path;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function contacts(Request $request)
    {
        $contactPage = Page::where('slug', 'contacts')->first();
        if(!empty($request->all())) {
            $messages = [
                'required' => trans('site.empty_field'),
                'email' => trans('site.email_validate')
            ];
            $v = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'subject' => 'required',
                'text' => 'required',
            ], $messages);

            if ($v->fails())
            {
                return redirect()->back()->withErrors($v->errors());
            }

            $name = $request->input('name');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $text = $request->input('text');
            $subject = $request->input('subject');

            $to = "support@okay-cms.ge";
            $txt = "Name: " . $name . PHP_EOL;
            $txt .= "Phone: " . $phone . PHP_EOL;
            $txt .= "Email: " . $email . PHP_EOL;
            $txt .= "Message: " . $text . PHP_EOL;

            $headers = "From: support@okay-cms.ge" . "\r\n";
            mail($to, $subject, $txt, $headers);
            return redirect()->back()->with('success', trans('site.success_message_send'));
        }
        return view('front.pages.contacts', compact('contactPage'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pagePhotoAlbum()
    {
        $pageTitle = trans('admin.photo_album');
        $criteria = ['collection_name' , 'noName'];
        $photos = Media::getAll($criteria, ['id' , 'DESC'], 12);
        return view('front.pages.photos', compact('pageTitle', 'photos'));
    }
}
