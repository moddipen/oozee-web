<?php

namespace App\Http\Controllers\Api;

use App\Models\BlockedContact;
use App\Models\Country;
use App\Models\DeadContact;
use App\Models\NumberTag;
use App\Models\QuickList;
use App\Models\Setting;
use App\Models\TempContact;
use App\Models\SpamNumber;
use App\Models\User;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use JeroenDesloovere\VCard\VCardParser;
use Spatie\MediaLibrary\Models\Media;

class ContactController extends Controller
{
    protected $model;

    /**
     * ContactController constructor.
     */
    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @param $data
     * @param $type
     * @return array
     */
    public function storeContacts($data, $type)
    {
        $codeNumber = $this->setNumber($data['phone_number'], $data['country_id']);
        if ($type == 'blocked') {

            $contact = new BlockedContact();

            $block = SpamNumber::where(['number' => $codeNumber['phone']])->first();
            if ($block) {
                if ($block->spam_by == 1) {
                    $block->counts = $block->counts + 1;
                }
            } else {
                $block = new SpamNumber();
                $block->number = $codeNumber['phone'];
                $block->spam_by = 1;
                $block->counts = 1;
            }
            $block->save();
            
        } elseif ($type == 'quick') {
            $contact = new QuickList();
        } elseif ($type == 'dead') {
            $contact = new DeadContact();
        }
        $contact->phone_number = $codeNumber['phone'];
        $contact->country_id = $codeNumber['cid'];
        $contact->user_id = $data['user_id'];
        if ($contact->save()) {
            return $this->makeResponse('Contact added to ' . $type . ' list.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 400);
        }
    }

    /**
     * @param Request $request
     * @return array
     * Add contact to block list
     */
    public function storeBlockContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'phone_number' => 'required',
            'user_id' => 'required'
        ]);
        $data = $request->all();
        return $this->storeContacts($data, 'blocked');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function storeMultipleBlockContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'user_id' => 'required',
            'contacts' => 'required'
        ]);

        $data = $request->all();
        foreach ($data['contacts'] as $number) {
            $contact = [
                'phone_number' => $number,
                'user_id' => $data['user_id'],
                'country_id' => $data['country_id']
            ];
            $this->storeContacts($contact, 'blocked');
        }
        return $this->makeResponse('Contacts added to block list.', [], 200);
    }

    /**
     * @param Request $request
     * @return array
     * Get blocked contact
     */
    public function getBlockedContacts(Request $request)
    {
        $user = $request->user();
        $contacts = BlockedContact::where('user_id', $user->id)->get();
        return $this->makeResponse('', ['contacts' => $contacts], 200);
    }

    /**
     * @param $id
     * @return array
     * Remove contact from blocked
     */
    public function destroyBlockedContacts($id)
    {
        $contact = BlockedContact::find($id);
        if ($contact) {
            $block = SpamNumber::where(['number' => $contact->phone_number])->first();
            if ($block && $block->spam_by == 1) {
                $block->counts = $block->counts - 1;
                $block->save();
            }
            $contact->delete();
            return $this->makeResponse('Remove contact from block list.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return array
     * Add contact to quick list
     */
    public function storeQuickContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'phone_number' => 'required',
            'user_id' => 'required'
        ]);

        $data = $request->all();
        return $this->storeContacts($data, 'quick');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function storeMultipleQuickContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'user_id' => 'required',
            'contacts' => 'required'
        ]);

        $data = $request->all();
        foreach ($data['contacts'] as $number) {
            $contact = [
                'phone_number' => $number,
                'user_id' => $data['user_id'],
                'country_id' => $data['country_id']
            ];
            $this->storeContacts($contact, 'quick');
        }
        return $this->makeResponse('Contacts added to quick list.', [], 200);
    }

    /**
     * @param Request $request
     * @return array
     * Get quicklist contacts
     */
    public function getQuickListContacts(Request $request)
    {
        $user = $request->user();
        $contacts = QuickList::where('user_id', $user->id)->get();
        return $this->makeResponse('', ['contacts' => $contacts], 200);
    }

    /**
     * @param $id
     * @return array
     * Remove contact from quick list
     */
    public function destroyQuickListContacts($id)
    {
        $contact = QuickList::find($id);
        if ($contact && $contact->delete()) {
            return $this->makeResponse('Remove contact from quick list.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return array
     * Add contact to dead
     */
    public function storeDeadContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'phone_number' => 'required',
            'user_id' => 'required'
        ]);

        $data = $request->all();
        return $this->storeContacts($data, 'quick');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function storeMultipleDeadContact(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'user_id' => 'required',
            'contacts' => 'required'
        ]);

        $data = $request->all();
        foreach ($data['contacts'] as $number) {
            $contact = [
                'phone_number' => $number,
                'user_id' => $data['user_id'],
                'country_id' => $data['country_id']
            ];
            $this->storeContacts($contact, 'dead');
        }
        return $this->makeResponse('Contacts added to dead list.', [], 200);
    }

    /**
     * @param Request $request
     * @return
     * Get dead contacts
     */
    public function getDeadContacts(Request $request)
    {
        $user = $request->user();
        $contacts = DeadContact::where('user_id', $user->id)->get();
        return $this->makeResponse('', ['contacts' => $contacts], 200);
    }

    /**
     * @param $id
     * @return array
     * Remove contact from quicklist
     */
    public function destroyDeadContacts($id)
    {
        $contact = DeadContact::find($id);
        if ($contact && $contact->delete()) {
            return $this->makeResponse('Remove contact from deadlist.', [], 200);
        } else {
            return $this->makeError('Something went wrong.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function searchContact(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'country_id' => 'required',
            'user_id' => 'required'
        ]);
        $data = $this->setNumber($request->phone_number, $request->country_id);
        $data['user_id'] = $request->user_id;

        $result = $this->model->searchContact($data);

        $photo = $result->photo ?? '';
        $data = [
            'phone_number' => $request->phone_number,
            'first_name' => $result->first_name ?? '',
            'last_name' => $result->last_name ?? '',
            'email' => $result->email ?? '',
            'address' => $result->address ?? '',
            'gender' => $result->gender ?? '',
            'locations' => $result->locations,
            'photo' => $photo,
        ];
        return $this->makeResponse('', $data, 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getNumberDetails(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'country_id' => 'required',
            'user_id' => 'required'
        ]);

        $data = $this->setNumber($request->phone_number, $request->country_id);

        $result = $this->model->getContactDetails([
            'phone_number' => $data['phone'],
            'country_id' => $data['cid'],
            'user_id' => $request->user_id
        ]);

        $photo = $result->photo ?? '';
        $gender = $result->gender ?? '';
        $data = [
            'phone_number' => $request->phone_number,
            'first_name' => $result->first_name ?? '',
            'last_name' => $result->last_name ?? '',
            'email' => $result->email ?? '',
            'address' => $result->address ?? '',
            'photo' => $photo,
            'gender' => $gender,
            'tag' => $result->tags,
            'mutual' => $result->mutual ?? 0,
            'mutual_list' => $result->mutual_list ?? [],
            'contact_user_id' => $result->user_id ?? 0,
            'service_provider' => $result->service_provider ?? '',
            'spam' => $result->spam,
            'website' => $result->website ?? '',
            'business' => $result->business ?? '',
            'locations' => $result->locations,
            'isBlock' => $result->isblock,
            'premium' => $result->subscribed == 1 ? true : false,
            'mutualEnable' => true
        ];
        if ($result->user_id) {
            $mutual = Setting::where('user_id', $result->user_id)->where('name', 'mutual')->first();
            if ($mutual) {
                $data['mutualEnable'] = $mutual->value == 0 ? false : true;
            }
        }
        return $this->makeResponse('', $data, 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function callPopupDetails(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'country_id' => 'required',
            'user_id' => 'required'
        ]);
        $data = $this->setNumber($request->phone_number, $request->country_id);
        $data['user_id'] = $request->user_id;
        $result = $this->model->searchContact($data);

        $photo = $result->photo ?? '';
        $data = [
            'phone_number' => $request->phone_number,
            'first_name' => $result->first_name ?? '',
            'last_name' => $result->last_name ?? '',
            'gender' => $result->gender ?? '',
            'location' => $result->address ?? '',
            'email' => $result->email ?? '',
            'photo' => $photo,
            'tag' => $result->tags,
            'contact_user_id' => $result->user_id ?? 0,
            'service_provider' => $result->service_provider ?? '',
            'spam' => $result->spam,
            'website' => $result->website ?? '',
            'business' => $result->business ?? '',
            'locations' => $result->locations,
            'premium' => $result->subscribed == 1 ? true : false,
        ];
        return $this->makeResponse('', $data, 200);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addTagToNumber(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required',
            'country_id' => 'required',
            'user_id' => 'required',
            'tags' => 'required'
        ]);

        try {
            $data = $this->setNumber($request->phone_number, $request->country_id);

            $this->model->removeTagsFromNumberByUser($request->user_id, $data['phone']);

            foreach (explode(',', $request->tags) as $tag) {
                $this->model->addTagToNumberByUser([
                    'tag_id' => $tag,
                    'user_id' => $request->user_id,
                    'number' => $data['phone'],
                    'cid' => $data['cid']
                ]);
            }

            $tags = $this->model->getNumberTagsByUser([
                'user_id' => $request->user_id,
                'number' => $data['phone'],
                'cid' => $data['cid']
            ]);

            return $this->makeResponse('Tag added.', ['tags' => $tags], 200);
        } catch (\Exception $exception) {
            return $this->makeError('Something went wrong !.', [], 410);
        }

