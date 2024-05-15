<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\User;
class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::paginate(10); // Adjust the number based on your preference
        return view('customer', compact('customers'));
    }

    // ... (Other methods remain unchanged)


    
    public function create()
    {
        $customer = new Customer;
        $customer->SN = $request->input('SN');
        $customer->LN = $request->input('LN');
  
        if($request->hasfile('Logo'))
        {
            $file = $request->file('Logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move()('assets/logos/',$filename);
            $highlights->image = $filename;
        } else {
            return $request;
            $highlights->image = '';
        }
        $customer->Description = $request->input('Description');
        $customer->SecteurActivite = $request->input('SecteurActivite');
        $customer->Categorie = $request->input('Categorie');
        $customer->Site_Web = $request->input('Site_Web');
        $customer->Adresse_mail = $request->input('Adresse_mail');
        $customer->Organigramme = $request->input('Organigramme');
        $customer->Network_Design = $request->input('Network_Design');
        $customer->Type = $request->input('Type');
        $customer->save();
        return View('customer')->with('customer',$customer);
    }
    

    public function edit($id)
    {
        $customer = Customer::find($id);

        // Check if the customer exists
        if (!$customer) {
            return redirect()->route('customer.index')->with('error', 'Customer not found');
        }

        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'SN' => 'required',
            'LN' => 'required',
            'Logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Allow the logo to be optional
            'Description' => 'required',
            'SecteurActivite' => 'required',
            'Categorie' => 'required',
            'Site_Web' => 'required',
            'Adresse_mail' => 'required|email',
            'Organigramme' => 'required',
            'Network_Design' => 'required',
            'Type' => 'required',
            // Add other validation rules for your fields
        ]);

        // Update the customer record
        $customer = Customer::find($id);

        // Update non-file fields
        $customer->update([
            'SN' => $request->input('SN'),
            'LN' => $request->input('LN'),
            'Description' => $request->input('Description'),
            'SecteurActivite' => $request->input('SecteurActivite'),
            'Categorie' => $request->input('Categorie'),
            'Site_Web' => $request->input('Site_Web'),
            'Adresse_mail' => $request->input('Adresse_mail'),
            'Organigramme' => $request->input('Organigramme'),
            'Network_Design' => $request->input('Network_Design'),
            'Type' => $request->input('Type'),
            // Add other fields accordingly
        ]);

        // Handle logo update if a new logo is provided
        if ($request->hasFile('Logo')) {
            // Delete the old logo if it exists
            if ($customer->Logo && file_exists(public_path('public/assets/logos/' . $customer->Logo))) {
                unlink(public_path('public/assets/logos/' . $customer->Logo));
            }

            // Upload the new logo
            $logoPath = $request->file('Logo')->store('logos', 'public');
            $customer->update(['Logo' => $logoPath]);
        }

        // Redirect back or to another page
        return redirect()->route('customers.edit', $id)->with('success', 'Customer updated successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'SN' => 'required',
            'LN' => 'required',
            'Logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Description' => 'required',
            'SecteurActivite' => 'required',
            'Categorie' => 'required',
            'Site_Web' => 'required',
            'Adresse_mail' => 'required|email',
            'Organigramme' => 'required',
            'Network_Design' => 'required',
            'Type' => 'required',
            // Add other fields here based on your form
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $customer = new Customer;
            $customer->SN = $request->input('SN');
            $customer->LN = $request->input('LN');

            if ($request->hasFile('Logo')) {
                $logoPath = $request->file('Logo')->store('public/assets/logos');
                $logoFilename = basename($logoPath);
                $customer->Logo = $logoFilename;
            }
            $customer->Description = $request->input('Description');
            $customer->SecteurActivite = $request->input('SecteurActivite');
            $customer->Categorie = $request->input('Categorie');
            $customer->Site_Web = $request->input('Site_Web');
            $customer->Adresse_mail = $request->input('Adresse_mail');
            $customer->Organigramme = $request->input('Organigramme');
            $customer->Network_Design = $request->input('Network_Design');
            $customer->Type = $request->input('Type');

            // Add other fields here based on your form

            $customer->save();

            return redirect()->route('customer.index')->with('success', 'Customer created successfully');
        } catch (\Exception $e) {
            // Log the error for further investigation
            \Log::error($e);

            return redirect()->route('customer.index')->with('error', 'Error creating customer');
        }
    }

    // public function display()
    // {
    //     // $customers = Customer::all();
    //     // return view('customerform')->with('customers', $customers);
    //     $customers = Customer::all();
    //     //return view('customer.index', compact('customers'));
    //     return response()->json([
    //         'customers' => $customers ],200);
    // }
    public function getCustomerByUserId($User_id)
    {
        // Find the response by ID
        $user = User::find($User_id);
    
        if (!$user) {
            // Handle the case where the response is not found
            return response()->json(['status' => 404, 'message' => 'user not found'], 404);
        }
    
        // Retrieve images associated with the response
        $customers = $user->customers;
    
        if ($customers->count() > 0) {
            // Return response with images and response ID
            return response()->json(['status' => 200, 'User_id' => $user->id, 'customers' => $customers], 200);
        } else {
            return response()->json(['status' => 404, 'message' => 'No images found for the given User_id'], 404);
        }
    
    }     

    
    // public function sstoree(Request $request)
    // {
    //     $customer = new Customer();
    
        
    //     $customer->SN = $request->input('SN');
    //     $customer->LN = $request->input('LN');
    
    //     if ($request->hasFile('Logo')) {
    //         $logoPath = $request->file('Logo');
    //         $extension = $logoPath->getClientOriginalExtension();
    //         $filename = time() . '.' . $extension;
    //         $logoPath->move('assets/logos/', $filename);
    //         $customer->Logo = $filename;
    //     } else {
    //         $customer->Logo = '';
    //     }
    
    //     $customer->Description = $request->input('Description');
    //     $customer->SecteurActivite = $request->input('SecteurActivite');
    //     $customer->Categorie = $request->input('Categorie');
    //     $customer->Site_Web = $request->input('Site_Web');
    //     $customer->Adresse_mail = $request->input('Adresse_mail');
    //     $customer->Organigramme = $request->input('Organigramme');
    //     $customer->Network_Design = $request->input('Network_Design');
    //     $customer->Type = $request->input('Type');
    
    //     $customer->save();
    
    //     return view('customer')->with('customers', $customer);
    // }
    public function sstoree(Request $request,$User_id)
    
    {
        // Validate incoming request data if needed
    
        $customer = new Customer();
    
        $customer->SN = $request->input('SN');
        $customer->LN = $request->input('LN');
    
        if ($request->hasFile('Logo')) {
            $logoPath = $request->file('Logo');
            $extension = $logoPath->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $logoPath->move('assets/', $filename);
            $customer->Logo = $filename;
        } else {
            $customer->Logo = '';
        }
    
        $customer->Description = $request->input('Description');
        $customer->user_id = $User_id;
        $customer->SecteurActivite = $request->input('SecteurActivite');
        $customer->Categorie = $request->input('Categorie');
        $customer->Site_Web = $request->input('Site_Web');
        $customer->Adresse_mail = $request->input('Adresse_mail');
        $customer->Organigramme = $request->input('Organigramme');
        $customer->Network_Design = $request->input('Network_Design');
        $customer->Type = $request->input('Type');
    
        $customer->save();
    
        // Return the newly created customer as a response
        return response()->json(['message' => 'Customer created successfully', 'customer' => $customer], 201);
    }
    


    public function getCustomerByID($id){
        $customer = Customer::find($id);
        if(is_null($customer)){
            return response()->json('Customer not found!', 404);
        }
        return response()->json($customer, 200);
    }
}
