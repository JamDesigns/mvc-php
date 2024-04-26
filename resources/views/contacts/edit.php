<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar contacto - MVC-PHP</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-4 px-8">
        <div class="mt-4 grid grid-cols-5 gap-4">
            <div class="col-span-3 col-start-2">
                <form class="max-w-sm mx-auto overflow-hidden bg-white border border-gray-200 rounded-lg shadow" action="/contacts/<?= $contact['id']?>" method="post">
                    <div class="py-4 bg-blue-200">
                        <h1 class="text-3xl font-bold text-center">Editar contacto</h1>
                    </div>
                    <div class="m-6 mb-5">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $contact['name']?>" name="name" id="name" required autofocus>
                    </div>

                    <div class="m-6 mb-5">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                        <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $contact['email']?>" name="email" id="email" placeholder="nombre@ejemplo.com" required>
                    </div>

                    <div class="m-6 mb-5">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Teléfono</label>
                        <input  type="tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?= $contact['phone']?>" name="phone" id="phone">
                    </div>

                    <div class="m-6 grid grid-cols-3 gap-4">
                        <a href="/contacts/<?= $contact['id'] ?>" class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Volver</a>
                        <button type="submit" class="col-start-3 px-3 py-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
