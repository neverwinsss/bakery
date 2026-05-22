<form method="POST" enctype="multipart/form-data" action="{{ $product ? route('admin.products.update',$product) : route('admin.products.store') }}" class="bg-white rounded-xl p-6 space-y-4 max-w-2xl">@csrf @if($product) @method('PUT') @endif
<input name="name" value="{{ old('name',$product->name ?? '') }}" placeholder="Название" class="w-full border rounded px-3 py-2">
<textarea name="info" placeholder="Описание" class="w-full border rounded px-3 py-2">{{ old('info',$product->info ?? '') }}</textarea>
<select name="category_id" class="w-full border rounded px-3 py-2">@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id',$product->category_id ?? '')==$category->id)>{{ $category->name }}</option>@endforeach</select>
<input type="number" step="0.01" name="price" value="{{ old('price',$product->price ?? '') }}" placeholder="Цена" class="w-full border rounded px-3 py-2">
<input name="weight" value="{{ old('weight',$product->weight ?? '') }}" placeholder="Вес" class="w-full border rounded px-3 py-2">
<input type="hidden" name="is_available" value="0"><label class="flex gap-2"><input type="checkbox" name="is_available" value="1" @checked(old('is_available',$product->is_available ?? 1))> В наличии</label>
<input type="file" name="image" class="w-full border rounded px-3 py-2"><button class="bg-amber-600 text-white px-5 py-2 rounded">Сохранить</button></form>
