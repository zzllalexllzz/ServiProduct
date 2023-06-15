<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrador') }}
        </h2>
    </x-slot>
    <h2 class="text-gray-700 uppercase  dark:text-gray-400 text-center mt-8">Producto: <span class="uppercase">{{ $productos->nombre }}</span></h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6 flex justify-center items-center">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto flex flex-wrap">
                          <div class="flex flex-wrap -m-4">
                            <div class="p-4 lg:w-1/2 md:w-full">
                              <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                <div class="flex-grow">
                                  <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Detalle del Producto</h2>

                                    <p><strong>Nombre:</strong><br> {{ $productos->nombre }}</p>
                                    <p><strong>Descripcion:</strong><br>{{ $productos->descripcion }}</p>
                                    <p><strong>Fecha:</strong><br>{{ $productos->fecha }}</p>
                                    <p><strong>Precio:</strong><br>{{ $productos->precio }} €</p>
                                    @foreach($categorias as $key => $categoria)
                                    @if ($productos->cateproducto_id == $categoria->id)
                                    <p><strong>Categoria:</strong><br>{{ $categoria->nombre }}</p>
                                    <img src="{{asset($productos->imagen)}}" alt="" width="400" height="400">
                                    @endif
                                    @endforeach
                                </div>
                              </div>
                            </div>
                            <div class="p-4 lg:w-1/2 md:w-full">
                              <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                <div class="flex-grow">
                                    <h1 class="text-gray-900 text-lg title-font font-medium mb-3">Añadir Reseña</h1>
                                    <form action="/producto/resena" method="POST" >
                                        @csrf
                                        <!-- user_id -->
                                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                                        <!-- evento -->
                                        <input type="hidden" name="producto_id" value={{$productos->id}}>
                                        <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s');?>">
                                        <div class="">
                                            <textarea name="descripcion" id="review" rows="2" cols="60" class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:border-blue-500" placeholder="Escribe tu reseña aquí" required aria-required="true"></textarea>
                                        </div>
                                        <div class="text-center">
                                            <x-primary-button type="submit">Añadir Reseña</x-primary-button>
                                        </div>
                                    </form>

                                    <div class="mt-3">
                                        @foreach ($comentarios as $comentario)
                                        @if ($productos->id==$comentario->producto_id)
                                            <div class=" p-4 border-b-1 border-indigo-500">
                                                @foreach ($users as $user)
                                                    @if ($user->id==$comentario->user_id)
                                                    <h3 class="text-lg font-semibold">{{$user->nombre}} {{$user->apellido}}</h3>
                                                    @endif
                                                @endforeach
                                                <p class="text-gray-600 mb-2">Fecha: {{$comentario->fecha}}</p>
                                                <p class="mt-2">{{$comentario->descripcion}}</p>
                                                <div class="flex justify-end">
                                                    @if (Auth::user()->rol=='admin' || Auth::user()->id==$productos->user_id || Auth::user()->id==$comentario->user_id)
                                                    <a href="/resena/{{ $comentario->id }}/borrar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                      </svg></a>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr class="w-full border-t-2 border-gray-300 my-6">
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>