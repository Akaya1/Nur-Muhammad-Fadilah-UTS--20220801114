<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontendController extends Controller
{
    // Metode untuk menampilkan halaman depan dengan daftar produk
    public function home()
    {
        $products = Product::all(); // Mengambil semua produk dari database
        return view('frontend.index', compact('products'));
    }

    // Metode untuk menambahkan rating dan ulasan ke produk tertentu
    public function addRatingReview(Request $request, $productId)
    {
        // Validasi data yang dikirim dari form
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        // Temukan produk berdasarkan ID yang diberikan
        $product = Product::findOrFail($productId);

        // Simpan rating dan ulasan ke dalam atribut produk
        $product->rating = $request->rating;
        $product->review = $request->review;
        $product->save();

        // Redirect kembali ke halaman depan dengan pesan sukses
        return redirect()->route('frontend.index')->with('success', 'Rating and review added successfully.');
    }
}
