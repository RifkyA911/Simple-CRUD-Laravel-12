<?php

namespace App\Http\Controllers;

use App\Models\KategoriItem;
use Illuminate\Http\Request;

class KategoriItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori_items.index.index');
    }

    public function search(Request $request) {
        $nama= $request->nama;
        $kode= $request->kode;

        $data_search = KategoriItem::query();

        if(!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        if(!empty($kode)) $data_search = $data_search->where('kode', $kode);

        $data_search = $data_search->select('id', 'kode', 'nama')->orderBy('id')->get();
        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function getKategori(Request $request) {
        $nama= $request->nama;
        $kode= $request->kode;

        $data_search = KategoriItem::query();

        if(!empty($nama)) $data_search = $data_search->where('nama', 'LIKE', '%' . $nama . '%');
        if(!empty($kode)) $data_search = $data_search->where('kode', $kode);

        $data_search = $data_search->select('id', 'kode', 'nama', 'harga_beli')->orderBy('id')->get();
        return response()->json([
            'status' => 200,
            'data' => $data_search
        ]);
    }

    public function formView($method, $id = 0)
    {
        if ($method == 'new') {
            $item = [];
        } else {
            $item = KategoriItem::find($id);
        }
        $data['item'] = $item;
        $data['method'] = $method;
        return view('kategori_items.form.index', $data);
    }

    public function singleView($id)
    {
        $data['data'] = KategoriItem::with('masterItems')->find($id);
        // return dd($data['data']->toArray());
        return view('kategori_items.single.index', $data);
    }

    public function getMasterItemsByKategori($id)
    {
        $kategori = KategoriItem::with('masterItems')->findOrFail($id);
        return dd($kategori->toArray());
        return response()->json($kategori);
    }


     public function formSubmit(Request $request, $method, $id = 0)
    {
        if ($method == 'new') {
            $data_item = new KategoriItem;
            $kode = KategoriItem::count('id');
            $kode = $kode + 1;
            $kode = str_pad($kode, 5, '0', STR_PAD_LEFT);
            sleep(3);
        } else {
            $data_item = KategoriItem::find($id);
            $kode = $data_item->kode;
        }


        $data_item->nama = $request->nama;
        $data_item->kode = $kode;

        $data_item->save();

        return redirect('kategori_items');
    }
}
