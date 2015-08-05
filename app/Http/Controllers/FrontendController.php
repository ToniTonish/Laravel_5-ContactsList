<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Number;
use App\Email;

use Input;
use Redirect;
use Response;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showUsers()
    {
        //
        $users = User::all();

        return view('frontend.home', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function addNewContact()
    {
        //

        return view('frontend.addcontact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
        $user = new User();
        $phone = new Number();
        $email = new Email();

        $user->nome = Input::get('name');
        $user->cognome = Input::get('lastname');
        $user->indirizzo = Input::get('address');
        $user->im_profilo = Input::get('image');
        $user->slug = $user->nome.$user->cognome;

        if (Input::file('image') == "") {
            $user->im_profilo = 'uploads/default.png';
        }
        else if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            $user->im_profilo = $destinationPath.'/'.$fileName;
            // sending back with message
            //Session::flash('success', 'Upload successfully'); 
        } else {
            $user->im_profilo = 'uploads/default.png';
        }

        $user->save();

        if (Input::get('phone') != null) {
            $phone->phone = Input::get('phone');
            $phone->user_id = $user->id;

            $phone->save();
        }

        if (Input::get('email') != null) {
            $email->email = Input::get('email');
            $email->user_id = $user->id;

            $email->save();
        }


        return Redirect::to('home');
    }

    public function deleteUser() 
    {
        $id = Input::get('id');

        $user = User::find($id);
        $user->delete();

        return Redirect::to('home');
    }

    public function deletePhoneNumber()
    {

        $slug = Input::get('userSlug');
        $phone = Input::get('userPhone');
        //dd($slug);

        $user = User::where('slug', '=', $slug)->first();

        $number = Number::where(['user_id' => $user->id, 'phone' => $phone])->first();
        //dd($number);

        $number->delete();

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    public function deleteMail()
    {

        $slug = Input::get('userSlug');
        $mail = Input::get('userMail');
        //dd($slug);

        $user = User::where('slug', '=', $slug)->first();

        $e_mail = Email::where(['user_id' => $user->id, 'email' => $mail])->first();
        //dd($number);

        $e_mail->delete();

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    public function addPhoneNumber() 
    {
        $number = new Number();

        $slug = Input::get('userSlug');
        $user = User::where('slug', '=', $slug)->first();

        $number->phone = Input::get('userPhone');
        $number->user_id = $user->id;

        $number->save();

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    public function updateUserPhoneNumber()
    {
        $slug = Input::get('userSlug');
        $user = User::where('slug', '=', $slug)->first();

        $oldPhone = Input::get('oldUserPhone');
        $newPhone = Input::get('newUserPhone');

        Number::where(['user_id' => $user->id, 'phone' => $oldPhone])->update(array(
            'phone'    =>  $newPhone,
            'user_id'  => $user->id
        ));

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    public function addMailNumber() 
    {
        $mail = new Email();

        $slug = Input::get('userSlug');
        $user = User::where('slug', '=', $slug)->first();

        $mail->email = Input::get('userMail');
        $mail->user_id = $user->id;

        $mail->save();

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    public function updateUserMail()
    {
        $slug = Input::get('userSlug');
        $user = User::where('slug', '=', $slug)->first();

        $oldMail = Input::get('oldUserMail');
        $newMail = Input::get('newUserMail');

        Email::where(['user_id' => $user->id, 'email' => $oldMail])->update(array(
            'email'    =>  $newMail,
            'user_id'  => $user->id
        ));

        return Response::json(['success' => true, 'response' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editUser($slug)
    {
        //
        $user = User::where('slug', '=', $slug)->first();

        $number = Number::where('user_id', '=', $user->id)->get();

        $mail = Email::where('user_id', '=', $user->id)->get();

        $option[0] = $user;
        $option[1] = $number;
        $option[2] = $mail;  
        //dd($option);

        return view('frontend.edit', compact('option'));
    }

    public function editUserInformation($slug)
    {
        //
        $firstname = Input::get('name');
        $lastname = Input::get('lastname');
        $address = Input::get('address');
        $profileImg = Input::file('image');
        $newSlug = $firstname.$lastname;

        if (Input::file('image') == "") {
            User::where('slug', '=', $slug)->update(array(
            'nome' => $firstname,
            'cognome' => $lastname,
            'indirizzo' => $address,
            'slug' => $newSlug
            ));
        }
        else if (Input::file('image')->isValid()) {
            $destinationPath = 'uploads'; // upload path
            $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $fileName = rand(11111,99999).'.'.$extension; // renameing image
            Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
            $newUserPath = $destinationPath.'/'.$fileName;
            // sending back with message
            User::where('slug', '=', $slug)->update(array(
            'nome' => $firstname,
            'cognome' => $lastname,
            'indirizzo' => $address,
            'im_profilo' => $newUserPath,
            'slug' => $newSlug
            ));

            //Session::flash('success', 'Upload successfully'); 
        } else {
            //dd($profileImg);
        }
        //dd($option);

        return Redirect::to('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
