<?php

namespace App\Http\Controllers;

use App\Models\TarotCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TarotCardController extends Controller
{
    // Hiển thị danh sách lá bài
    public function index()
    {
        $cards = TarotCard::all();
        return view('admin.tarot-cards.index', compact('cards'));
    }

    // Hiển thị form thêm lá bài
    public function create()
    {
        return view('admin.tarot-cards.create');
    }

    // Lưu lá bài mới
    public function store(Request $request)
    {
        $validated = $request->validate([
            'card_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'short_description' => 'required|string',
            'detailed_meaning' => 'required|string',
            'upright_meaning' => 'required|string',
            'reversed_meaning' => 'required|string',
        ]);

        // Upload ảnh
        $imagePath = $request->file('image')->store('tarot-cards', 'public');

        TarotCard::create([
            'card_name' => $validated['card_name'],
            'image_path' => $imagePath,
            'short_description' => $validated['short_description'],
            'detailed_meaning' => $validated['detailed_meaning'],
            'upright_meaning' => $validated['upright_meaning'],
            'reversed_meaning' => $validated['reversed_meaning'],
        ]);

        return redirect()->route('tarot-cards.index')->with('success', 'Thêm lá bài thành công!');
    }

    // Hiển thị form chỉnh sửa
    public function edit(TarotCard $tarotCard)
    {
        return view('admin.tarot-cards.edit', compact('tarotCard'));
    }

    // Cập nhật lá bài
    public function update(Request $request, TarotCard $tarotCard)
    {
        $validated = $request->validate([
            'card_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'short_description' => 'required|string',
            'detailed_meaning' => 'required|string',
            'upright_meaning' => 'required|string',
            'reversed_meaning' => 'required|string',
        ]);

        // Cập nhật ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            Storage::disk('public')->delete($tarotCard->image_path);

            $imagePath = $request->file('image')->store('tarot-cards', 'public');
            $validated['image_path'] = $imagePath;
        }

        $tarotCard->update($validated);

        return redirect()->route('tarot-cards.index')->with('success', 'Cập nhật lá bài thành công!');
    }

    // Xóa lá bài
    public function destroy(TarotCard $tarotCard)
    {
        Storage::disk('public')->delete($tarotCard->image_path);
        $tarotCard->delete();

        return back()->with('success', 'Xóa lá bài thành công!');
    }
}
