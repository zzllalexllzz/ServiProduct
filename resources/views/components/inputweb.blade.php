<div class="mb-4">
    <label class="block text-gray-200 text-sm font-bold mb-2" for="{{$name}}">{{$texto}}</label>
    <input {{ $attributes->merge(['class' => 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-800 leading-tight focus:outline-none focus:shadow-outline']) }} id="{{$name}}" name="{{$name}}" type="{{$type}}" value="{{$value}}" required>
</div>