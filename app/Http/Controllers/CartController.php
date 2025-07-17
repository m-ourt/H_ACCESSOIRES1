<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    //Affiche  panier de l'utilisateur connecté
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        return Inertia::render('Panier/Panier', [
            'cartItems' => $cartItems,
        ]);
    }

    // Ajoute un produit au panier
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();

        // Vérifier si produit dans  panier
        $existing = CartItem::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existing) {
            // Incrémenter 
            $existing->quantity += $request->quantity ?? 1;
            $existing->save();
        } else {
            // nouvel article dans le panier
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1,
            ]);
        }

        return redirect()->route('panier')->with('success', 'Produit ajouté au panier');
    }

    //Supprimer  produit panier
    public function delete($id)
    {
        $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return back()->with('success', 'Produit supprimé du panier');
    }

    //  Mettre à jour la quantité
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('id', $id)->where('user_id', Auth::id())->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return back()->with('success', 'Quantité mise à jour');
    }
}


