<?php

declare(strict_types=1);

return [
    [
        'locale' => 'es',
        'category' => 'developpement',
        'slug' => 'python-315-ya-esta',
        'title' => 'Python 3.15 ya está',
        'summary' => 'El 9 de octubre de 2026, Python 3.15.0 pasó a ser la versión estable. Es la rama de funciones que sigue a 3.14. El proyecto cuenta 5.643 cambios, de 1.012 personas.',
        'cover' => '/blog/python-315.svg',
        'translation_key' => 'python-315',
        'published_at' => '2026-10-12 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — Python 3.15.0', 'url' => 'https://blog.python.org/2026/10/python-3150-final-is-here/'],
            ['title' => 'Phoronix — la salida de Python 3.15', 'url' => 'https://www.phoronix.com/news/Python-3.15-Released'],
            ['title' => 'LWN — Python 3.15 released', 'url' => 'https://lwn.net/Articles/1099602/'],
        ],
        'body' => <<<'TXT'
El 9 de octubre de 2026, Python 3.15.0 pasó a ser la versión estable. Es la rama de funciones que sigue a 3.14. El anuncio del proyecto cuenta 5.643 cambios, de 1.012 personas.

## Qué cambia en el lenguaje

Tres añadidos aparecen en el anuncio y en las dos reseñas del día. frozendict es un diccionario que no se modifica después de crearlo. sentinel es un valor pensado para decir « nada en particular », en lugar de un apaño. La codificación por defecto pasa a UTF-8. Las importaciones pueden declararse perezosas, para que un script arranque antes de haber cargado todo.

El compilador al vuelo sigue en prueba. El proyecto da dos cifras: alrededor de un 7 a un 8 % más rápido, en media geométrica, en Linux x86-64 frente al intérprete habitual, y alrededor de un 11 a un 12 % en macOS ARM frente al intérprete de llamadas finales. Phoronix repite ambos rangos. LWN se queda con el mismo conjunto: los dos tipos nuevos, UTF-8, los archivos de arranque de los paquetes y ese compilador.

## Los instaladores

Los binarios oficiales de Windows de 64 bits usan ahora el intérprete de llamadas finales. El instalador oficial de macOS instala también, por defecto, una segunda copia capaz de funcionar sin el cerrojo global. Se puede desmarcar en la instalación. Los paquetes de terceros que no están listos para ese modo vuelven a activar el cerrojo.

No es motivo para cambiarlo todo el mismo día. 3.15 es la rama nueva. Una aplicación en producción se queda en una rama ya probada con sus bibliotecas, y 3.15 se prueba aparte.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'devops',
        'slug' => 'github-actions-5-de-octubre',
        'title' => 'GitHub Actions se frenó el 5 de octubre',
        'summary' => 'El 5 de octubre de 2026, GitHub Actions y las máquinas que presta fueron lentos durante cuatro horas. En el pico, el 47 % de los flujos en esas máquinas falló. Las máquinas alojadas por uno mismo no se vieron afectadas.',
        'cover' => '/blog/github-actions.svg',
        'translation_key' => 'github-actions-5-oct',
        'published_at' => '2026-10-12 19:00:00',
        'sources' => [
            ['title' => 'GitHub Status — incidente de Actions del 5 de octubre de 2026', 'url' => 'https://www.githubstatus.com/'],
            ['title' => 'Automater — las cifras del pico', 'url' => 'https://automater.ai/news/github-actions-hosted-runners-october-5-2026-outage/'],
        ],
        'body' => <<<'TXT'
El 5 de octubre de 2026, entre las 18:48 y las 22:49 UTC (15:48 a 19:49, hora de Brasilia), GitHub Actions y las máquinas que presta fueron lentos. GitHub lo dice en su página de estado. En el pico, durante cerca de hora y media, el 47 % de los flujos en esas máquinas falló, y el 71,9 % de las tareas no arrancó en cinco minutos. En toda la franja, el 14,3 % de los flujos y el 26,5 % de las tareas perdieron ese plazo de cinco minutos.

Los sitios ya publicados en GitHub Pages siguieron sirviéndose. Las máquinas alojadas por uno mismo no se vieron afectadas. Parte de las cuentas también vio errores en la lista de repositorios, en las páginas de licencia y de facturación, y en algunas funciones de Copilot.

## La causa que da GitHub

GitHub describe un corte parcial de red entre una región de sus centros y parte de sus bases y de sus almacenamientos alojados en la nube. El servicio volvió al mover ese tráfico hacia regiones sanas y al añadir capacidad. Actions había vuelto a las 21:54 UTC. El conjunto de los servicios citados, a las 22:49 UTC. El análisis detallado sigue anunciado.

Automater repitió las mismas cifras, en otro sitio, a partir de ese informe.

## Qué hacer con ello

