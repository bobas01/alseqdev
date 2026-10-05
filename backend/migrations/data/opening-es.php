<?php

declare(strict_types=1);

return [
    [
        'locale' => 'es',
        'category' => 'developpement',
        'slug' => 'python-310-fin-de-las-correcciones',
        'title' => 'Python 3.10 ya no recibe correcciones',
        'summary' => 'El 1 de octubre de 2026, Python 3.10.22 pasó a ser la última versión de esa rama. No habrá más corrección de seguridad. Otras cuatro ramas se actualizaron el mismo día.',
        'cover' => '/blog/python-310.svg',
        'translation_key' => 'python-310',
        'published_at' => '2026-10-04 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — las versiones del 1 de octubre de 2026', 'url' => 'https://blog.python.org/2026/10/python-31022-31117/'],
            ['title' => 'Linux Compatible — fin de Python 3.10', 'url' => 'https://www.linuxcompatible.org/story/python-31022-31117-31215-31316-and-3148-ship-as-310-hits-end-of-life/'],
            ['title' => 'endoflife.ai — fecha de fin de Python 3.10', 'url' => 'https://endoflife.ai/python/3.10'],
        ],
        'body' => <<<'TXT'
El 1 de octubre de 2026, la rama Python 3.10 se detuvo. La versión 3.10.22 es la última. Todavía corrige fallos, y después no sigue nada: esa rama no recibirá otra actualización de seguridad. El programa sigue en marcha. Nadie lo repara después.

Han pasado cinco años desde la primera 3.10, en octubre de 2021. La fecha estaba prevista. No es un corte por sorpresa. A partir de aquí, quedarse en 3.10 es una elección: un fallo descubierto más tarde sigue abierto en esa rama.

## El mismo día, las otras ramas

El mismo anuncio publicó otros cuatro números: 3.11.17, 3.12.15, 3.13.16 y 3.14.8. Son actualizaciones de mantenimiento. No cambian el lenguaje. Traen correcciones.

3.14 es la rama de funciones más reciente. 3.10 ya no se mueve. Linux Compatible retomó el anuncio el mismo día: una publicación, cinco números y el fin oficial de 3.10. Python Insider es el texto de origen, en el blog del proyecto. endoflife.ai, que sigue las fechas de fin de soporte, marca el 1 de octubre de 2026 y cita 3.10.22 como última publicación.

## Sin instalador para este último número

3.10.22 se entrega solo como código fuente. No hay instalador de Windows ni de macOS para este último número. Quien busque un archivo listo de 3.10.22 no lo encuentra: no se construyó.

Eso no cambia el fondo. Incluso con un instalador, esta versión no recibiría más correcciones.

## Qué significa «sin corrección»

Un fallo hallado después del 1 de octubre de 2026 puede repararse en una rama que todavía se sigue. No se reparará en 3.10. En un ordenador personal, el riesgo a veces es bajo. En un servicio en línea, en una imagen que todavía arranca 3.10, o en un servidor olvidado, el fallo siguiente queda abierto en esa rama.

Las bibliotecas también acaban por exigir una versión más reciente. El momento menos caro para cambiar es antes de que algo se rompa, no el día en que una herramienta se niega a instalarse.

## Con qué sustituirla

No hay un número mágico. Hay una rama que todavía recibe correcciones, probada con el proyecto. Las bibliotecas, el alojamiento y las herramientas de alrededor tienen que seguir. Un entorno aparte por proyecto evita romper el resto de la máquina al cambiar la versión general.

El gesto útil es ver dónde sigue en marcha 3.10 y elegir la rama que la sustituye. Esperar el próximo aviso de seguridad sobre 3.10 no sirve. No habrá otro.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'devops',
        'slug' => 'kubernetes-137-opciones-antiguas',
        'title' => 'Kubernetes 1.37 rechaza las opciones antiguas',
        'summary' => 'Kubernetes 1.37, llamado Garhwal, salió el 26 de agosto de 2026. Dieciocho opciones antiguas impiden que un nodo arranque. Hay que quitarlas antes de la actualización.',
        'cover' => '/blog/kube-137.svg',
        'translation_key' => 'kube-137',
        'published_at' => '2026-10-04 19:00:00',
        'sources' => [
            ['title' => 'Kubernetes — anuncio de la versión 1.37 Garhwal', 'url' => 'https://kubernetes.io/blog/2026/08/26/kubernetes-v1-37-release/'],
            ['title' => 'Saaro — opciones retiradas y escala hasta cero', 'url' => 'https://blog.saaro.net/en/kubernetes-1-37-garhwal-hpa-scale-to-zero-gang-scheduling-un'],
            ['title' => 'Indra Gusti Prasetya — las dieciocho opciones y el arranque', 'url' => 'https://indragustiprasetya.com/blog/kubernetes-1-37-drops-18-kubelet-flags-nodes-never-join.html'],
        ],
        'body' => <<<'TXT'
