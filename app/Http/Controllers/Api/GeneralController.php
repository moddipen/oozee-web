<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Models\Cms;
use App\Models\Country;
use App\Models\Feedback;
use App\Models\ImageTemplate;
use App\Models\News;
use App\Models\Notification;
use App\Models\SubTag;
use App\Models\Tag;
use App\Models\TempMedia;
use App\Models\TextTemplate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * @return array
     * Get all countries
     */
    public function countries()
    {
        $countries = Country::select('id', 'name', 'code')->get();
        return $this->makeResponse('', ['countries' => $countries], 200);
    }

    /**
     * @return array
     * Get all active blog
     */
    public function blogs()
    {
        $blogs = Blog::with('creator')->where('status', 1)->get();
        return $this->makeResponse('', ['blogs' => $blogs], 200);
    }

    /**
     * @return array
     * Get blog by id
     */
    public function blogById($id)
    {
        $blog = Blog::with('creator')->find($id);
        if ($blog) {
            return $this->makeResponse('', ['blog' => $blog], 200);
        } else {
            return $this->makeResponse('Data not found !', [], 404);
        }

    }

    /**
     * @return array
     * Get all active news
     */
    public function news()
    {
        $news = News::with('creator')->where('status', 1)->get();
        return $this->makeResponse('', ['news' => $news], 200);
    }

    /**
     * @return array
     * Get news by id
     */
    public function newsById($id)
    {
        $news = News::with('creator')->find($id);
        if ($news) {
            return $this->makeResponse('', ['news' => $news], 200);
        } else {
            return $this->makeResponse('Data not found !', [], 404);
        }
    }

    /**
     * @return array
     * Get all active cms
     */
    public function cms()
    {
        $cms = Cms::with('creator')->where('status', 1)->get();
        return $this->makeResponse('', ['cms_pages' => $cms], 200);
    }

    /**
     * @return array
     * Get news by id
     */
    public function cmsById($id)
    {
        $cms = Cms::with('creator')->find($id);
        if ($cms) {
            return $this->makeResponse('', ['cms_page' => $cms], 200);
        } else {
            return $this->makeResponse('Data not found !', [], 404);
        }
    }

    /**
     * @return array
     */
    public function tags()
    {
        $tags = Tag::select('id', 'name')->get();
        return $this->makeResponse('', ['tags' => $tags], 200);
    }

    /**
     * @param $id
     * @return array
     */
    public function subTagsById($id)
    {
        $tags = SubTag::select('id', 'name')->where('tag_id', $id)->get();
        return $this->makeResponse('', ['sub_tags' => $tags], 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addMedia(Request $request)
    {
        $types = ['voice', 'recordings', 'profile', 'vcard', 'message'];
        if($request->type && in_array($request->type, $types)) {
            $temp = new TempMedia();
            $temp->message = $request->type == 'message' || $request->type == 'voice' ? 1 : 0;
            if ($temp->save()) {
                if ($request->hasFile('media')) {
                    $temp->addMediaFromRequest('media')->toMediaCollection($request->type);
                    $media = $temp->getFirstMedia($request->type);
                    if (in_array($request->type, ['voice', 'profile', 'message'])) {
                        $id = url('/').$temp->getFirstMediaUrl($request->type);
                    } else {
                        $id = $media->id;
                    }
                    return $this->makeResponse('Media saved.', ['id' => $id], 200);
                } else {
                    return $this->makeError('Media file is required !', [], 410);
                }
            } else {
                return $this->makeError('Please try again', [], 410);
            }
        } else {
            return $this->makeError('Type is required and must be like, '. implode(',', $types), [], 410);
        }
    }

    /**
     * @return array
     */
    public function textTemplates()
    {
        $templates = TextTemplate::all();
        return $this->makeResponse('', ['templates' => $templates], 200);
    }

    /**
     * @return array
     */
    public function imageTemplates()
    {
        $templates = ImageTemplate::all();
        return $this->makeResponse('', ['templates' => $templates], 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getNotifications(Request $request)
    {
        $model = new Notification();
        $data = $model->getNotifications($request->user_id);
        return $this->makeResponse('', ['notifications' => $data], 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getUserDetailsByNumber(Request $request)
    {
        $model = new User();
        $data = $this->setNumber($request->phone_number, $request->country_id);
        $result = $model->getUserDetailsByNumber($data);
        $data = [
            'first_name' => $result->first_name ?? '',
            'last_name' => $result->last_name ?? '',
            'email' => $result->email ?? '',
            'gender' => $result->gender ?? '',
            'user_id' => $result->user_id,
            'dob' => $result->dob ?? '',
            'photo' => $result->photo ?? '',
            'nick_name' => $result->nick_name ?? '',
            'about' => $result->about ?? '',
            'address' => $result->address ?? '',
            'website' => $result->website ?? '',
            'industry' => $result->industry ?? '',
            'company_name' => $result->company_name ?? '',
            'company_address' => $result->company_address ?? ''
        ];
        return $this->makeResponse('', $data, 200);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function feedback(Request $request)
    {
        $model = new Feedback();
        $model->create($request->all());
        return $this->makeResponse('Feedback sent.', [], 200);
    }
}
