<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function products(Request $request)
    {
        $query = Product::with('category')
            ->where('stock', '>', 0);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(6)->withQueryString();
        $categories = Category::all();

        return view('user.products', compact('products', 'categories'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);

        return view('user.cart', compact('cart'));
    }

    public function addToCart(Request $request, $id)
{
    $product = Product::with('category')->findOrFail($id);

    $validated = $request->validate([
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    $quantity = (int) $validated['quantity'];

    if ($product->stock < 1) {
        return redirect()->back()->with('error', 'Produk sedang habis.');
    }

    if ($quantity > $product->stock) {
        return redirect()->back()
            ->withErrors(['quantity' => 'Jumlah melebihi stok yang tersedia.'])
            ->withInput();
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $newQty = $cart[$id]['quantity'] + $quantity;

        if ($newQty > $product->stock) {
            return redirect()->back()
                ->withErrors(['quantity' => 'Total jumlah di keranjang melebihi stok yang tersedia.'])
                ->withInput();
        }

        $cart[$id]['quantity'] = $newQty;
        $cart[$id]['subtotal'] = $cart[$id]['quantity'] * $cart[$id]['price'];
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'stock' => $product->stock,
            'category' => $product->category->name ?? '-',
            'subtotal' => $product->price * $quantity,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect()->route('user.cart')->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $product = Product::find($id);

        if (!$product) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->route('user.cart')->with('error', 'Produk sudah tidak tersedia.');
        }

        if ($request->quantity > $product->stock) {
            return redirect()->route('user.cart')->with('error', 'Jumlah melebihi stok tersedia.');
        }

        $cart[$id]['quantity'] = $request->quantity;
        $cart[$id]['subtotal'] = $cart[$id]['price'] * $request->quantity;
        $cart[$id]['stock'] = $product->stock;

        session()->put('cart', $cart);

        return redirect()->route('user.cart')->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('user.cart')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clearCart()
    {
        session()->forget('cart');

        return redirect()->route('user.cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $total = 0;

            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                if (!$product) {
                    throw new \Exception("Produk {$item['name']} tidak ditemukan.");
                }

                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                $total += $product->price * $item['quantity'];
            }

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'total_price' => $total,
                'status' => 'completed',
            ]);

            foreach ($cart as $id => $item) {
                $product = Product::find($id);

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('user.history')->with('success', 'Transaksi berhasil.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('user.cart')->with('error', $e->getMessage());
        }
    }

    public function history(Request $request)
{
    $query = Transaction::where('user_id', auth()->id())
        ->with('details.product')
        ->latest();

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $transactions = $query->get();

    return view('user.history', compact('transactions'));
}
}