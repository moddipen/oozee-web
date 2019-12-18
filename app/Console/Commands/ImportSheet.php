<?php

namespace App\Console\Commands;

use App\Models\Country;
use App\Models\TempContact;
use Brick\PhoneNumber\PhoneNumber;
use Brick\PhoneNumber\PhoneNumberException;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Spatie\MediaLibrary\Models\Media;

class ImportSheet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sheet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import sheet to temp contacts';

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
        ini_set('memory_limit', '-1');
        $media = Media::where('collection_name', 'sheet')->where('created_at', '<=', Carbon::now()->addMinutes(-10))->first();
        if ($media) {
            $countryId = $media->custom_properties['country'];
            $path = $media->getFullUrl();
            $data = array_map('str_getcsv', file($path));
            $keys = array_shift($data);
            $countryName = Country::find($countryId)->name;
            foreach ($data as $i=>$row) {
                $data[$i] = array_combine($keys, $row);
                $contact = $data[$i];
                $location = $contact['State_Circle'] ?? ''. $countryName;
                $state = $contact['State_Circle'] ?? '';
                $email = $contact['Email_ID'] ?? '';
                $gender = $contact['Gender'] ?? '';
                $provider = $contact['Service_Provider'] ?? '';
                $activeDate = $contact['Activation_Date'] ?? null;

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
                        $contact = TempContact::where([
                            'country_id' => $countryId,
                            'phone_number' => $number,
                            'user_id' => 0
                        ])->first();
                        if (!$contact) {
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
                            $contact->active_date = $activeDate;
                            $contact->save();
                        } else {
                            if ($activeDate != null) {
                                if ($contact->active_date == null) {
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
                                    $contact->active_date = $activeDate;
                                    $contact->save();
                                } else if ($contact->active_date < $activeDate) {
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
                                    $contact->active_date = $activeDate;
                                    $contact->save();
                                }
                            }
                        }
                    } catch (\Exception $e) {
                        continue;
//                  return $this->makeError($e->getMessage(), [], 410);
                    }
                }
            }
            $media->delete();
        }
    }
}