//        $numbertag = new NumberTag();
//        $numbertag->phone_number = $data['phone'];
//        $numbertag->country_id = $data['cid'];
//        $numbertag->user_id = $request->user_id;
//        $numbertag->tag_id = $request->tag_id ??;
//        $numbertag->sub_tag_id = $request->sub_tag_id ?? 0;
//        if ($numbertag->save()) {
//            return $this->makeResponse('Tag added.', [], 200);
//        } else {
//            return $this->makeError('Something went wrong !.', [], 410);
//        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateTagToNumber(Request $request)
    {
        $this->validate($request, [
            'tag_id' => 'required',
            'id' => 'required'
        ]);

        $numbertag = NumberTag::find($request->id);
        if (!$numbertag) {
            return $this->makeError('Details not found !.', [], 410);
        }
        $numbertag->tag_id = $request->tag_id;
        $numbertag->sub_tag_id = $request->sub_tag_id ?? 0;
        if ($numbertag->save()) {
            return $this->makeResponse('Tag updated.', [], 200);
        } else {
            return $this->makeError('Something went wrong !.', [], 410);
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function syncContacts(Request $request)
    {
        $this->validate($request, [
            'country_id' => 'required',
            'user_id' => 'required',
            'media_id' => 'required'
        ]);
        $file = Media::find($request->media_id);
        if (!$file) {
            return $this->makeError('File not found !.', [], 404);
        }
        $userId = $request->user_id;
        try {
            $parser = VCardParser::parseFromFile(base_path() . $file->getUrl());
            foreach ($parser->getCards() as $card) {
                if (!empty($card->phone)) {
                    $phones = $card->phone;
                    $photo = '';
                    if (!empty($card->rawPhoto)) {
                        $photo = $this->saveBase64File('/uploads/contacts/', 'data:image/jpeg;base64,' . base64_encode($card->rawPhoto));
                    }
                    $email = '';
                    if (!empty($card->email)) {
                        $emails = $card->email;
                        foreach ($emails as $key => $value) {
                            $email = $emails[$key][0];
                            break;
                        }
                    }
                    $unique = [];
                    foreach ($phones as $key => $value) {
                        $unique[] = $phones[$key][0];
                    }
                    $unique = array_unique($unique);
                    foreach ($unique as $phone) {
                        $countryId = $request->country_id;
                        if ($phone != '') {
                            if ($phone[0] == '+') {
                                try {
                                    $phone = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $phone);
                                    $parseNumber = PhoneNumber::parse('+' . $phone);
                                    $number = $parseNumber->getNationalNumber();
                                    $code = $parseNumber->getCountryCode();
                                    $country = Country::where('code', $code)->first();
                                    if ($country) {
                                        $countryId = $country->id;
                                    }
                                } catch (PhoneNumberException $e) {
                                    continue;
//                                    return $this->makeError($e->getMessage(), [], 410);
                                }
                            } else {
                                $number = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $phone);
                                $number = str_replace(' ', '', $number);
                                $number = str_replace('-', '', $number);
                            }
                            try {
                                $lastName = $card->lastname;
                                if ($card->firstname == $card->lastname) {
                                    $lastName = '';
                                }
                                $checkContact = TempNewContact::where([
                                    'first_name' => $card->firstname,
                                    'last_name' => $lastName,
                                    'country_id' => $countryId,
                                    'phone_number' => $number
                                ])->first();
                                if (!$checkContact) {
                                    $contact = new TempNewContact();
                                    $contact->first_name = $card->firstname;
                                    $contact->last_name = $lastName;
                                    $contact->phone_number = $number;
                                    $contact->country_id = $countryId;
                                    $contact->user_id = $userId;
                                    $contact->photo = $photo;
                                    $contact->email = $email;
                                    $contact->save();
                                }
                            } catch (\Exception $e) {
                                continue;
//                                return $this->makeError($e->getMessage(), [], 410);
                            }
                        }
                    }
                }
            }
//            Storage::deleteDirectory(str_replace('/storage/','', $file->getUrl()));
//            $file->delete();
            return $this->makeResponse('Contact sync successfully.', [], 200);
        } catch (\Exception $e) {
            return $this->makeError($e->getMessage(), [], 410);
        }
    }
}
