<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Menu;
use Ramsey\Uuid\Uuid;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RestaurantController extends Controller
{
    public function menu(){
        $menu = Menu::orderBy('nama_menu', 'ASC')->paginate(6);
        return view('dashboard.resepsionis.restaurant.menu', compact('menu'));
    }

    public function menuDetail($id){
        $menu = Menu::where('id', $id)->firstOrFail();
        return view('dashboard.resepsionis.restaurant.menu_detail', compact('menu'));
    }


    public function transaksi(){
        $menu = Menu::orderBy('nama_menu', 'ASC')->get();
        $transaksi = Transaksi::groupBy('no_transaksi', 'nama_customer', 'no_kamar', 'created_at', 'status')->select('no_transaksi', 'nama_customer', 'no_kamar' , 'status', 'created_at as waktu',DB::raw('SUM(total_harga) as total_harga'))->orderBy('waktu', 'DESC')->get();
        return view('dashboard.resepsionis.restaurant.transaction', compact('menu', 'transaksi'));
    }

    public function transaksiStore(Request $request){
        //validation for transaction
        $menu = Menu::pluck('id');
        $request->validate([
            'id_menu.*' => ['required', Rule::in($menu)],
            'qty.*' => 'required|numeric',
            'no_kamar' => 'required',
            'nama_customer' => 'required'
        ]);
        $id_menu = $request->id_menu;
        $qty = $request->qty;

        //combine array for id_menu and qty
        $combined = array_map(function($item1, $item2){
            return [
                'id_menu' => $item1,
                'qty' => $item2
            ];
        }, $id_menu, $qty);

        //define transaction number and created_at
        $no_transaksi = 'TRNS-' . Str::random(10);
        $created_at = now();

        //make sure quantity enough
        foreach ($combined as $item) {
            $menuData = Menu::where('id', $item['id_menu'])->first();
            if ($menuData->stok < intval($item['qty'])) {
                return back()->with('error', 'Stok menu ' . $menuData->nama_menu . ' kurang dari kuantitas yang diminta');
            }
        }

        //insert transaction
        foreach ($combined as $item) {
            $menu = Menu::where('id', $item['id_menu'])->first();
            $model = new Transaksi();
            $model->id = Str::uuid()->toString();
            $model->no_transaksi = $no_transaksi;
            $model->id_menu = $item['id_menu'];
            $model->qty = $item['qty'];
            $model->no_kamar = $request->no_kamar;
            $model->nama_customer = $request->nama_customer;
            $model->created_at = $created_at;
            $model->total_harga = $menu->harga_menu * intval($item['qty']);
            $model->save();

            $menu->update([
                'stok' => $menu->stok - intval($item['qty'])
            ]);
        }

        return back()->with('success', 'Transaksi Berhasil');
    }

    public function transaksiUpdate($no_transaksi){
        $data = Transaksi::where('no_transaksi', $no_transaksi)->get();

        //make sure transaction number match
        if ($data->isEmpty()) {
            abort(404);
        }

        //make sure all of status same
        if ($data->every(function ($item) {
            return $item->status === 'Disajikan';
        })) {
            Transaksi::where('no_transaksi', $no_transaksi)->update(['status' => 'Selesai']);
            return back()->with('success', 'Berhasil mengubah status menjadi Selesai');
        } else {
            return back()->with('error', 'Data tidak valid');
        }
    }

    public function transaksiDetail($no_transaksi){
        $data = Transaksi::with('menu')->where('no_transaksi', $no_transaksi)->get();
        if ($data->isEmpty()) {
            abort(404);
        }
        $total_harga = $data->sum('total_harga');
        $customer = $data->first()->nama_customer;
        $no_kamar = $data->first()->no_kamar;
        $status = $data->first()->status;
        $waktu = $data->first()->created_at;
        return view('dashboard.resepsionis.restaurant.detail_transaksi', compact('data', 'total_harga', 'customer', 'no_kamar', 'status', 'waktu', 'no_transaksi'));
    }

    public function updateMenu(Request $request, $id){
        $menu = Menu::where('id', $id)->firstOrFail();
        $request->validate([
            'stok' => 'required|numeric|min:1',
            'deskripsi' => 'required'
        ]);

        $menu->update([
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('menu')->with('success', 'Berhasil update menu ' . $menu->nama_menu);
    }
}
