<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Country;
use App\Models\Tag;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use JeroenDesloovere\VCard\VCard;

class SearchController extends Controller
{
    protected $model;

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    public function search($iso, $number)
    {
        $data = [];
        $data['phone'] = $number;
        $country = Country::where('iso', $iso)->first();

        if (!is_numeric($number)) {
            $data['country'] = $country;
            $data['phone_number_id'] = 0;
            return view('frontend.profile', compact('data', 'tags'));
        }

        if (!$country) {
            $country = Country::first();
            $data['country'] = $country;
            $data['phone_number_id'] = 0;
            return view('frontend.profile', compact('data', 'tags'));
        }
        $data['cid'] = $country->id;
        $data['user_id'] = 0;
        $result = $this->model->searchContact($data);
//        echo '<pre>';
//        print_r($result);
//        exit();
        $name = '';
        if ($result->first_name || $result->last_name) {
            $name = $result->first_name.' '.$result->last_name;
        }
        $data['country'] = $country;
        $data['name'] = Cookie::get('name-'.$number) ? Cookie::get('name-'.$number) : $name;
        $data['spam'] = Cookie::get('spam-'.$number) ? Cookie::get('spam-'.$number) : false;
        $data['email'] = $result->email ?? '';
        $data['address'] = $result->address ?? '';
        $data['photo'] = $result->photo ?? '';
        $data['phone_number'] = $number;
        $data['user_id'] = $result->user_id;
        $data['contact_id'] = $result->contact_id ?? 0;
        $data['phone_number_id'] = $result->number_id ?? 1;
        $data['tag'] = Cookie::get('tag-'.$number) ? Cookie::get('tag-'.$number) : null;
        $tags = Tag::select('id', 'name')->get();
        return view('frontend.profile', compact('data', 'tags'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function updateContact(Request $request)
    {
        if ($request->type == 'name') {
            $cookie = cookie()->forever('name-' . $request->number, $request->name);
            $msg = 'Your suggestions was successfully submitted. Thank you for improving our service!';
        } elseif ($request->type == 'tag') {
            $cookie = cookie()->forever('tag-' . $request->number, $request->name);
            $msg = 'Your report was successfully submitted. Thank you for improving our service!';
        } else {
            $spam = Cookie::get('spam-'.$request->number) ? !Cookie::get('spam-'.$request->number) : true;
            $cookie = cookie()->forever('spam-' . $request->number, $spam);
            $msg = 'Your report was successfully submitted. Thank you for improving our service!';
        }
        return response($msg)->cookie($cookie);
    }

    /**
     * @param Request $request
     */
    public function downloadContact(Request $request)
    {
        $vcard = new VCard();
        $vcard->addName('', $request->cname, '', '', '');
        $vcard->addPhoneNumber($request->cnumber, 'WORK');
        if ($request->cemail) {
            $vcard->addEmail($request->cemail);
        }
        if ($request->caddress) {
            $vcard->addAddress(null, null, null, null, $request->caddress, null, null);
        }
        return $vcard->download();
    }
}
