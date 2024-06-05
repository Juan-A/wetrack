<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kumbh+Sans:wght@100..900&display=swap" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    <style>
    </style>
</head>

<body class="font-sans antialiased dark:text-slate-700 h-dvh">
    <div
        class="bg-gradient-to-b from-slate-50 via-amber-300 to-red-400 dark:from-slate-700 dark:via-amber-700 dark:to-red-700 min-h-full flex flex-col">
        <header>
            <!--Header Nav-->
            @include('layouts.navigation')
        </header>

        <div class="flex items-center flex-col">
            <h1 class="text-6xl md:text-8xl font-bold text-center dark:text-gray-200 mt-10 font-hero">
                Acerca de WeTrack
            </h1>
            <p class="text-2xl font-thin dark:text-white font-hero mt-5 w-3/4 text-center">
                WeTrack es tu plataforma para compartir, opinar y descubrir música.
            </p>
        </div>

        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Protección de Datos</h2>
                <p class="text-lg mb-3">
                    En WeTrack, valoramos tu privacidad. Almacenamos únicamente el nombre de usuario y el correo
                    electrónico (que puedes registrar manualmente o importar desde tu cuenta de Spotify).
                </p>
                <p class="text-lg">
                    Estos datos se utilizan exclusivamente para mejorar tu experiencia en la plataforma y no se
                    comparten con terceros sin tu consentimiento explícito.
                </p>
            </div>
        </div>

        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Uso de Datos de Spotify</h2>
                <p class="text-lg mb-3">
                    Toda la información utilizada en WeTrack, como las imágenes, nombres de canciones y álbumes, así
                    como el logotipo de <span class="font-bold">Spotify</span> <svg xmlns="http://www.w3.org/2000/svg"
                        class="size-8" viewBox="0 0 24 24"
                        style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:; display: inline-block;">
                        <path
                            d="M12.01 2.019c-5.495 0-9.991 4.496-9.991 9.991 0 5.494 4.496 9.99 9.991 9.99 5.494 0 9.99-4.496 9.99-9.99 0-5.495-4.446-9.991-9.99-9.991zm4.595 14.436c-.199.299-.549.4-.85.201-2.349-1.45-5.296-1.75-8.793-.951-.348.102-.648-.148-.748-.449-.101-.35.149-.648.45-.749 3.795-.85 7.093-.499 9.69 1.1.35.149.4.548.251.848zm1.2-2.747c-.251.349-.7.499-1.051.249-2.697-1.646-6.792-2.148-9.939-1.148-.398.101-.85-.1-.949-.498-.101-.402.1-.852.499-.952 3.646-1.098 8.143-.548 11.239 1.351.3.149.45.648.201.998zm.099-2.799c-3.197-1.897-8.542-2.097-11.59-1.146a.938.938 0 0 1-1.148-.6.937.937 0 0 1 .599-1.151c3.547-1.049 9.392-.85 13.089 1.351.449.249.599.849.349 1.298-.25.35-.849.498-1.299.248z">
                        </path>
                    </svg>, es propiedad de <a href="https://www.spotify.com"
                        class="text-blue-500 underline">Spotify</a>.
                </p>
                <p class="text-lg">
                    Nuestra integración con Spotify nos permite ofrecerte una experiencia enriquecida, conectándote con
                    la música que te gusta y permitiéndote descubrir nuevos contenidos.
                </p>
            </div>
        </div>

        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Nuestro Compromiso</h2>
                <p class="text-lg mb-3">
                    Estamos comprometidos con proporcionarte la mejor experiencia posible, permitiéndote compartir tus
                    opiniones sobre tus canciones y álbumes favoritos, puntuar música, opinar sobre canciones y
                    descubrir nuevas tendencias.
                </p>
                <p class="text-lg">
                    Agradecemos tu apoyo y esperamos que disfrutes usando WeTrack tanto como nosotros disfrutamos
                    desarrollándola.
                </p>
            </div>
        </div>

        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Normas de Uso</h2>
                <p class="text-lg mb-3">
                    Para mantener una comunidad respetuosa y agradable para todos, nos reservamos el derecho de eliminar
                    cualquier comentario que consideremos inapropiado, ofensivo o que incumpla nuestras normas de uso.
                </p>
                <p class="text-lg">
                    Nos comprometemos a fomentar un entorno donde todos los usuarios puedan compartir sus opiniones y
                    descubrimientos musicales de manera constructiva y respetuosa.
                </p>
            </div>
        </div>
        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Acerca del Desarrollador</h2>
                <p class="text-lg mb-3">
                    Esta aplicación ha sido desarrollada por <a href="https://juanhc.dev/"
                        class="text-blue-500 underline">Juan-A</a>, cualquier uso de los datos contenidos en esta
                    aplicación, implican su atribución al autor del sitio.
                </p>
            </div>
        </div>

        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <h2 class="text-3xl font-bold mb-5">Información de Cookies</h2>
                <p class="text-lg mb-3">
                    En WeTrack, utilizamos únicamente las cookies necesarias para conservar la sesión del usuario. No
                    almacenamos ningún otro tipo de información en las cookies.
                </p>
                <p class="text-lg">
                    Estas cookies son esenciales para garantizar la seguridad y el funcionamiento adecuado de nuestra
                    plataforma.
                </p>
            </div>
        </div>
        
        <div class="flex justify-center flex-wrap items-start mt-20 px-5">
            <div class="bg-opacity-25 bg-slate-200 rounded-xl p-10 w-full lg:w-3/4 text-center">
                <p class="text-lg">
                    WeTrack™ es una aplicación independiente y no está afiliada, patrocinada o respaldada por Spotify.
                    Todos los derechos sobre el contenido utilizado pertenecen a Spotify.
                </p>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>

</html>
