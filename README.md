# Foro Foring.
- Link del sitio web: http://www.foroforing.ga/

Foro Foring es una aplicación web dinamica, creada con PHP y haciendo de MySQL para hacer la gestión de las bases de datos con tablas relacionadas.

# Explicación.

La aplicación web Foring es un foro donde cualquier persona puede registrarse introduciendo su nombre, un correo electrónico y una contraseña, que por motivos obvios de seguridad, se almacenará encriptada en la base de datos. 
Si una persona ya se ha registrado en la aplicación, se deberá dirigir a la sección "Accede" e introducir el correo y la contraseña que ha utilizado cuando la persona se quiso registrar.

En la página web principal, permite visualizar todos los temas de conversación que la comunidad ha creado, con un sistema de paginación en la parte inferior (creado de forma manual y sin la utilización de ningún plugin) que permite pasar de página en el caso de que aparezcan un máximo de temas en la página (7 temas en la página de inicio y 5 temas en la página de bienvenida cuando el usuario accede). Los temas de conversación creados aparecen de forma dinámica con el Titulo, la Descripción, el Autor, la Fecha de creación y el Número de comentarios introducidos en el mismo. En el caso de que se haga click en uno de los temas, y haya registrado o no en la aplicación con anterioridad, se mostrarán los comentarios que se han escrito por los usuarios junto con información más visual sobre el tema y también con un sistema de paginación en la parte inferior.

Hay que precisar que, si un usuario no se ha registrado en la aplicación, no podrá borrar/editar ningún tema de conversación ni tampoco ningún comentario.

Todo cambia cuando una persona se registra en la aplicación o accede si ya tiene una cuenta registrada. En éste caso, tiene la oportunidad de crear tantos temas como le plazcan (que aparecerán en orden de Creacción en la sección de mostrado de todos los temas). Sobra decir también, que también se pueden escribir tantos comentarios como se desee en cualquier tema de conversación. 
En cuanto a los anteriores, cada tema de conversación o comentarios, únicamente pueden ser borrados/editados por la persona que lo ha publicado o por una cuenta especial de Administrador.

Se ha desarrollado un sistema de errores en el formulario de Registro (en el caso de que el correo o nombre de usuario ya esté en uso, el valor de la Contraseña Repetida sea distinto a la Contraseña...), en el formulario para Acceder (si el correo introducido no existe en la base de datos o la contraseña sea incorrecta), en la sección de Crear/Modificar un Comentario/Tema, dónde no dejará introducir un comentario si: el mismo no tiene valor, si excede el máximo de carácteres permitidos. Tampoco dejará introducir un tema si: el Titulo ya está introducido, si la Descripción o el Titulo excede el máximo de carácteres permitidos, si la Descripción o el Titulo no tiene valor, etc.

Foring ha sido un proyecto solicitado por el **Campus Virtual de la Universidad San Valero (Zaragoza)**, y tube el propósito de crear una aplicación con un diseño moderno, haciendo uso de metodologias de programación modernas, con el patrón de arquitectura de software **Modelo Vista Controlador** y con **Programación Orientada a Objetos**.

# Implementaciones:

- Desarrollo en **PHP** sin ayuda de ningún plugin y **MySQL**.
- Se ha hecho uso de relaciones en las tablas.
- Optimización y eficiencia en consultas SQL.
- Utilización de **Modelo Vista Controlador** y **POO**.
-	Desarrollo en **Javascript** y **JQuery** sin la utilización de ningún plugin.
-	Se he diseñado la web utilizando maquetación **CSS3**.
-	El sitio web es **responsive** y adaptado a cualquier tipo de tamaño de pantalla.
-	Se ha implementado **HTML5**.
