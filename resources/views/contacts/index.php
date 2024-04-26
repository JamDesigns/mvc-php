<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contactos - MVC-PHP</title>
        <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    </head>

    <body class="bg-gray-100">
        <div class="container mx-auto py-4 px-8">
            <div class="max-w-sd mx-auto overflow-hidden bg-white border border-gray-200 rounded-lg shadow">
                <div class="py-4 bg-blue-200">
                    <h1 class="text-3xl font-bold text-center">Listado de contactos</h1>
                </div>
                <div class="m-6">

                    <form action="" class="mx-auto">
                        <label for="search"
                            class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="search" name="search"
                                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 shadow"
                                placeholder="Buscar contacto/s..." autofocus/>
                            <button type="submit"
                                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Buscar</button>
                        </div>
                    </form>

                    <div class="my-6">
                        <a href="/contacts/create"
                            class="text-white font-semibold bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Crear
                            contacto</a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-300">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nombre</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Teléfono</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts['data'] as $contact): ?>
                                <tr class="odd:bg-white even:bg-gray-100 border-b">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"><a
                                            href="/contacts/<?= $contact['id'] ?>"><?= $contact['name'] ?></a></td>
                                    <td class="px-6 py-4"><a
                                            href="/contacts/<?= $contact['id'] ?>"><?= $contact['email'] ?></a></td>
                                    <td class="px-6 py-4"><a
                                            href="/contacts/<?= $contact['id'] ?>"><?= $contact['phone'] ?></a></td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                            </tr>
                        </table>
                    </div>

                    <?php
                        $paginate = 'contacts';
                        require_once('../resources/views/assets/pagination.php')
                    ?>
                </div>
            </div>
        </div>
    </body>

</html>
