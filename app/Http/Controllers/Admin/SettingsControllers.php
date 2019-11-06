<?php
namespace App\Http\Controllers\Admin;
use App\ContactSettings;
use App\GeneralSettings;
use App\ServiceSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class SettingsControllers extends Controller
{
    //
    public function general()
    {
        $general = GeneralSettings::find(1)->first();
        return view('admin.settings.general',['general'=>$general]);
    }
    public function services()
    {
        $services = ServiceSettings::find(1)->first();
        return view('admin.settings.services',['services'=>$services]);
    }
    public function contacts()
    {
        $contacts = ContactSettings::find(1)->first();
        return view('admin.settings.contacts',['contacts'=>$contacts]);
    }
    public function postGeneral(Request $request)
    {
        $general = GeneralSettings::first();
        $this->validate($request,
            [
                'logo'  =>  'image|nullable',
                'exchange_rate_cn' =>  'numeric|nullable',
                'exchange_rate_us' =>  'numeric|nullable',
            ],
            [
               'logo.image'   =>  'We only support jpeg, png, gif, jpg...',
               'exchange_rate.numeric'   =>  'Please check again exchange rate',
               'exchange_rate.numeric'   =>  'Please check again exchange rate',
            ]);
        $old_image = $general->logo;
        if ($request->hasFile('logo')) {
            $file = $request->logo;
            $newFileName =  time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('pictures/logo'), $newFileName);
            $general->logo = 'pictures/logo/' . $newFileName;
            $general->save();
        }
        $general->site_name = $request->site_name;
        $general->author = $request->author;
        $general->keyword = $request->keyword;
        $general->about = $request->about;
        $general->description = $request->description;
        $general->currency_unit = $request->currency_unit;
        $general->exchange_rate_cn = $request->exchange_rate_cn;
        $general->exchange_rate_us = $request->exchange_rate_us;
        $general->link_app_android = $request->link_app_android;
        $general->link_app_ios = $request->link_app_ios;
        $general->link_tool_chrome = $request->link_tool_chrome;
        $general->link_tool_coccoc = $request->link_tool_coccoc;
        $general->save();
        return redirect()->back()->with('notify','Update successfully');
    }
    public function postServices(Request $request)
    {
        $service = ServiceSettings::find(1);
        $service->about = $request->about;
        $service->how_to_buy = $request->how_to_buy;
        $service->policy = $request->policy;
        $service->tariff = $request->tariff;
        $service->save();
        return redirect()->back()->with('notify','Update successfully');
    }
    public function postContacts(Request $request)
    {
        $contact = ContactSettings::find(1);
        $request->validate([
            'main_email' => 'email:rfc,dns|required',
            'main_phone' => 'numeric:10|required'
        ]);
        $contact->facebook = $request->facebook;
        $contact->instagram = $request->instagram;
        $contact->address = $request->address;
        $contact->hotline = $request->hotline;
        $contact->main_email = $request->main_email;
        $contact->main_phone = $request->main_phone;
        
        $arr=[];

        // var_dump(request('phone'));
        // exit();

        foreach (request('phone') as $item) {
            array_push($arr, $item);
        }

        $contact->phone =$arr;
        
        $arr2=[];
        foreach (request('email') as $item) {
            array_push($arr2, $item);
        }

        $contact->email =$arr2;
        $contact->save();
        return redirect()->back()->with('notify','Update successfully');
    }
    public function resetServices()
    {
        $service = ServiceSettings::first();
        $service->about = '';
        $service->how_to_buy = '';
        $service->policy = '';
        $service->tariff = 0;
        $service->save();
        return redirect()->back()->with('notify','Set to default');
    }
    public function resetGeneral()
    {
        $general = GeneralSettings::first();
        File::delete($general->logo);
        $general->logo = '';
        $general->site_name = '';
        $general->author = '';
        $general->keyword = '';
        $general->about = '';
        $general->description = '';
        $general->currency_unit = '';
        $general->exchange_rate_cn = 0.00;
        $general->exchange_rate_us = 0.00;
        $general->link_app_android = '';
        $general->link_app_ios = '';
        $general->link_tool_chrome = '';
        $general->link_tool_coccoc = '';
        $general->save();
        return redirect()->back()->with('notify','Set to default');
    }
    public function resetContacts()
    {
        $contact = ContactSettings::first();
        $contact->facebook = '';
        $contact->instagram = '';
        $contact->address = '';
        $contact->hotline = '';
        $contact->main_email = '';
        $contact->main_phone = '';
        $contact->phone = null;
        $contact->email = null;
        $contact->save();
        return redirect('admin/settings/contacts')->with('notify','Set to default');
    }
}