Un flujo en rojo esa tarde puede venir de la plataforma. Compararlo con la página de estado evita buscar un fallo que no está en el proyecto. Una máquina propia siguió. No es motivo para mudarlo todo. Es motivo para no tomar un fallo aislado, en esa franja horaria, por una regresión del código.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'cybersecurite',
        'slug' => 'wordpress-713-para-instalar',
        'title' => 'WordPress 7.1.3 está para instalar',
        'summary' => 'El 6 de octubre de 2026, WordPress publicó la versión 7.1.3. El anuncio habla de siete correcciones de seguridad y de cuatro arreglos. El proyecto pide actualizar enseguida.',
        'cover' => '/blog/wordpress-713.svg',
        'translation_key' => 'wordpress-713',
        'published_at' => '2026-10-12 21:00:00',
        'sources' => [
            ['title' => 'WordPress News — versión 7.1.3', 'url' => 'https://wordpress.org/news/2026/10/wordpress-7-1-3-maintenance-and-security-release/'],
            ['title' => 'Patchstack — la misma publicación', 'url' => 'https://patchstack.com/articles/wordpress-7-1-3-security-release/'],
            ['title' => 'Search Engine Journal — siete correcciones', 'url' => 'https://www.searchenginejournal.com/wordpress-7-1-3-fixes-7-vulnerabilities-and-1-critical-flaw/592109/'],
        ],
        'body' => <<<'TXT'
El 6 de octubre de 2026, WordPress publicó la versión 7.1.3. El anuncio oficial habla de siete correcciones de seguridad y de cuatro correcciones de fallos. El proyecto pide actualizar enseguida, desde el panel, o esperar la actualización automática si el sitio la tiene activada.

## Qué cubren las correcciones

El texto de WordPress describe los efectos, sin instrucciones. Un comentario en espera puede dejar un script en la página de administración de los comentarios. La exportación del sitio puede abusarse hasta la base. Una persona sin sesión puede leer comentarios de un artículo privado o no publicado. Un autor puede fijar un artículo más allá de su papel. Un contenido de Imgur incrustado puede llevar un script. Otros dos puntos endurecen casos más internos.

Patchstack y Search Engine Journal retomaron la publicación el mismo día: misma fecha, siete correcciones, el mismo consejo de actualizar. Este texto no repite el detalle de cada disparador. La versión a alcanzar es 7.1.3, o la actualización de seguridad de la rama que todavía se sigue.

## Las ramas antiguas

WordPress indica que las correcciones también se preparan para las ramas todavía elegibles, hasta 4.7, y que salen a medida que están listas. Solo la última versión se sigue de forma activa. Un sitio dejado en una rama vieja espera un traslado que quizá todavía no está.

El paso útil es leer el número en el panel y pasar a 7.1.3 si el sitio está en 7.1. Los sitios con actualización automática la toman solos. Los demás esperan un clic.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'ia',
        'slug' => 'chatgpt-marca-en-europa',
        'title' => 'ChatGPT va a marcar sus textos en Europa',
        'summary' => 'El 5 de octubre de 2026, OpenAI anunció una marca invisible en los textos elegibles de ChatGPT y de Codex en la Unión Europea. El detector no es público. La ausencia de marca no prueba que una persona haya escrito el texto.',
        'cover' => '/blog/chatgpt-eu.svg',
        'translation_key' => 'chatgpt-marque-ue',
        'published_at' => '2026-10-12 18:00:00',
        'sources' => [
            ['title' => 'OpenAI — marcado de textos para la Unión Europea', 'url' => 'https://openai.com/index/eu-text-provenance'],
            ['title' => 'The Hindu — el mismo anuncio, el 6 de octubre', 'url' => 'https://www.thehindu.com/business/openai-to-watermark-chatgpt-text-in-eu-under-ai-act-rules/article71551205.ece'],
            ['title' => 'Agence Europe — marca invisible, detector reservado', 'url' => 'https://agenceurope.eu/en/bulletin/article/13953/29/openai-announces-watermark-for-texts-generated-by-its-tools-in-eu'],
        ],
        'body' => <<<'TXT'
El 5 de octubre de 2026, OpenAI explicó cómo piensa hacer reconocibles los textos producidos por sus herramientas, para el reglamento europeo de IA. En las próximas semanas, una marca invisible se añadirá a los textos elegibles de ChatGPT y de Codex, para los usuarios de la Unión Europea, en todos los planes. No queda activada para el resto del mundo en este lanzamiento.

El mismo día, los clientes de la API, en cualquier lugar, pueden pedir esa marca para algunos modelos. Sigue apagada hasta que alguien la active. El detector no es público: OpenAI abre solicitudes, primero para investigadores y organismos que acepte.

## Qué dice la marca

OpenAI lo llama textGrain. Es una señal estadística en la elección de las palabras, no caracteres ocultos. El detector busca esa señal. The Hindu y Agence Europe describen lo mismo, el 6 de octubre: una marca invisible, limitada a Europa para ChatGPT, un detector reservado y unos límites asumidos.

OpenAI da sus propias medidas, retomadas por The Hindu. En textos de psicología, con una tasa prevista de una falsa alarma de cada cien, el detector encuentra la marca en cerca del 80 % de los pasajes de 200 tokens, y cerca del 95 % de los de 400. En matemáticas, donde las palabras están más atadas, la detección baja. Sustituir el 10 % de las palabras por sinónimos hace caer una detección de cerca del 92 % al 66 %. Con el 25 % de las palabras sustituidas, cae a cerca del 17 %.

## Qué no dice

OpenAI lo escribe, y Agence Europe lo retiene: la marca no mide la parte humana. No dice de quién es el texto, quién lo pidió, ni si el texto es correcto. La ausencia de marca no prueba que una persona lo haya escrito. El pasaje puede ser demasiado corto, modificado, traducido o venir de otra herramienta.

Para un sitio, el punto útil está ahí. Un texto pegado desde ChatGPT en Europa puede llevar esta marca. La marca no sustituye una lectura, y no sirve de prueba.
TXT,
    ],
];
