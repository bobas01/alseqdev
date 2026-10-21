<?php

declare(strict_types=1);

return [
    [
        'locale' => 'es',
        'category' => 'developpement',
        'slug' => 'postgresql-19-primer-candidato',
        'title' => 'PostgreSQL 19 está cerca de la versión final',
        'summary' => 'El 15 de octubre de 2026 salió una versión de prueba casi definitiva. La versión estable se prevé para el 19 de noviembre, tras otra prueba el 12 de noviembre.',
        'cover' => '/blog/postgresql-19.svg',
        'translation_key' => 'postgresql-19',
        'published_at' => '2026-10-18 20:00:00',
        'sources' => [
            ['title' => 'PostgreSQL — 19 RC 1', 'url' => 'https://www.postgresql.org/about/news/postgresql-19-rc-1-released-3409/'],
            ['title' => 'PostgreSQL — notas de la versión 19', 'url' => 'https://www.postgresql.org/docs/19/release-19.html'],
            ['title' => 'LWN — funciones retiradas durante la beta', 'url' => 'https://lwn.net/Articles/1100182/'],
            ['title' => 'AWS — la prueba en RDS Preview', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/postgresql-19-rc1-amazon-rds-database-preview-environment/'],
        ],
        'body' => <<<'TXT'
El 15 de octubre de 2026, el PostgreSQL Global Development Group publicó una versión de prueba casi definitiva de la 19. Debe quedar casi idéntica a la versión estable, con correcciones todavía posibles. El gran lote de correcciones del 12 de noviembre entra en esta versión antes de la salida: otra prueba está prevista ese día. Salvo un aplazamiento, la versión general es el 19 de noviembre de 2026.

## Qué incluye

Las notas de la versión 19 describen la orden REPACK, que recupera espacio en disco y puede reordenar las filas. Con la opción concurrente, las lecturas y las escrituras siguen durante la reescritura. Sustituye a VACUUM FULL y a CLUSTER, que siguen disponibles. Dos extensiones permiten fijar decisiones del planificador, o volver a aplicarlas después. La replicación lógica puede activarse sin reiniciar el servidor cuando el nivel del diario ya es « replica ». Los valores de secuencia también pueden replicarse.

El anuncio del 15 de octubre lista correcciones desde la beta 4, en particular sobre REPACK en modo concurrente, el consejo de plan y esa activación de la replicación lógica.

## Qué no se hace con él

Amazon RDS ofrece esta versión de prueba en su entorno de vista previa, el mismo día. Esas bases se guardan allí 60 días como máximo y luego se borran. El 13 de octubre, LWN reprodujo a un miembro del equipo: varias funciones previstas se retiraron durante la beta, porque los defectos aparecieron demasiado tarde para sostenerlas. La versión de prueba publicada no es, por tanto, toda la lista anunciada antes.

Una base en producción se queda en una versión que ya está en servicio. La 19 se prueba aparte. El paso desde una versión mayor más antigua es una actualización mayor.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'devops',
        'slug' => 'lambda-puede-servir-una-pagina',
        'title' => 'Lambda publica un sitio ya escrito',
        'summary' => 'El 12 de octubre de 2026, AWS permite poner en línea un sitio Node.js ya hecho, sin reescribirlo en el formato propio de Lambda.',
        'cover' => '/blog/lambda-web.svg',
        'translation_key' => 'lambda-web',
        'published_at' => '2026-10-18 19:00:00',
        'sources' => [
            ['title' => 'AWS — anuncio de Lambda Web Functions', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/aws-lambda-web-functions/'],
            ['title' => 'AWS News Blog — el mismo lanzamiento', 'url' => 'https://aws.amazon.com/blogs/aws/announcing-aws-lambda-web-functions-for-fast-consistent-web-app-performance-anywhere/'],
            ['title' => 'LocalStack — la prueba en local', 'url' => 'https://blog.localstack.cloud/aws-lambda-web-functions-are-here/'],
        ],
        'body' => <<<'TXT'
El 12 de octubre de 2026, AWS anunció Lambda Web Functions. Un sitio Node.js ya escrito con Express, Hono, Fastify o Next.js puede quedarse como está. No hay que reescribirlo en el formato propio de Lambda.

## Qué cambia

Las funciones Lambda que ya están se llaman ahora Lambda Event Functions. AWS dice que ese cambio de nombre no pide un nuevo despliegue. Un entorno web caliente trata varias peticiones a la vez, hasta 128. Se paga el tiempo de procesador realmente usado, y la memoria mientras el entorno existe, también entre dos peticiones. El tiempo pasado esperando una base cuenta poco en procesador.

En el lanzamiento, el motor es Node.js. Las regiones abiertas son Virginia del Norte, Ohio, Oregón, Tokio e Irlanda. Se puede desplegar en varias de ellas y dejar que cada petición vaya a la más cercana. Una función puede alcanzar una red privada. CloudFront puede usarla como origen, anunciado el mismo día.

## Qué no resuelve

LocalStack escribió que las admite desde este lanzamiento, para probarlas en local antes de un despliegue. El modelo sigue siendo Node.js, en cinco regiones. Una aplicación ya alojada en otro sitio no tiene que mudarse por esto.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'cybersecurite',
        'slug' => 'nextjs-1641-para-instalar',
        'title' => 'Hay que instalar Next.js 16.4.1',
        'summary' => 'El 14 de octubre de 2026, Next.js publicó una actualización de seguridad fuera de las fechas habituales. Hay que instalar la 16.4.1, o la 15.5.28 si el sitio sigue en la serie 15.',
        'cover' => '/blog/nextjs-1641.svg',
        'translation_key' => 'nextjs-20261014',
        'published_at' => '2026-10-18 21:00:00',
        'sources' => [
            ['title' => 'Next.js — actualización del 14 de octubre', 'url' => 'https://nextjs.org/blog/nextjs-security-update-october-14-2026'],
            ['title' => 'NHS England Digital — la misma alerta', 'url' => 'https://digital.nhs.uk/cyber-alerts/2026/cc-4873'],
        ],
        'body' => <<<'TXT'
El 14 de octubre de 2026, Vercel publicó la actualización de seguridad anunciada la semana anterior. Sale del calendario habitual. Las versiones indicadas son 16.4.1, en la rama que aún se sigue de cerca, y 15.5.28, en la rama de mantenimiento 15.5.

## Qué cubren las correcciones

El texto describe los efectos, sin manual de uso. Dos puntos críticos pueden llevar a la ejecución de código en el servidor, sin cuenta. Uno afecta a las aplicaciones que guardan resultados en caché. El editor pide actualizar aunque ese caso no esté en la aplicación. El otro afecta a la optimización de imágenes, cuando el servidor corre en Linux. Un tercer punto puede saturar el procesador e impedir que el mismo proceso responda. Apunta a las aplicaciones App Router que tienen al menos una acción de servidor. El enrutador de páginas, y una aplicación sin acción de servidor, quedan fuera de ese tercer punto.

NHS England retomó el aviso el 19 de octubre: tres fallos, ejecución de código o indisponibilidad, y el mismo consejo de actualizar. Este texto no retoma el detalle de cada disparador.

## La versión a alcanzar

En la rama 16, el número publicado el 14 de octubre es 16.4.1. En la rama 15.5, es 15.5.28. Un sitio todavía por debajo, dentro de los rangos afectados, sigue expuesto mientras no tenga esos números.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'ia',
        'slug' => 'gemini-4-argon-precio-de-entrada',
        'title' => 'Gemini 4 Argon cuesta menos hasta el 30 de noviembre',
        'summary' => 'El 13 de octubre de 2026, Google abrió este modelo. Hasta el 30 de noviembre, el texto enviado cuesta 2 dólares por millón de unidades, y la respuesta 10. Esos precios se doblan el 1 de diciembre. No es gratuito.',
        'cover' => '/blog/gemini-4-argon.svg',
        'translation_key' => 'gemini-4-argon',
        'published_at' => '2026-10-18 18:00:00',
        'sources' => [
            ['title' => 'Google — Gemini 4 Argon', 'url' => 'https://blog.google/innovation-and-ai/models-and-research/gemini-models/introducing-gemini-4-argon/'],
            ['title' => 'Google AI for Developers — ficha del modelo', 'url' => 'https://ai.google.dev/gemini-api/docs/latest-model'],
            ['title' => 'Google Cloud — la misma apertura', 'url' => 'https://cloud.google.com/blog/products/ai-machine-learning/gemini-4-argon-available-on-google-cloud'],
        ],
        'body' => <<<'TXT'
El 13 de octubre de 2026, Google abrió Gemini 4 Argon. El identificador de API es gemini-4-argon. El precio de entrada vale hasta el 30 de noviembre de 2026: 2 dólares por millón de tokens de entrada, 10 dólares en la salida, reflexión incluida. Desde el 1 de diciembre, las tarifas pasan a 4 y 20. Los tokens de entrada ya vistos cuestan un 95 % menos: 0,10 dólares, y luego 0,20. El modelo no está en la oferta gratuita.

## Qué dice Google

La ventana tiene 1.048.576 tokens, compartidos entre la entrada, la reflexión y la salida. El nivel de reflexión por defecto es medio. Se puede bajar o subir. Google dice que Argon es el primero en el índice Vals, que cubre finanzas, código, derecho y fiscalidad. Es su medida.

El texto del 13 de octubre abre la API en AI Studio, Antigravity para los abonados Ultra, y la aplicación Gemini para los abonados Pro y Ultra. La documentación para desarrolladores, fechada el 16 de octubre, confirma el precio, la ventana y la ausencia de oferta gratuita. La caché pedida a mano no está admitida. La caché automática sí, a partir de cierto volumen.

## Qué no se hace con él

El precio se dobla el 1 de diciembre. Una prueba con la tarifa de entrada no dice la factura de enero. Google cuenta también trabajos internos, con sus propias cifras. La salida se factura, reflexión incluida. El modelo no relee el trabajo en su lugar.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'developpement',
        'slug' => 'un-archivo-fija-las-actions',
        'title' => 'Un archivo guarda la versión exacta de las herramientas de GitHub',
        'summary' => 'El 14 de octubre de 2026, GitHub mostró un archivo que guarda la versión de las herramientas que se ejecutan solas. La prueba es para cuentas Enterprise Cloud. Guardar la versión no prueba que la herramienta sea fiable.',
        'cover' => '/blog/actions-lock.svg',
        'translation_key' => 'actions-lock',
        'published_at' => '2026-10-18 22:00:00',
        'sources' => [
            ['title' => 'GitHub Changelog — la vista previa del 14 de octubre', 'url' => 'https://github.blog/changelog/2026-10-14-github-actions-workflow-lockfiles-in-public-preview/'],
            ['title' => 'GitHub Docs — bloquear las dependencias', 'url' => 'https://docs.github.com/en/actions/how-tos/secure-your-work/lock-workflow-dependencies'],
            ['title' => 'GitHub — repositorio gh-actions-lock', 'url' => 'https://github.com/github/gh-actions-lock'],
        ],
        'body' => <<<'TXT'
El 14 de octubre de 2026, GitHub abrió una vista previa pública de los archivos de bloqueo para GitHub Actions. Una etiqueta o una rama puede moverse después de la revisión. El archivo guarda el commit registrado, y Actions ejecuta ese commit, aunque la etiqueta se haya movido desde entonces.

La vista previa se anuncia para GitHub Enterprise Cloud, también con residencia de datos. El registro no la abre a los planes Team y Free. La extensión se llama actions-lock. El archivo que produce es .github/workflows/actions.lock. Se puede incorporar un solo workflow. Una vez incorporado, cada dependencia, incluidas las que arrastra, debe tener una línea.

Bloquear no dice que la dependencia sea sana. GitHub lo dice: se revisa antes de fijar. Dependabot, cuando propone una actualización de una action ya incorporada, regenera la línea en la misma solicitud. Un administrador de empresa, de organización o de repositorio puede exigir el archivo. La extensión está antes de la versión 1.0, y el formato todavía puede cambiar.

Es útil cuando los workflows ya corren en Enterprise Cloud y el riesgo que se quiere cortar es una etiqueta que se mueve. En los otros planes, la vista previa no está anunciada. No es un control del contenido de las actions.
TXT,
    ],
];
