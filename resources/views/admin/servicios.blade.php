<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrador') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div >
                    <form action="/servicio/fecha" method="POST" class="flex items-center ">
                        @csrf
                        <!-- buscar por fecha -->
                        <x-input-label for="fecha" :value="__('Fecha: ')" />
                        <x-text-input id="fecha" class="block mt-1 w-60" type="date" name="fecha" :value="old('fecha')" required aria-required="true" autofocus autocomplete="fecha" />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                        <div class="ml-4">
                            <x-primary-button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                              </svg>
                              Buscar</x-primary-button>
                        </div>
                    </form>
                </div>
                <div>
                    <form action="/servicio/ciudad" method="POST" class="flex items-center ">
                        @csrf
                        <!-- buscar por ciudad -->
                        <x-input-label for="ciudad" :value="__('Ciudad: ')" />
                        <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" :value="old('ciudad')" required aria-required="true" autofocus autocomplete="ciudad" />
                        <x-input-error :messages="$errors->get('ciudad')" class="mt-2" />
                            <div class="ml-4">
                                <x-primary-button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                  </svg>
                                  Buscar</x-primary-button>
                            </div>
                    </form>
                </div>
                <div>
                    <form action="/servicio/categoria" method="POST" class="flex items-center ">
                        @csrf
                        <!-- buscar por categoria -->
                        <x-input-label for="categoria" :value="__('Categoria: ')" />
                        <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" id="categoria"  name="categoria" type="text" placeholder="" required aria-required="true">
                            <option value="">Elige una categoria...</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
                        <div class="ml-4">
                            <x-primary-button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                              </svg>
                              Buscar</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-5">
                <a href="/servicio/nuevo" class=""><x-primary-button>Añadir Servicio <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                  </svg>
                  </x-primary-button></a>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-2 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Descripcion
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Ciudad
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Fecha
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Facturacion
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Categoria
                                </th>
                                <th scope="col" class="px-2 py-3 " colspan="2">
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($servicios as $key => $servicio)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                <form method="POST" action='/servicio/{{ $servicio->id }}/update' enctype="multipart/form-data">
                                    @csrf
                                <th scope="row" class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" value="{{$servicio->nombre}}"/>
                                </th>
                                <td class="px-4 py-2">
                                    <textarea class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" id="descripcion" name="descripcion"  required autofocus autocomplete="descripcion" rows="1" cols="40">{{$servicio->descripcion}}</textarea>
                                </td>
                                <td class="px-4 py-2">
                                    <x-text-input id="ciudad" class="block mt-1 w-full" type="text" name="ciudad" value="{{$servicio->ciudad}}"/>
                                </td>
                                <td class="px-4 py-2">
                                    <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" value="{{$servicio->fecha}}"/>
                                </td>
                                <td class="px-4 py-2">
                                    <x-text-input id="facturacion" class="block mt-1 w-full" type="text" name="facturacion" value="{{ $servicio->facturacion }}"/>
                                </td>
                                <td class="px-4 py-4">
                                    <select class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" id="categoria_id"  name="categoria_id" type="text" placeholder="" required>
                                        @foreach($categorias as $key => $categoria)
                                            @if ($servicio->cateservicio_id == $categoria->id)
                                            <option value="{{$servicio->cateservicio_id}}" selected>{{ $categoria->nombre }}</option>
                                            @else
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <x-primary-button class="ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    </x-primary-button>
                                </td>
                                </form>
                                <td class="px-4 py-2 text-right">
                                    @if (Auth::user()->rol=='admin' || Auth::user()->id==$servicio->user_id)
                                    <a href="/servicio/{{ $servicio->id }}/borrar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                        </a>
                                        <a href="/servicio/{{ $servicio->id }}/detalle" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    @else
                                    <a href="/servicio/{{ $servicio->id }}/detalle" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>