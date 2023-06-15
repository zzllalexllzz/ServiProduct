<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Administrador') }}
        </h2>
    </x-slot>
    <h2 class="text-gray-700 uppercase  dark:text-gray-400 text-center mt-8">Participantes del servicio: <span class="uppercase">{{ $servicios->nombre }}</span></h2>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex space-x-4">
                <div style="margin-top:15px; margin-right:8px; ">
                    <a href="/servicio/{{$servicios->id}}/user/{{Auth::user()->id}}/interesado"><x-primary-button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                      </svg>
                       Estoy Interesado/a</x-primary-button>
                    </a>
                </div>
                <div>
                    <form method='POST' action='/servicio/user/store'>
                        @csrf
                        <!-- user_id -->
                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                        <!-- servicio -->
                        <input type="hidden" name="servicio_id" value={{$servicios->id}}>
                        <div class="mt-4">
                            <x-primary-button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                              </svg>
                               Me Gusta +{{$usuarios->count()}}</x-primary-button>
                        </div>
                    </form>
                </div>
                <div style="margin-top:15px; margin-left:8px; ">
                    <a href="/servicio/{{$servicios->id}}/user/{{Auth::user()->id}}/borrar"><x-primary-button><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                      </svg>
                      No Me Gusta</x-primary-button>
                    </a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6 flex justify-center items-center">
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto flex flex-wrap">
                          <div class="flex flex-wrap -m-4">
                            <div class="p-4 lg:w-1/2 md:w-full">
                              <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                <div class="flex-grow">
                                  <h2 class="text-gray-900 text-lg title-font font-medium mb-3">Usuarios (Me gusta)</h2>
                                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Nombre
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Apellido
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Ciudad
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Email
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($usuarios as $key => $usua)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600">
                                            <td class="px-6 py-4">
                                                {{ $usua->nombre }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $usua->apellido }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $usua->ciudad }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $usua->email }}
                                            </td>
                                            {{-- <td class="px-6 py-4 text-right">
                                                @if (Auth::user()->rol == 'admin' || Auth::user()->id == $servicios->user_id || Auth::user()->id == $usua->id)
                                                <a href="/servicio/{{ $servicios->id }}/user/{{ $usua->id }}/borrar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </a>
                                                @endif
                                            </td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                              </div>
                            </div>
                            <div class="p-4 lg:w-1/2 md:w-full">
                              <div class="flex border-2 rounded-lg border-gray-200 border-opacity-50 p-8 sm:flex-row flex-col">
                                <div class="flex-grow">
                                    <h1 class="text-gray-900 text-lg title-font font-medium mb-3">Añadir Reseña</h1>
                                    <form action="/servicio/coment" method="POST" >
                                        @csrf
                                        <!-- user_id -->
                                        <input type="hidden" name="user_id" value={{Auth::user()->id}}>
                                        <!-- evento -->
                                        <input type="hidden" name="servicio_id" value={{$servicios->id}}>
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
                                        @if ($servicios->id==$comentario->servicio_id)
                                            <div class=" p-4 border-b-1 border-indigo-500">
                                                @foreach ($users as $user)
                                                    @if ($user->id==$comentario->user_id)
                                                    <h3 class="text-lg font-semibold">{{$user->nombre}} {{$user->apellido}}</h3>
                                                    @endif
                                                @endforeach
                                                <p class="text-gray-600 mb-2">Fecha: {{$comentario->fecha}}</p>
                                                <p class="mt-2">{{$comentario->descripcion}}</p>
                                                <div class="flex justify-end">
                                                    @if (Auth::user()->rol=='admin' || Auth::user()->id==$servicios->user_id || Auth::user()->id==$comentario->user_id)
                                                    <a href="/comentario/{{ $comentario->id }}/borrar" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
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