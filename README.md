# Proyecto Laravel: Gestión de Clientes y Hobbies

Este proyecto Laravel proporciona una API para gestionar clientes y sus hobbies, con funcionalidades de autenticación y generación de PDFs usando DomPDF.

## Clonación y Configuración Inicial

### Requisitos Previos

- Docker y Docker Compose instalados en la máquina.

### Pasos para la Configuración

1. **Clonar el Repositorio**
    ```
    git clone https://github.com/joseantoniopino/bloonde.git
    cd bloonde
    ```

2. **Copiar el Archivo `.env`**
    ```
    cp .env.example .env
    ```

3. **Configurar el Archivo `.env`**
    - Asegúrate de configurar las variables necesarias en el archivo `.env`. Por ejemplo, configuración de la base de datos, puerto, etc.

4. **Construir y Levantar los Contenedores**
    ```
    docker-compose up -d --build
    ```

5. **Instalar las Dependencias**
    ```
    docker-compose run --rm bloonde composer install
    ```

6. **Generar la Clave de la Aplicación**
    ```
    docker-compose run --rm bloonde php artisan key:generate
    ```

7. **Migrar la Base de Datos y Ejecutar Seeders**
    ```
    docker-compose run --rm bloonde php artisan migrate --seed
    ```
Nota: el proyecto usa laravel sail, una vez tengas instaladas las dependencias, puedes usar `sail` en lugar de `docker-compose run --rm bloonde` para ejecutar los comandos.

Se puede crear un alias para sail en el archivo `.bashrc` o `.zshrc`:
```
alias sail='sh $([ -f sail ] && echo sail || echo vendor/bin/sail)'
```
Mas información sobre sail en [https://laravel.com/docs/11.x/sail](https://laravel.com/docs/11.x/sail)

## Uso de la API
**Token de Acceso**: Se debe incluir el token de acceso en el encabezado `Authorization` para realizar acciones protegidas. El token es tipo Bearer, el cual se obtiene al hacer login y se destruye al hacer logout

## Colección de Postman

Para facilitar las pruebas de la API, se ha proporcionado una colección de Postman. La variable `{{url}}` debe ser configurada como `bloonde.test/api/v1`. (o usar localhost o el dominio que mapees en /etc/hosts).

- **Importar la Colección de Postman**:
    1. Abre Postman.
    2. Ve a `File` > `Import`.
    3. Selecciona el archivo `Bloonde Collection.postman_collection.json` y cárgalo.

### Autenticación

- **Registro**
    ```
    POST {{url}}/register
    ```
    ```json
    {
        "email": "jose@test.com",
        "password": "12345678",
        "password_confirmation": "12345678"
    }
    ```

- **Inicio de Sesión**
    ```
    POST {{url}}/login
    ```
    ```json
    {
        "email": "jose@test.com",
        "password": "12345678"
    }
    ```

- **Cerrar Sesión**
    ```
    POST {{url}}/logout
    ```

### Gestión de Clientes

- **Listar Clientes**
    ```
    GET {{url}}/customers
    ```

- **Mostrar Cliente Específico**
    ```
    GET {{url}}/customers/{id}
    ```

- **Crear Cliente**
    ```
    POST {{url}}/customers
    ```
    ```json
    {
        "name": "Tyrion",
        "surname": "Lannister",
        "hobbies": [2, 3],
        "user_id": 3
    }
    ```

- **Actualizar Cliente**
    ```
    PUT {{url}}/customers/{id}
    ```
    ```json
    {
        "name": "Juan",
        "surname": "Nadie",
        "hobbies": [2, 3]
    }
    ```

- **Eliminar Cliente**
    ```
    DELETE {{url}}/customers/{id}
    ```

- **Obtener Clientes por Hobby**
    ```
    GET {{url}}/customers-by-hobby?hobby_id=1
    ```

### Generación de PDF

- **Generar PDF de Clientes y Hobbies**
    ```
    GET {{url}}/customers/pdf
    ```

## Detalles del Proyecto

### Customers y Users

- Los clientes (`Customer`) están relacionados con los usuarios (`User`) a través de un `user_id`.
- Cada cliente puede tener múltiples hobbies a través de una relación many-to-many.

### Policies

- Se utilizan políticas para controlar el acceso a las acciones sobre los clientes.
- Solo los administradores pueden gestionar todos los datos (CRUD completo).
- Los clientes pueden ver, actualizar y eliminar únicamente sus propios datos.

### Form Requests

- **RegisterAuthRequest**: Valida los datos de registro.
- **LoginAuthRequest**: Valida los datos de inicio de sesión.
- **GetCustomersByHobbyRequest**: Valida los datos para obtener clientes por hobby.

## Notas Adicionales

- **Seeder de Customers**:
    - El seeder crea un usuario específico y su cliente asociado, además de generar 50 clientes y hobbies aleatorios.

## Contacto

- **Autor**: José Antonio Pino
- **Email**: josanpino@gmail.com
- **LinkedIn**: [https://www.linkedin.com/in/joseantoniopino](https://www.linkedin.com/in/joseantoniopino)
- **GitHub**: [https://www.github.com/joseantoniopino](https://www.github.com/joseantoniopino)



