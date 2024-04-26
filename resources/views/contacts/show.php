<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar contacto - MVC-PHP</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-4 px-8">
        <div class="mt-4 grid grid-cols-5 gap-4">
            <div class="col-span-3 col-start-2">
                <div class="max-w-sd mx-auto overflow-hidden bg-white border border-gray-200 rounded-lg shadow">
                    <div class="py-4 bg-blue-200">
                        <h1 class="text-3xl font-bold text-center">Contacto</h1>
                    </div>
                    <div class="m-6">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Nombre</h5>
                        <p class="font-normal text-gray-700">
                            <?= $contact['name']?>
                        </p>
                    </div>

                    <div class="m-6">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Email</h5>
                        <p class="font-normal text-gray-700">
                            <?= $contact['email']?>
                        </p>
                    </div>

                    <div class="m-6">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Teléfono</h5>
                        <p class="font-normal text-gray-700">
                            <?= $contact['phone']?>
                        </p>
                    </div>

                    <div class="m-6">
                        <form class="mt-6" action="/contacts/<?= $contact['id'] ?>/delete" method="post">
                            <div class="grid grid-cols-3 gap-4">
                                <a href="/contacts" class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Volver</a>
                                <button type="submit" class="px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Borrar</button>
                                <a href="/contacts/<?= $contact['id'] ?>/edit" class="px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Editar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