Kubernetes 1.37 lleva el nombre Garhwal. La versión salió el 26 de agosto de 2026. El blog del proyecto anuncia 67 cambios: una parte pasa a ser estable y otra entra en prueba. Lo que ocupan las lecturas de esta semana, a principios de octubre, es más concreto. Un nodo puede negarse a arrancar si todavía hay opciones antiguas escritas en su configuración.

## Dieciocho opciones que el nodo rechaza

El programa que ejecuta los contenedores en cada máquina cambió la pieza que le daba mediciones antiguas. Con ese cambio, dieciocho opciones dejan de aceptarse. Si una sigue en la configuración, el nodo se detiene al arrancar. El mensaje habla de una opción desconocida.

Dos nombres vuelven en los dos relatos independientes: --containerd y --containerd-namespace. Ya no mandan nada. Bloquean el arranque. Otras opciones de la misma lista, ligadas a registros antiguos y a almacenamientos antiguos de mediciones, hacen el mismo efecto. Una sola opción de esa familia permanece: --housekeeping-interval.

Saaro, el 1 de octubre, e Indra Gusti Prasetya, el 25 de septiembre, describen el mismo punto en dos sitios distintos. Hay que quitar esas opciones antes de la actualización. A veces se esconden en un archivo de argumentos preparado solo, o en la definición del servicio de la máquina. Después del paso a 1.37, la máquina no vuelve al conjunto mientras esa línea siga ahí. El blog oficial de Kubernetes fija la versión y la fecha. Los dos artículos de octubre dicen qué revisar antes de instalarla.

## Bajar un servicio hasta cero

El texto de Saaro guarda otro cambio. El ajuste automático del número de copias puede reducir un servicio hasta cero. Cuando no hay llamadas, las copias pueden desaparecer y luego volver. No es el comportamiento antiguo, en el que quedaba al menos una.

Es una elección de coste y de espera. Un servicio que parte de cero tarda un poco más en responder a la primera llamada. Un servicio que debe responder siempre al momento no gana nada bajando tanto. Se decide servicio por servicio.

## Antes de la actualización

El trabajo es una relectura. Encontrar las opciones retiradas. Quitarlas. Probarlo en una máquina que no lleva el tráfico, y comprobar que arranca, antes de tocar las demás. La lista completa de los dieciocho nombres está en los dos artículos citados y en el registro de cambios del proyecto. Esa lista vale más que el recuerdo.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'cybersecurite',
        'slug' => 'netscaler-correccion-4-de-octubre',
        'title' => 'NetScaler: instalar la corrección del 4 de octubre',
        'summary' => 'El 4 de octubre de 2026, Citrix publicó una corrección de urgencia para NetScaler. El editor habla de una caída ya vista en instalaciones sin la corrección. Cuenta el número de versión del boletín.',
        'cover' => '/blog/netscaler.svg',
        'translation_key' => 'netscaler-4-oct',
        'published_at' => '2026-10-04 21:00:00',
        'sources' => [
            ['title' => 'BleepingComputer — corrección NetScaler del 4 de octubre', 'url' => 'https://www.bleepingcomputer.com/news/security/citrix-patches-netscaler-saml-zero-day-exploited-in-attacks/'],
            ['title' => 'Citrix — boletín del 4 de octubre de 2026', 'url' => 'https://support.citrix.com/external/article/CTX697174/citrix-netscaler-adc-and-citrix-netscale.html'],
            ['title' => 'SecurityOnline — la misma corrección, el mismo día', 'url' => 'https://securityonline.info/citrix-netscaler-cve-2026-88779-exploited/'],
        ],
        'body' => <<<'TXT'
El domingo 4 de octubre de 2026, Citrix publicó una corrección de urgencia para NetScaler ADC y NetScaler Gateway. El boletín lleva el número CVE-2026-88779. Citrix lo describe como una caída: el aparato puede dejar de responder. La nota que indica el editor es 8,7. Citrix escribe que ataques dirigidos ya alcanzaron instalaciones que no tenían la corrección.

BleepingComputer y SecurityOnline informaron de la publicación el mismo día, cada uno en su sitio. El catálogo estadounidense de fallos ya utilizados, llevado por CISA, añadió ese número el mismo domingo. Para los organismos federales afectados, la fecha límite indicada es el 7 de octubre. El boletín que hay que seguir sigue siendo el de Citrix: es el que da los números de versión.

## Lo que los artículos no zanjan

Varios textos dicen que unos investigadores miran si el efecto se queda en la caída o si va más lejos. No es lo que establece el boletín. El boletín habla de un servicio que se cae. Mientras el editor no diga otra cosa, el hecho que hay que guardar es ese.

