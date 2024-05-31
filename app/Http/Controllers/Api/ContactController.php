<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\ContactResource;
use App\Http\Resources\StadisticResource;
use App\Models\Api\AgifyApi;
use App\Models\Api\GenderizeApi;
use App\Models\Api\MailboxlayerApi;
use App\Models\Api\NationalizeApi;
use App\Models\Api\Contact;
use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ContactController extends BaseController
{
    use ApiTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->sendResponse(ContactResource::collection(Contact::all()),'List of contacts.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('csv')) {
            try {
                $records = $this->getCsv($request);

                foreach ($records as $record) {
                    $mailValidation = $this->checkUserEmail($record);

                    $contactRegister = Contact::where('email', $record['email'])->count();

                    if (count($mailValidation) == 0 || $contactRegister != 0) {
                        $record['valid'] = false;
                        break;
                    }

                    $contact = Contact::create([
                        'user_id' => Auth::user()->id,
                        'name' => $record['name'],
                        'email' => $record['email'],
                        'mail_smtp_check' => $mailValidation['smtp_check'],
                        'mail_role' => $mailValidation['role'],
                        'mail_disposable' => $mailValidation['disposable'],
                        'mail_free' => $mailValidation['free'],
                    ]);

                    $this->saveAge($record['name'], $contact);
                    $this->saveGender($record['name'], $contact);
                    $this->saveNationality($record['name'], $contact);
                }

                return $this->sendResponse(ContactResource::collection(Contact::all()), 'Contacts create successfully.');

            } catch (\Throwable $th) {
                return $this->sendError('Error create contacts.', $th->getMessage());
            }
        } else {
            return $this->sendError('The csv is required.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->sendResponse(ContactResource::make(Contact::find($id)), 'User found successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $email)
    {
        try {
            Contact::where('email', $email)->delete();

            return $this->sendResponse('Remove contact with email: ' . $email,'Register remove successfull.');
        } catch (\Throwable $th) {
            return $this->sendError('Error remove contact.', $th->getMessage());
        }
    }

    public function stadistics(Request $request)
    {
        try {
            $dataContacts = Contact::where('user_id', $request->user()->id)->get();

            return $this->sendResponse(StadisticResource::make($dataContacts),'Data for contacts.');
        } catch (\Throwable $th) {
            return $this->sendError('Error show stadistic.', $th->getMessage());
        }
    }

    private function checkUserEmail(array $record)
    {
        $mailValidation = MailboxlayerApi::checkEmail($record['email']);

        if (!isset($mailValidation['success']) && $mailValidation['format_valid'] == true) {
            return [
                "user" => $mailValidation['user'],
                "domain" => $mailValidation['domain'],
                "format_valid" => $mailValidation['format_valid'],
                "mx_found" => $mailValidation['mx_found'],
                "smtp_check" => $mailValidation['smtp_check'],
                "catch_all" => $mailValidation['catch_all'],
                "role" => $mailValidation['role'],
                "disposable" => $mailValidation['disposable'],
                "free" => $mailValidation['free'],
            ];
        } else {
            return [];
        }
    }

    private function saveGender(string $name, Contact $contact)
    {
        $dataGender = GenderizeApi::checkGenderName($name);

        $contact->update([
            'estimates_gender' => $dataGender[0]['gender'] ?? null,
            'probability_gender' => $dataGender[0]['probability'] ?? null,
        ]);
    }

    private function saveAge(string $name, Contact $contact)
    {
        $dataAge = AgifyApi::checkAgeName($name);

        $contact->update([
            'estimates_age' => $dataAge[0]['age'] ?? null,
        ]);
    }

    private function saveNationality(string $name, Contact $contact)
    {
        $dataNation = NationalizeApi::checkNationalityName($name);

        $contact->update([
            'estimates_nationality' => $dataNation[0]['country'][0]['country_id'] ?? null,
            'probability_nationality' => $dataNation[0]['country'][0]['probability'] ?? null,
        ]);
    }
}
