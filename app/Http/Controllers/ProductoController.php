<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:300',
        ], [
            'imagenes.*.max' => 'Cada imagen no debe pesar más de 300 KB.',
            'imagenes.*.image' => 'El archivo subido debe ser una imagen válida.',
        ]);

        $imagenesBase64 = [];

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $file) {
                $mime = $file->getMimeType();
                $content = file_get_contents($file->getRealPath());

                $base64 = 'data:' . $mime . ';base64,' . base64_encode($content);

                $imagenesBase64[] = $base64;
            }
        }

        Producto::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'precio' => $request->precio,
            'descripcion' => $request->descripcion,
            'imagenes' => $imagenesBase64,
        ]);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado exitosamente.');
    }
}

