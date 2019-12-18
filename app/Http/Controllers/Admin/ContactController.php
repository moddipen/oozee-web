<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Country;
use App\Models\TempContact;
use App\Models\TempMedia;
use App\Models\User;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $countries = Country::all();
        return view('admin.contacts.index', compact('countries'));
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getContacts()
    {
        $contacts = $this->model->getContacts();

        return DataTables::of($contacts)
            ->addColumn('phone_number', function ($contact) {
                return '+'.$contact->code.' '.$contact->number;
            })
            ->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $request->validate([
            'country' => 'required',
            'file' => 'required'
        ]);

        $temp = new TempMedia();
        if ($temp->save()) {
            if ($request->hasFile('file')) {
                $temp->addMediaFromRequest('file')
                    ->withCustomProperties(['country' => $request->country])
                    ->toMediaCollection('sheet');
                return redirect('admin/contacts')->with('success', 'Imported successfully !');
            } else {
                return redirect('admin/contacts')->with('error', 'Unable to import !');
            }
        } else {
            return redirect('admin/contacts')->with('error', 'Unable to import !');
        }

        $path = $request->file('file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $keys = array_shift($data);
        $countryId = $request->country;
        $countryName = Country::find($countryId)->name;
        foreach ($data as $i=>$row) {
            $data[$i] = array_combine($keys, $row);
            $contact = $data[$i];
            $location = $contact['State_Circle'] ?? ''. $countryName;
            $state = $contact['State_Circle'] ?? '';
            $email = $contact['Email_ID'] ?? '';
            $gender = $contact['Gender'] ?? '';
            $provider = $contact['Service_Provider'] ?? '';

            if ($contact['Mobile_Number'] != '') {
                if ($contact['Mobile_Number'][0] == '+') {
                    try {
                        $phone = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $contact['Mobile_Number']);
                        $parseNumber = PhoneNumber::parse('+' . $phone);
                        $number = $parseNumber->getNationalNumber();
                        $code = $parseNumber->getCountryCode();
                        $country = Country::where('code', $code)->first();
                        if ($country) {
                            $countryId = $country->id;
                            $location = $contact['State_Circle'] ?? ''. $country->name;
                        }
                    } catch (PhoneNumberException $e) {
                        continue;
//                      return $this->makeError($e->getMessage(), [], 410);
                    }
                } else {
                    $number = preg_replace('/[^a-zA-Z0-9_ -]/s', '', $contact['Mobile_Number']);
                }
                try {
                    $names = explode(' ', $contact['User_Name']);
                    $firstName = '';
                    $lastName = '';
                    if (count($names) > 1) {
                        $firstName = $names[0];
                        $lastName = $names[1];
                    } elseif (count($names) > 0) {
                        $firstName = $names[0];
                    }
                    $checkContact = TempContact::where([
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'country_id' => $countryId,
                        'phone_number' => $number
                    ])->first();
                    if (!$checkContact) {
                        $contact = new TempContact();
                        $contact->first_name = $firstName;
                        $contact->last_name = $lastName;
                        $contact->phone_number = $number;
                        $contact->country_id = $countryId;
                        $contact->user_id = 0;
                        $contact->email = $email;
                        $contact->location = $location;
                        $contact->state_circle = $state;
                        $contact->service_provider = $provider;
                        $contact->gender = $gender;
                        $contact->save();
                    }
                } catch (\Exception $e) {
                    continue;
//                  return $this->makeError($e->getMessage(), [], 410);
                }
            }
        }
        return redirect('admin/contacts')->with('success', 'Imported successfully !');
    }
}
