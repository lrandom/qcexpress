<?php

    namespace App\Http\Controllers\User;
    
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\ServiceSettings;

    
    class WriteControllers extends Controller{
        
        public function about(Request $request){
            $service = ServiceSettings::first();
            $data = ['content_write' => $service->about];
            return view('users.write', $data);
        }


        public function document(Request $request){
            $service = ServiceSettings::first();
            $data = ['content_write' => $service->how_to_buy];
            return view('users.write', $data);
        }


        public function policy(Request $request){
            $service = ServiceSettings::first();
            $data = ['content_write' => $service->policy];
            return view('users.write', $data);
        }


}