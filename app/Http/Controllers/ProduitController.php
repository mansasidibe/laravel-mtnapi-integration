<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $produits = Produit::get();
        return view('dashboard', compact('produits'));
    }

    public function checkout()
    {
        return view('checkout');
    }

    public function doCheck()
    {
        # code...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATION
        $produit = $this->validate($request, [
            'name' => 'required|string',
            'prix' => 'required',
            'description' => 'required',
            'photo' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048',
        ]);

        // VERIFIONS S'IL A AJOUTE UNE PHOTO
        if ($request->hasFile('photo')) {

            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->store('public/img');

            $produit = new Produit();
            $produit->name = $request->name;
            $produit->price = $request->price;
            $produit->description = $request->description;
            $produit->photo = $path;
        }
        // FAISONS LA REDIRECTION MAINTENANT
        return redirect('/home')->with('message', "Produit ajouté avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function show(Produit $produit)
    {
        //
        // return view('dashboard', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function edit(Produit $produit)
    {

        // return view('dashboard', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produit $produit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produit  $produit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produit $produit)
    {
        //
    }
}