Este texto no describe cómo se provoca el problema. La única acción útil es instalar la versión corregida y comprobar el número que aparece.

## Las versiones que corrigen

Citrix pide alcanzar, según la rama ya en uso:

- 14.1-73.41, o una versión más reciente de la rama 14.1
- 13.1-64.28, o una versión más reciente de la rama 13.1

Las ediciones FIPS y NDcPP tienen sus propios números en el boletín oficial. Una versión «bastante reciente» no basta. Hacen falta esos números, o más recientes.

## Una segunda actualización

A finales de septiembre ya se habían publicado otras correcciones de urgencia para los mismos aparatos. Citrix advierte de que las instalaciones actualizadas entonces necesitan otra actualización cuando entran en el boletín del 4 de octubre. La corrección de septiembre no cubre la del domingo.

Para un acceso remoto de empresa, el gesto es aplicar el boletín del fabricante y controlar que el número de versión sea el que corrige. El plazo del catálogo estadounidense recuerda la prisa. No sustituye la página de Citrix.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'ia',
        'slug' => 'modelos-que-eligen',
        'title' => 'Modelos que eligen en lugar de escribir',
        'summary' => 'El 1 de octubre de 2026, Cloudflare y AWS publicaron modelos que no redactan. Devuelven una elección entre respuestas ya permitidas, con una probabilidad.',
        'cover' => '/blog/decision.svg',
        'translation_key' => 'decision-models',
        'published_at' => '2026-10-04 18:00:00',
        'sources' => [
            ['title' => 'Cloudflare Blog — anuncio de Clef', 'url' => 'https://blog.cloudflare.com/clef-decision-models/'],
            ['title' => 'TechCrunch — modelos que ordenan opciones', 'url' => 'https://techcrunch.com/2026/10/01/amazon-releases-its-own-jev-clone-as-decision-models-flood-the-web/'],
            ['title' => 'beri.net — Clef y Strands Decider, el mismo día', 'url' => 'https://www.beri.net/article/cloudflare-clef-amazon-strands-decider-open-weight-decision-models-vs-jev-benchmarks-pricing'],
        ],
        'body' => <<<'TXT'
El 1 de octubre de 2026, dos equipos publicaron modelos que no redactan. Se les da una situación y las respuestas permitidas. Devuelven una elección, con una probabilidad. No un párrafo para releer, ni una frase para partir.

Es otra tarea, distinta de la de los modelos que escriben. Escribir sirve para explicar, resumir, proponer. Elegir sirve para enganchar el paso siguiente: enviar un expediente a un equipo, aceptar o rechazar una petición, tomar una herramienta en lugar de otra. El resultado cabe en una casilla.

## Clef, en Cloudflare

Cloudflare presentó Clef y Clef-flash. El primero es el mayor de los dos. El segundo está pensado para responder más rápido. Los dos se ofrecen en el servicio Workers AI. Los pesos se publican bajo la licencia Apache 2.0: se pueden reutilizar y ejecutar en otro sitio.

El blog de Cloudflare describe el funcionamiento. El modelo lee la situación y preguntas cerradas, y luego da una probabilidad para cada respuesta permitida. No hay texto libre que interpretar. TechCrunch, el mismo día, coloca esta publicación entre modelos hechos para ordenar opciones ya planteadas, en lugar de producir un texto largo. beri.net pone los dos anuncios uno junto al otro, en un tercer sitio.

## Strands Decider, en AWS

El mismo 1 de octubre, un laboratorio de AWS publicó Strands Decider. TechCrunch lo describe como un modelo abierto, bastante pequeño para ejecutarse en una máquina local, usado para ordenar opciones ya decididas y decir cuánta seguridad tiene la elección. No escribe una respuesta libre. beri.net añade que se publicaron los pesos, los datos de entrenamiento y los scripts: se puede leer cómo se construyó, no solo usarlo como una caja cerrada.

Los dos anuncios no se copian. Clef es primero un servicio, con pesos reutilizables. Decider es pequeño y está pensado para quedarse cerca de la máquina que lo usa. Los dos rechazan el texto libre.

## Qué cambia en una herramienta

En una herramienta de trabajo, un paso en el que «el modelo decide» es más fácil de controlar cuando las respuestas posibles están escritas de antemano. Se puede comprobar que la salida es una de las casillas previstas. No se relee un párrafo que habría inventado un tercer camino.

Eso no sustituye a un modelo que tiene que redactar una nota o responder a un cliente. Sustituye los sitios en los que se pide a un modelo grande que elija, y luego se espera que haya respondido en el formato correcto. Aquí el formato está impuesto. La elección sigue mereciendo una lectura cuando la decisión tiene un coste: el modelo indica una probabilidad, no firma en lugar de la persona.
TXT,
    ],
];
